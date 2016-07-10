<?php
require __DIR__."/../_www/_common/database_access.php";
global $database;

//
// 0. Get the last run times

$time_frames = array("every1min" => 60, "every5min" => 60 * 5, "every15min" => 60 * 15);

// 
// 1. Run every 1minute , 5 minutes and 15 minutes
foreach($time_frames as $time_frame => $minutes)
{

	$db_result = $database->query("SELECT UNIX_TIMESTAMP(ran_at) ran_at FROM cron WHERE time_frame_group = '$time_frame' ORDER BY ran_at DESC LIMIT 1;")->fetchAll(PDO::FETCH_ASSOC);
	if (!empty($db_result)) $last_run[$time_frame] = $db_result[0]['ran_at'];


	if (!isset($last_run[$time_frame]) || time()  >=( $last_run[$time_frame]+ $minutes))
	{
		// Loop through all the scripts found in folder
		$output = array();
		foreach(scandir(__DIR__."/".$time_frame) as $no => $filename)
		{
			// Run them if their filename contains ".php"
			if (strpos($filename, ".php") > 0)
			{
				$output[$no] = "";
				exec("/usr/bin/php ".__DIR__."/".$time_frame."/".$filename. " 2> /tmp/".md5($filename)."_err",$output[$no],$return_var);

				log_database(implode("\n",$output[$no]),$filename,file_get_contents("/tmp"."/".md5($filename)."_err"),$time_frame);
				@unlink("/tmp"."/".md5($filename)."_err");
			}
			
		}
	
		$last_run[$time_frame] = time();
	}
	
}


//
// Write errors to local file with date and script name
function log_database($str, $filename, $error_log,$time_frame_group)
{
	global $database;
	$database->prepare("REPLACE INTO cron (script_name, output, error_log, time_frame_group) VALUES (?,?,?,?)")->execute(array($filename,$str,$error_log,$time_frame_group));
}
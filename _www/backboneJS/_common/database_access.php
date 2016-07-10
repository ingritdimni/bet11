<?php

global $database;
$database = new PDO('mysql:host=127.0.0.1;dbname=envma2016;charset=utf8', 'root', '4t74ygv6');

/*function load_csv($filename)
{
		// Capture CSV file with header
		$file = file($filename,FILE_SKIP_EMPTY_LINES);
		$array = array_map("str_getcsv",$file ,array_fill(0,count($file),";"));
		$keys = array_shift($array);
		$parsed_array = array();

	//	To turn all the rows into a nice associative array you could then apply:
		foreach ($array as $i=>$row) {
		    $parsed_array[$row[0]] = array_combine($keys, $row);
		}
		return $parsed_array;
	
}

function write_csv($new_data, $filename)
{
		// Merge with old data, if file exists
		if (file_exists($filename))
		{
			$old_data = load_csv($filename);
			foreach($old_data as $id => $entry)
			{
				if(isset($new_data[$id])) $old_data[$id] = $new_data[$id];
			}
			$new_data = $old_data;
		}

		// Write CSV to the file
		$new_csv_data = implode(";",array_keys($new_data[0]));
		foreach($new_data as $entry)
		{
			$new_csv_data .= "\n".implode(";",$entry);
		}
		file_put_contents($filename,$new_csv_data);

	
}*/
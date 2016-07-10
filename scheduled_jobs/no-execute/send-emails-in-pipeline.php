<?php
require __DIR__.'/../../_www/_common/database_access.php';
require __DIR__.'/../../_www/_common/global-settings.php';
global $global_settings, $database;

// (0) Load TWIG
require_once __DIR__.'/../../3rd_party_code/vendor/autoload.php';
Twig_Autoloader::register();
$twig_from_string = new \Twig_Environment(new \Twig_Loader_String());
$twig_from_string->getExtension('core')->setTimezone('Europe/Lisbon');




// (1) Check which emails are in pipeline
$emails_in_pipeline = $database->query("SELECT * FROM email_pipeline WHERE date_time_sent IS NULL")->fetchAll(PDO::FETCH_ASSOC);

// (2) Loop through the result
foreach($emails_in_pipeline as $email)
{
	// (3) Check if JSON file exists
	if (!file_exists(__DIR__."/../../email_templates/".$email['template'].".json"))
	{	echo("WARNING: Could not find ".$email['template'].".json\n");
		continue;
	}


	
	// (4) Decode the configuration from JSON file
	$email_settings = json_decode(file_get_contents(__DIR__."/../../email_templates/".$email['template'].".json"),true);


	
	// (5) Check if $to_sql_query is set and parse it
	if(isset($email_settings['to_sql_query']))
	{
		// (5.1) Parse as TWIG with SQL data
		if(isset($email['data']) && !empty($email['data']))
		{
			$email_settings['to_sql_query'] = $twig_from_string->render($email_settings['to_sql_query'],array('user_id'=>$email['user_id'],'data_1'=>$email['data_1']));
		}

		$query = $database->query($email_settings['to_sql_query']);
		

		// Check for errors 
		if($query=== false || ($res = $query->fetchAll(PDO::FETCH_ASSOC)) == 0)
		{
			echo "WARNING: invalid to_sql_query.";
			print_r($database->errorInfo());
			continue;
		}
		else
		{
			// Merge columns with " " - single space
			foreach($res as $no => $line) {$res[$no] = implode(" ",$line);}

			// Merge rows with "," - comma
			$email_settings['to'] = implode(", ",$res);
		}
	}




	
	// (6) Check if $data_sql_query is set and parse it
	if(isset($email_settings['data_sql_query']))
	{
		// (6.1) Single QUERY, single line
		if(is_string($email_settings['data_sql_query']))
		{
			// (6.1.1) Parse as TWIG with SQL data
			if(isset($email['data']) && !empty($email['data']))
			{
				$email_settings['data_sql_query'] = $twig_from_string->render($email_settings['data_sql_query'],array('user_id'=>$email['user_id'],'data_1'=>$email['data_1']));
			}


			$query = $database->query($email_settings['data_sql_query']);

			// Check for errors, fetch first line
			if($query=== false || ($res = $query->fetch(PDO::FETCH_ASSOC)) == 0)
			{
				echo "WARNING: invalid data_sql_query.";
				print_r($database->errorInfo());
				continue;
			}
			else
			{
				$email_settings['data'] = $res;
			}
			
			
		}
		elseif(is_array($email_settings['data_sql_query']))
		{
			foreach($email_settings['data_sql_query'] as $key => $query)
			{
				// (6.1.1) Parse as TWIG with SQL data
				if(isset($email['data']) && !empty($email['data']))
				{
					$query = $twig_from_string->render($query,array('mysql_data'=>$email['data']));
				}

				
				$query = $database->query($query);

				// Check for errors, fetch all data, 
				if( $query=== false || ($res = $query->fetchAll(PDO::FETCH_ASSOC)) == 0)
				{
					echo "WARNING: invalid data_sql_query.";
					print_r($database->errorInfo());
					continue;
				}
				else
				{			
					if (!isset($email_settings['data'])) $email_settings['data'] = array();
					$email_settings['data'][$key] = $res;
				}
			}
			
		}

	}





	
	// (7) Load TWIG, include file $template .twig.html


	$loader = new Twig_Loader_Filesystem(array(__DIR__.'/../../email_templates'));
	$twig_from_file = new Twig_Environment($loader);
	$twig_from_file->getExtension('core')->setTimezone('Europe/Lisbon');


	if (!isset($email_settings['data'])) {echo "WARNING: 'data' variable is not set for this email.\n"; continue;}
	$email_settings['body'] = $twig_from_file->render($email['template'].".twig.html",$email_settings['data']);




	
	// (8) Check if $to, $from, $subject and $body exist
	if(!isset($email_settings['to'])) {		echo "WARNING: Unset 'to' field of email_settings\n"; 		continue;}
	if(!isset($email_settings['from'])) {	echo "WARNING: Unset 'from' field of email_settings\n"; 	continue;}
	if(!isset($email_settings['subject'])) {echo "WARNING: Unset 'subject' field of email_settings\n"; 	continue;}
	if(!isset($email_settings['body'])) {	echo "WARNING: Unset 'body' field of email_settings\n"; 	continue;}




	// (9) Send e-mail
		// To send HTML mail, the Content-type header must be set
		$headers = "";
		

		// Additional headers
		$headers .= "From: ".$email_settings['from']."\r\n";
		$headers .= "Reply-To: ".$email_settings['from']."\r\n";
		$headers .= "Return-Path: ".$email_settings['from']."\r\n";
		if(isset($email_settings['cc'])) $headers .= "Cc: ".$email_settings['cc']."\r\n";
		if(isset($email_settings['bcc'])) $headers .= "Bcc: ".$email_settings['bcc']."\r\n";
		
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-Type: multipart/alternative; boundary="MIMEBoundary83442d4d11512fc117b48f760241a5a5"' . "\r\n";
		
		// Text PART
		$body = "--MIMEBoundary83442d4d11512fc117b48f760241a5a5"."\r\n";
		$body .= "Content-Type: text/plain; charset=\"UTF-8\" \r\n";
		$body .= "Content-Transfer-Encoding: 7bit \n\n\n\n";
		if(isset($email_settings['text_part'])) $body .= $email_settings['text_part']."\r\n\r\n";

		// HTML PART
		$body .= "--MIMEBoundary83442d4d11512fc117b48f760241a5a5"."\r\n";
		$body .= "Content-Type: text/html; charset=\"UTF-8\" \r\n";
		$body .= "Content-Transfer-Encoding: 8bit \n\n\n\n";

		$body .= $email_settings['body'];

		// Mail it
//		$email_settings['to'] = "fredericomfalcao@hotmail.com"; 
//		$body .= print_r(array("to"=>$email_settings['to'],"subject"=> $email_settings['subject'],"body"=> $body, "Data"=>$email_settings['data']),true);
	
		// Encode SUBJECT
		mb_internal_encoding("UTF-8");
		$email_settings['subject'] = mb_encode_mimeheader($email_settings['subject'],'UTF-8','Q');

		$mail_result = mail($email_settings['to'], $email_settings['subject'], $body, $headers);
		if ($mail_result)
		{
			// Update Sent_Welcome_Emails
			$database->exec("UPDATE email_pipeline SET date_time_sent = NOW() WHERE id =  ".$email['id']);
		}

	

		
}

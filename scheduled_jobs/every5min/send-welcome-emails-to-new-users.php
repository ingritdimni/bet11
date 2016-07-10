<?php

require_once __DIR__."/../../_www/_common/database_access.php";
global $database;

require __DIR__."/../../_www/_common/global-settings.php";
global $global_settings;

$query = "SELECT a.*,b.language, b.name group_name, b.group_url FROM users a ";
$query .= "INNER JOIN betting_group b ON a.Group_id = b.id ";
$query .= "WHERE a.Send_Welcome_Email <> a.Sent_Welcome_Emails;";
$users = $database->query($query)->fetchAll(PDO::FETCH_ASSOC);


require_once __DIR__.'/../../3rd_party_code/vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(array(__DIR__.'/../../email_templates/'));
$twig = new Twig_Environment($loader);


// Loop through all the files in master-data folder
foreach($users as $user)
{
	// Recipient
	$to  = $user['E_Mail'];

	// subject
	$subject = "Bem-vindo ao ENVMA EURO 2016 - [login link]";
	
	// Login Link
	$login_link = "http://".$user['group_url']."/_setcookie.php?login-cookie=".md5($user['E_Mail'].$global_settings['password_salt']);
	

	// Message
	$message = $twig->render("1_welcome_new_user_".$user['language'].".twig.html",array_merge($user,array("login_link" => $login_link)));


	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

	// Additional headers
	$headers .= 'To: '.$user['Name'].' <'.$user['E_Mail'].'>'."\r\n";
	$headers .= 'From: '.$user['group_name'].' <do-not-reply@'.$user['group_url'].'>' . "\r\n";
//	$headers .= 'Bcc: fredericomfalcao@hotmail.com' . "\r\n";

	// Mail it
	if ( mail($to, $subject, $message, $headers))
	{
		// Update Sent_Welcome_Emails
		$database->exec("UPDATE users SET Sent_Welcome_Emails = Send_Welcome_Email WHERE id =  ".$user['id']);
	}
	


}
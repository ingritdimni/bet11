<?php
require 'database_access.php';
require 'global-settings.php';
global $global_settings, $user_id, $group_id, $language,$user_developer;
$user_id = 0;

// Check if user provided login credential via URL or COOKIE
if(isset($_GET['login-cookie']) || isset($_COOKIE['login-cookie']))
{
	// Get all the utilizadores data
//	$utilizadores = load_csv(__DIR__."/data/utilizadores.csv");
	$utilizadores = $database->query("SELECT * FROM users;")->fetchAll(PDO::FETCH_ASSOC);

	// IF user provided login credential via URL
	if(isset($_GET['login-cookie']))
	{
		// Loop through and compare salted e-mail to provided string
		foreach($utilizadores as $utilizador)
		{

			if (md5($utilizador['E_Mail'].$global_settings['password_salt']) == $_GET['login-cookie'])
			{
				$user_id = $utilizador['id'];
				$user_developer = $utilizador['Developer'];
				$group_id = $utilizador['Group_id'];
				$language = $database->query("SELECT language FROM betting_group WHERE id = ".$group_id)->fetchAll(PDO::FETCH_ASSOC);				
				$database->exec("UPDATE users SET last_logged_in = NOW() WHERE id = $user_id");
				$language = $language[0]['language'];
				break;
			}
		}

	}
	elseif(isset($_COOKIE['login-cookie']))
	{
		// Loop through and compare salted e-mail to provided string
		foreach($utilizadores as $utilizador)
		{
			if (md5($utilizador['E_Mail'].$global_settings['password_salt']) == $_COOKIE['login-cookie'])
			{
				$user_id = $utilizador['id'];
				$user_developer = $utilizador['Developer'];
				$group_id = $utilizador['Group_id'];
				$language = $database->query("SELECT language FROM betting_group WHERE id = ".$group_id)->fetchAll(PDO::FETCH_ASSOC);
				$database->exec("UPDATE users SET last_logged_in = NOW() WHERE id = $user_id");
				$language = $language[0]['language'];
				break;
			}
		}
	}

	if($user_id == 0)
	{				
		// Remove the cookie if it exists
	 	unset($_COOKIE['login-cookie']);
//	    setcookie('login-cookie', null, -1, '/');
	
		die("No valid user found.");
	}
}
else
{
	die("No login credential provided.");
}	
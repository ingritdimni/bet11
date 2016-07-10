<?php

require_once __DIR__."/../../_www/_common/database_access.php";
global $database;

$query = "INSERT INTO match_bets (user_id, match_id) ";
$query .= "SELECT a.id user_id, b.id match_id ";
$query .= "FROM users a ";
$query .= "CROSS JOIN matches b ";
$query .= "LEFT JOIN match_bets c ON a.id = c.user_id AND b.id = c.match_id ";
$query .= "WHERE c.match_id IS NULL ";

	
$results = $database->exec($query);



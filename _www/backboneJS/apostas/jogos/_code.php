<?php
require '../../../_common/log_in_check.php';
global $user_id, $group_id, $language, $user_developer;

require_once "../../_common/database_access.php";
global $database;


//
//  --- Prevent Caching
//

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


//
//  ---  Accept MATCH BETs POSTs / MATCH RESULT POSTs
//

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	if (isset($_GET['submit_result']) && $user_developer)
		$sql_table = "matches";
	elseif (!isset($_GET['submit_result']))
		$sql_table = "match_bets";
	else die("ERROR: You're not a organizer... you can't change match results.");
	
	// Check if match_bet is being submitted and bet is closed
/*	if($sql_table == 'match_bets' )
	{
		$res = $database->prepare("SELECT b.status FROM match_bets a INNER JOIN matches b ON a.match_id = b.id WHERE a.match_id = ".$_POST['match_id'])->execute();
		
		if ($res[0]['status'] != 'bets_open') 
		{
					header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
					die("ERROR: Bets are closed for this match_id");
		}
		
	}*/
		
	$sql_query = "UPDATE ";
	$sql_query .= $sql_table." ";
	$sql_query .= "SET home_team_score = ?, away_team_score = ? ";
	$sql_query .= "WHERE ";
	$sql_query .= (isset($_GET['submit_result'])?'':"user_id = ? AND ");
	$sql_query .= (isset($_GET['submit_result'])?'id = ?':"match_id = ? ");
	
	$data_array = array();
	$data_array[] = $_POST['home_team_score'];
	$data_array[] = $_POST['away_team_score'];
	if (!isset($_GET['submit_result'])) $data_array[] = $user_id;
	$data_array[] = $_POST['match_id'];
	
	$stm = $database->prepare($sql_query);
	$res = $stm->execute($data_array);
	
	if ($res == 0)
	{
		print_r($stm->errorInfo());
		echo $sql_query."\n";
		print_r($data_array);
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	}
	else
		echo "You have submitted a match bet!!\nGood luck! :)";
	die();
}











		// --- LOAD Jogos and Equipas CSV
		
		$utilizadores 	= $database->query("SELECT * FROM users WHERE Group_id = ".$group_id)->fetchAll(PDO::FETCH_ASSOC);
		$equipas 		= $database->query("SELECT id, Name_".$language." Name FROM teams")->fetchAll(PDO::FETCH_ASSOC);
		$equipas		= array_combine(array_column($equipas,"id"),$equipas);
		$jogos 			= $database->query("SELECT *, DATE_FORMAT(match_date_time,'%e of %M') Day_of_match, TIME_FORMAT(match_date_time, '%H:%i') Time_of_match FROM matches ORDER BY match_date_time ASC, tournament_group ASC")->fetchAll(PDO::FETCH_ASSOC);
		
				


		// --- Get and translate all the DATES
		if ($language == 'PT')
			$jogos = array_map(function($jogo){$jogo['Day_of_match'] = str_replace(array('of June','of July'), array('de Junho', 'de Julho'), $jogo['Day_of_match']);return $jogo;}, $jogos);

		$uniq_dates = array_unique(array_column($jogos,"Day_of_match"));
		
		// -- Hydrate MATCHES with BETS_CLOSED or SETTLED status
		foreach($jogos as $row_no => $jogo)
		{
			if ($jogo['status'] == 'bets_closed' || $jogo['status'] == 'settled')
			{
				$match_id = $jogo['id'];
				$query = "SELECT b.name user_name, a.* FROM match_bets a ";
				$query .= "INNER JOIN users b ON a.user_id = b.id ";
				$query .= "WHERE b.Group_id = $group_id ";
				$query .= "AND a.match_id = $match_id ";
				$query .= "ORDER BY b.Name ASC ";
				$jogos[$row_no]['bets'] = $database->query($query)->fetchAll(PDO::FETCH_ASSOC);
				
				// Add bet summary				
				$query = "SELECT SUM(CASE WHEN a.home_team_score > a.away_team_score THEN 1 ELSE 0 END) victory, ";
				$query .= " SUM(CASE WHEN a.home_team_score = a.away_team_score THEN 1 ELSE 0 END) draw, ";
				$query .= " SUM(CASE WHEN a.home_team_score < a.away_team_score THEN 1 ELSE 0 END) defeat ";
				$query .= "FROM match_bets a ";
				$query .= "INNER JOIN users b ON a.user_id = b.id ";
				$query .= "WHERE b.Group_id = $group_id ";
				$query .= "AND a.match_id = $match_id ";
				$query .= "GROUP BY a.match_id ";

				$jogos[$row_no]['bets_summary'] = $database->query($query)->fetch(PDO::FETCH_ASSOC); 
				

			}
		}
		
		// -- Hydrate MATCHES with BETS_OPEN
		foreach($jogos as $row_no => $jogo)
		{
			if ($jogo['status'] == 'bets_open')
			{
				$match_id 	= $jogo['id'];
				$query 		= "SELECT * FROM match_bets ";
				$query     .= "WHERE user_id = $user_id ";
				$query     .= "AND match_id = $match_id ";
				$jogos[$row_no]['bet'] = $database->query($query)->fetch(PDO::FETCH_ASSOC);

			}
		}
		
		
		echo json_encode(array('jogos'=>$jogos,'equipas'=>$equipas,'uniq_dates'=>$uniq_dates,"user_developer"=>$user_developer));
		

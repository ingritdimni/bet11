<?php

require_once '../_common/log_in_check.php';
require_once '../_common/database_access.php';
global $database, $group_id,$user_id;

//
//  --- Prevent Caching
//

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


//
//  --- Load TWIG
//
require_once '../../3rd_party_code/vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(array('../_common',__DIR__));
$twig = new Twig_Environment($loader);
?>

<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') : ?>
	<?php include("../_common/page_top.php"); ?>	
	<div class="container" style="text-align:center;background-color: #fff;">		

	<?php include "../_common/top_banner.php" ;?>	
	<?php include "../_common/menu_bar.php";?>

	<div id="ajax_page_content">
<?php endif; ?>	
	<?php include __DIR__."/../_common/epic_phrase.php"; ?>


	<?php

	// --- READ Utilizadores CSV
	$utilizadores = $database->query("SELECT a.*,b.* FROM ranking a INNER JOIN users b ON a.user_id = b.id WHERE a.Group_id = ".$group_id." ORDER BY a.points DESC, a.bulls_eye_bets DESC")->fetchAll(PDO::FETCH_ASSOC);

	$match_bets = $database->query("SELECT b.status match_status, a.user_id, a.home_team_score home_team_bet_score, a.away_team_score away_team_bet_score, b.home_team_score, b.away_team_score, a.points, c.Name_PT home_team, d.Name_PT away_team FROM match_bets a INNER JOIN matches b ON a.match_id = b.id INNER JOIN teams c ON c.id = b.home_team INNER JOIN teams d ON d.id = b.away_team WHERE b.status = 'settled' OR b.status = 'bets_closed' ORDER BY b.match_date_time ASC ")->fetchAll(PDO::FETCH_ASSOC);

	$ranking_log = $database->query("SELECT * FROM ranking_log")->fetchAll(PDO::FETCH_ASSOC);
	$ranking_log_avg = $database->query("SELECT match_id, home_team, away_team, AVG(accumulated_points) FROM `ranking_log` GROUP BY match_id, match_date_time, home_team, away_team")->fetchAll(PDO::FETCH_ASSOC);
	
	// match_bets by user
	$match_bets_by_user = array();
	foreach($match_bets as $match_bet)
	{
		if(!isset($match_bets_by_user[$match_bet["user_id"]])) $match_bets_by_user[$match_bet["user_id"]] = array();
		$match_bets_by_user[$match_bet["user_id"]][] = $match_bet;
	}

	echo $twig->render("layout.twig.html",array('utilizadores'=>$utilizadores,"ranking_log"=>json_encode($ranking_log),"user_id"=>$user_id,"match_bets_by_user"=>$match_bets_by_user));
		

?>

        
  




<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') : ?>
</div>
</div> <!-- /.container,  -->
</body>
</html>
<?php endif; ?>
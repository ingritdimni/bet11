<?php
require '../../../_common/log_in_check.php';
global $user_id, $group_id, $language;

require_once "../../_common/database_access.php";
global $database;

//
//  --- Prevent Caching
//

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");



//
//  ---  Accept PODIUM BETs POSTs
//

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$_POST['user_id'] = $user_id;
	$_POST['group_id'] = $group_id;

	$stm = $database
	->prepare("REPLACE INTO podium_bets (".implode(", ",array_keys($_POST)).") VALUES (".implode(", ",array_fill(0,count($_POST),"?")).")");
	$res = $stm->execute(array_values($_POST));

	if ($res === false)
	{
		print_r($stm->errorInfo());
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	}
	else
		echo "You have submitted your podium bet!!\nGood luck! :)";
	die();
}




//
//  --- Load TWIG
//
require_once __DIR__.'/../../../../3rd_party_code/vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(array('../../../_common',__DIR__));
$twig = new Twig_Environment($loader);
?>

<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') : ?>
	<?php include("../../_common/page_top.php"); ?>	
	<div class="container" style="text-align:center;background-color: #fff;">		

	<?php include "../../_common/top_banner.php" ;?>	
	<?php include "../../_common/menu_bar.php";?>

	<div id="ajax_page_content">
<?php endif; ?>	
	<?php include __DIR__."/../../_common/epic_phrase.php"; ?>




	<?php 
	
		// --- LOAD Utilizadores, Equipas, Apostas-Podio

		$settings 		= $database->query("SELECT * FROM betting_group WHERE id = ".$group_id)->fetchAll(PDO::FETCH_ASSOC);
		
		$utilizadores 	= $database->query("SELECT * FROM users WHERE Group_id = ".$group_id)->fetchAll(PDO::FETCH_ASSOC);
		$utilizadores	= array_combine(array_column($utilizadores,"id"),$utilizadores);
		
		$equipas 		= $database->query("SELECT id, Name_".$language." Name FROM teams")->fetchAll(PDO::FETCH_ASSOC);
		$equipas		= array_combine(array_column($equipas,"id"),$equipas);
		
		$apostas 		= $database->query("SELECT a.* FROM podium_bets a INNER JOIN users b ON b.id = a.user_id WHERE b.Group_id = ".$group_id." ORDER BY b.Name ASC")->fetchAll(PDO::FETCH_ASSOC);



	?>
	
	<?php 

	// Check if podium bets are locked
	if (true)
		echo $twig->render("podium-bets-list_".$language.".twig.html",array('apostas'=>$apostas,'equipas'=>$equipas,'utilizadores'=>$utilizadores)); 
	else
		echo $twig->render("podium-form_".$language.".twig.html",array('equipas'=>$equipas)); 
	?>



<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') : ?>
	</div>
	</div> <!-- /.container,  -->
	</body>
	</html>
<?php endif; ?>
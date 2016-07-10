<?php

require_once '../_common/log_in_check.php';
require_once '../_common/database_access.php';
global $database, $group_id;

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


// Save cookie if provided through HTTP GET
if(isset($_GET['login-cookie'])) 
	setcookie("login-cookie", $_GET['login-cookie'], time()+3600*24*365,"/");  /* expire in 1 year */


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
	$utilizadores = $database->query("SELECT * FROM users WHERE Group_id = ".$group_id." ORDER BY Name ASC")->fetchAll(PDO::FETCH_ASSOC);
	$edicoes_anteriores = $database->query("SELECT * FROM previous_editions;")->fetchAll(PDO::FETCH_ASSOC); 
	$edicoes_anteriores = array_combine(array_column($edicoes_anteriores,"id"),$edicoes_anteriores);


	echo $twig->render("layout.twig.html",array('utilizadores'=>$utilizadores,'edicoes_anteriores'=>$edicoes_anteriores,'group_id'=>$group_id));
		

?>

        
  




<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') : ?>
</div><!-- /#ajax_page_content -->
</div> <!-- /.container,  -->
</body>
</html>
<?php endif; ?>
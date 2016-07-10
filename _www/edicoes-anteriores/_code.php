<?php
require '../_common/log_in_check.php';

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



	<?php

	// --- READ Utilizadores CSV
	$files = array();
	foreach(scandir(__DIR__) as $file)
	{
		if(strpos($file, ".png") > 0)  	$files[] = array('name'=>$file,'caption'=>str_replace(".png","",$file));
		if(strpos($file, ".jpeg") > 0)  $files[] = array('name'=>$file,'caption'=>str_replace(".jpeg","",$file));
		if(strpos($file, ".jpg") > 0)  	$files[] = array('name'=>$file,'caption'=>str_replace(".jpg","",$file));
	}


	echo $twig->render("layout.twig.html",array('files'=>$files));
		

?>

        
  




<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') : ?>
</div>
</div> <!-- /.container,  -->
</body>
</html>
<?php endif; ?>
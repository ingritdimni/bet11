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
	<?php include __DIR__."/../_common/epic_phrase.php"; ?>


	<?php



	// traditional markdown and parse full text
	$parser = new \cebe\markdown\Markdown();
	
	
?>
<div class="row text-left">
	<div class="hidden-xs col-md-2"></div>
	<div class="col-xs-12 col-md-8">
<?php echo $parser->parse(file_get_contents(__DIR__."/regulamento.md")); ?>
</div>
	<div class="hidden-xs col-md-2"></div>
</div>   
  




<?php if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') : ?>
</div>
</div> <!-- /.container,  -->
</body>
</html>
<?php endif; ?>
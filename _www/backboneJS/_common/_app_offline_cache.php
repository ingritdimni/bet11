<?php header("Content-type: text/plain;"); 
require __DIR__.'/log_in_check.php';
global $user_id, $group_id, $language, $user_developer;
?>CACHE MANIFEST
# v1.0.23
CACHE:
/home/
/home/banner_24_apostadores.png
/_common/menu_banner.png
/_common/countries-flags-shadow.png
<?php
foreach(scandir(__DIR__."/apostadores_images/group_1") as $filename)
{
	if(strpos($filename,".png") > 0)
		echo "/_common/apostadores_images/group_1/".$filename."\n";
}
?>
/fonts/glyphicons-halflings-regular.eot
/fonts/glyphicons-halflings-regular.ttf
/fonts/glyphicons-halflings-regular.woff
/fonts/glyphicons-halflings-regular.woff2
/_common/iPhone_icon_1.png
/_common/bootstrap.min.css
/_common/jquery.min.js
/_common/bootstrap.min.js
/_common/jquery.canvasjs.min.js
/_common/underscore-min.js
/_common/logo_anim/0_anim.png
/_common/logo_anim/1_anim.png
/_common/logo_anim/2_anim.png
/_common/logo_anim/3_anim.png
/_common/logo_anim/4_anim.png

NETWORK:
*
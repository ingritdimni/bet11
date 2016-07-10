<?php global $group_id, $user_developer; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-PT" version="XHTML+RDFa 1.0" >
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <meta id="myviewport_1" name="viewport" content="width=device-width, minimal-ui, user-scalable=no, initial-scale=1, maximum-scale=1">

   <title>ENVMA - Euro 2016 </title>
  <link rel="apple-touch-icon" href="/_common/iPhone_icon_<?php echo $group_id; ?>.png">
  <link href="/_common/bootstrap.min.css" rel="stylesheet" >

<style><?php include __DIR__."/mycss.php"; ?></style>

<script src="/backboneJS/_common/jquery.min.js"   ></script>
<script src="/backboneJS/_common/bootstrap.min.js" ></script>

<script src="/backboneJS/_common/jquery.canvasjs.min.js"></script>
<script src="/backboneJS/_common/underscore-min.js" ></script>
<script src="/backboneJS/_common/backbone-min.js" ></script>
<script src="/backboneJS/_common/routing.js" ></script>
       

<style>
<?php echo file_get_contents(__DIR__."/bootstrap_addon.css"); ?>
	.flag{
		overflow:hidden;
		display:inline-block;
		width:40px;
		height:30px;
		background-image:url('_common/countries-flags-shadow.png')
	}
	.flag-sm {width:20px; height:15px;	background-image:url('_common/countries-flags-shadow_sm.png')}

	.animated_logo{display:none;position:absolute;} 
	.non_animated_logo{position:absolute;}

	/* Extra small devices (phones, less than 768px) */
	@media (max-width: 640px) {.logo_holder, img.base_image {width:640px; height:192px;}}

	/* Small devices (tablets, 768px and up) */
	@media (min-width: 768px) {.logo_holder, img.base_image {width:750px; height:225px;}}

	/* Medium devices (desktops, 992px and up) */
	@media (min-width: 992px) {.logo_holder, img.base_image {width:970px; height:291px;}}

	/* Large devices (large desktops, 1200px and up) */
	@media (min-width: 1200px) {.logo_holder, img.base_image {width:1170px; height:351px;}}		
	
	.hidden_match{display:none;}

</style>
<script>	 
	// Responsive design - for minimum width 580px
	var mvp = document.getElementById('myviewport_1');
	if (window.screen.width < 580)
		mvp.setAttribute('content','width=580');
		
	function show_previous_matches(obj){
		$(obj).closest('div').remove();
		$('.hidden_match').fadeIn();
	}
	
	
	// Check if a new cache is available on page load.
	window.addEventListener('load', function(e) {
	  window.applicationCache.addEventListener('updateready', function(e) {
	    if (window.applicationCache.status == window.applicationCache.UPDATEREADY) {
	      // Browser downloaded a new app cache.
	        window.location.reload();
	    } else {
	      // Manifest didn't changed. Nothing new to server.
	    }
	  }, false);

	}, false);
		
</script>
</head>

<body style="padding:0px;background-color: #000;">
<div class="container" style="text-align:center;background-color: #fff;">
<!-- TOP BANNER -->
<?php //$animated_logo_class = (substr($_SERVER['REQUEST_URI'],0,5) == '/home')?'animated_logo':'non_animated_logo'; 
		$animated_logo_class = 'animated_logo';
?>
<div style="overflow:hidden;margin-left:-15px;margin-right:-15px;" class="logo_holder hidden-xs">
	<div style="text-align:center;position:relative;width:100%;height:100%;">


        <img src="_common/logo_anim/0_anim.png"  class="base_image <?php echo $animated_logo_class; ?>" style="z-position:-10;top:-1px;left:0px;" />
		<div class="wrapper" style="z-position:-9;width:33%;height:23%;top:35%;left:20%;position:absolute;overflow:hidden;">
        	<img src="_common/logo_anim/1_anim.png"  class="<?php echo $animated_logo_class; ?>" style="top:0px;left:+0px;display:inline;width:100%" />
		</div>
		<div class="wrapper" style="z-position:-8;width:33%;height:23%;top:35%;left:54%;position:absolute;overflow:hidden;">
        	<img src="_common/logo_anim/2_anim.png"  class="<?php echo $animated_logo_class; ?>" style="top:0px;left:+0px;display:inline;width:100%;" />
		</div>
        <img src="_common/logo_anim/3_anim.png"  class="<?php echo $animated_logo_class; ?>" style="z-position:-7;top:67%;left:28%;width:39%;" />
        <img src="_common/logo_anim/4_anim.png"  class="<?php echo $animated_logo_class; ?>" style="z-position:-6;top:80%;left:45%;width:32%;" />
      <a href="/home/" title="Home" rel="home" id="logo"></a>

	</div>
</div>


<script>
	jQuery(window).load(function(){
		jQuery("img.animated_logo:eq(0)").fadeIn({queue:'intro',duration:600,complete:function(){jQuery("img.animated_logo:eq(1)").dequeue("intro");}}).dequeue("intro");

		jQuery("img.animated_logo:eq(1)").css('top','100%').animate({'top':'0%'},{queue:'intro',duration:1000,complete:function(){jQuery("img.animated_logo:eq(2)").dequeue("intro");}});
		jQuery("img.animated_logo:eq(2)").css('top','100%').animate({'top':'0%'},{queue:'intro',duration:1000,complete:function(){jQuery("img.animated_logo:eq(3)").dequeue("intro");}});

		jQuery("img.animated_logo:eq(3)").fadeIn({queue:'intro',duration:600,complete:function(){jQuery(this).next().dequeue("intro");}});
		jQuery("img.animated_logo:eq(4)").fadeIn({queue:'intro',duration:600,complete:function(){jQuery(this).next().dequeue("intro");}});

	});

</script>	
<!-- /TOP BANNER -->	
	
<!-- MENU BAR -->
<nav class="navbar navbar-inverse" role="navigation" style="margin-left:-15px;margin-right:-15px;">
	<div class="navbar-header">
		
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		
		<div class="navbar-brand visible-xs" style="padding:0;float:none;">
			<img src="/_common/menu_banner.png" width="80%"></div>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="divider-vertical">
					<a target="_self"  href="/_removecookie.php" title="Logout"><span class="glyphicon glyphicon-new-window"></span></a>
				</li>
				<li class="divider-vertical">
					<a target="_self"  href="#/home/" class="active"><span class="glyphicon glyphicon-home glyphicon-white"></span></a>
				</li>
				<li class="divider-vertical">
					<a target="_self"  href="javascript:void(0)" title="" class="dropdown-toggle active" data-toggle="dropdown">1. APOSTAS <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li class="text-center"><a target="_self"  href="#/apostas/jogos/" title=""><span class="pull-left">1.1.&nbsp;&nbsp;</span> Jogos &nbsp; &nbsp;</a></li>
						<li class="text-center"><a target="_self"  href="#/apostas/podio/" title=""><span class="pull-left">1.2.&nbsp;&nbsp;</span> Pódio &amp; Melhor Marcador &nbsp; &nbsp;</a></li>
					</ul>
				</li>
				<li class="divider-vertical"><a target="_self"  href="#/classificacao/" title="">2. CLASSIFICAÇÃO</a></li>
				<li class="divider-vertical"><a target="_self"  href="#/regulamento/" title="Regulamento">3. REGULAMENTO</a></li>
				<li class="divider-vertical"><a target="_self"  href="#/edicoes-anteriores/">4. EDIÇÕES ANTERIORES</a></li>
			</ul>
		</div>
</nav>


<!-- /MENU BAR-->

<div id="main_content">
</div>

</div><!-- /.container-->

<?php
$underscore_templates = array(
	"/apostas/jogos/layout.tpl.html",
	"/apostas/jogos/list-of-users.tpl.html",
	"/apostas/jogos/match-bet-form.tpl.html"
	
);

foreach($underscore_templates as $underscore_template)
{
	echo '<script type="text/template" id="'.str_replace(array("/",".tpl.html"), array("_",""),$underscore_template).'">';
	echo file_get_contents(__DIR__.$underscore_template);
	echo '</script>';
	
}
	
?>


</body>
</html>

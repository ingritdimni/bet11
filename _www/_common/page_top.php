<?php global $group_id, $user_developer; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-PT" version="XHTML+RDFa 1.0"  
<?php 
if($_SERVER["REQUEST_URI"] == "/home/" ) 
	echo 'manifest="/_common/app_offline_cache.php"'; 
else 
	echo 'manifest="/none"'; ?> >

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <meta id="myviewport_1" name="viewport" content="width=device-width, minimal-ui, user-scalable=no, initial-scale=1, maximum-scale=1">
<base href="/" target="_blank">
   <title>ENVMA - Euro 2016 </title>
  <link rel="apple-touch-icon" href="/_common/iPhone_icon_<?php echo $group_id; ?>.png">
  <link href="/_common/bootstrap.min.css" rel="stylesheet" >

<style><?php include __DIR__."/mycss.php"; ?></style>

<script src="/_common/jquery.min.js"   ></script>
<script src="/_common/bootstrap.min.js" ></script>

<script src="/_common/jquery.canvasjs.min.js"></script>
<script src="/_common/underscore-min.js"></script>
       

<style>
<?php echo file_get_contents(__DIR__."/bootstrap_addon.css"); ?>
	.font-bold {font-weight:bold;}

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





<?php if ($user_developer && false) : ?>
<a href="javascript:$('#meme_modal').modal();" >FOR DEVELOPERS: test meme modal</a>
<?php endif; ?>

<div class="modal fade" tabindex="-1" role="dialog" id="meme_modal">
  <div class="modal-dialog">
    <div class="modal-content">
	 <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><strong>Bernardo Garcia </strong>diz</h4>
	 </div>
	 <div class="modal-body">
			<img src="/_common/user_submitted_memes/abc.png" class="img-responsive"/>
	</div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
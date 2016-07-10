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
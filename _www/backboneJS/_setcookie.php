<?php

	if(!isset($_GET['login-cookie'])) die("ERROR: no cookie provided");

	setcookie("login-cookie", $_GET['login-cookie'], time()+3600*24*365,"/");  /* expire in 1 year */


?>
<html>
<head></head>
	<body>
		CONGRATULATIONS!! <br>Cookie saved, you are logged in.<br><br>
		Wait 2 seconds or... click here to <a href="/home/">start</a>
		
		<script>window.setTimeout(function(){ window.location = "/home/<?php echo "?login-cookie=".$_GET['login-cookie']?>";},2000);</script>
	</body>
</html>
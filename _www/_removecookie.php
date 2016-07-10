<?php

	if (isset($_COOKIE['login-cookie'])) {
	    unset($_COOKIE['login-cookie']);

	    setcookie('login-cookie', null, -1, '/');
	}


?>
<html>
<head></head>
	<body>
		<h1>You have logged out.</h1>
		<script>window.setTimeout(function(){ window.close()},2000);</script>
	</body>
</html>
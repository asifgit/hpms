<?php
	session_start();
	session_destroy();
	header("Location: ../login.php?loggedOut=1");
?>
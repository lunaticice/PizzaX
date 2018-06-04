<?php
	//session_destroy itu untuk hapus semua session yang ada di semua page tetapi hanya satu user local
	session_start();
	session_destroy();

	header("Location: login_admin.php");
	exit();
?>
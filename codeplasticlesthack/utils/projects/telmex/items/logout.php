<?php
	session_start();
	session_unregister('usuario_telmex');
	header ("Location: ../index.php");
?>

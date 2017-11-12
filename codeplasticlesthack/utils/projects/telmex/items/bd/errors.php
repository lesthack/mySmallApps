<?
	if(mysql_errno()==1142)
	{
		print "<h1>Usted no tiene permisos para hacer eso.</h1>";
		print mysql_error()."<br>";
	}
	else
	{
		print mysql_errno()."<br>";
		print mysql_error()."<br>";
	}
		die("Stop to load page.");
?>
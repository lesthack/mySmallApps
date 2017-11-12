<?php 
	$op=addslashes($_REQUEST['option']);
	if($op==1)
		require('reporte_llamadas.php');
	else if($op==2)
		require('graficasGanancias.php');
	else if($op==3)
		require('gComEdos.php');
?>

<?php
	//comprobamos si es simplex
	$phase=1;
	for($i=1;$i<=$_REQUEST["nres"];$i++)
		if($_REQUEST["dir$i"]==2)
			$phase=2;
			
	if($phase==2)
		require_once("phase2b.php");
	else
		require_once("phase2.php");
		
?>

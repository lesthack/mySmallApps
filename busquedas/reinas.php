<?php
	header('Content-Type: text/xml encoding="iso-8859-1"');
	echo  "<?xml version=\"1.0\"?>\n";
	
	$x = $_REQUEST["x"];
	$y = $_REQUEST["y"];
	
	exec("python reinas.py $x $y",$out);
	foreach($out as $line){ 
		print $line."\n"; 
	}

?>

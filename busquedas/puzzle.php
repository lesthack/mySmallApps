<?php
	header('Content-Type: text/xml encoding="iso-8859-1"');
	echo  "<?xml version=\"1.0\"?>\n";
	
	$ini = $_REQUEST["ini"];
	$fin = $_REQUEST["fin"];
	
	exec("python puzzle.py $ini $fin",$out);
	foreach($out as $line){ 
		print $line."\n"; 
	}
	
?>

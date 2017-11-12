<?php

require('bd/connection.php'); 

	$bd = new connection_telmex;  
	
	$query="SELECT *  FROM `07_plan`";
	
	
$result= $bd->query($query);
    
	    header('Content-Type: text/xml encoding="iso-8859-1"');
		$xml="<?xml version=\"1.0\"?>";
		$xml.="<planes>";
		 


  while ($row = mysql_fetch_row($result)){
          $xml.="<plan>";
		  
          $xml.="<Numeroplan>".$row[0]."</Numeroplan>";
		  $xml.="<Beneficio>".$row[1]."</Beneficio>";
		  $xml.="<Nacional>".$row[2]."</Nacional>";
		  $xml.="<Estatal>".$row[3]."</Estatal>";
		  $xml.="<Local>".$row[4]."</Local>";
		  $xml.="<Renta>".$row[5]."</Renta>";
          $xml.="</plan>";
          
       }
	   
       $xml.="</planes>";
	   echo utf8_encode($xml);

?>
<?php

require('bd/connection.php'); 

	$bd = new connection_telmex;  
	
	$query="SELECT edo_lada  FROM `07_lada` group by edo_lada";
	
	$result= $bd->query($query);		
	header('Content-Type: text/xml encoding="iso-8859-1"');
	echo "<?xml version=\"1.0\"?>";
	echo "<Estados>";
			while ($row = mysql_fetch_row($result)){
			
			$consulta="SELECT *  FROM `07_lada` WHERE edo_lada='".$row[0]."'";
			 echo "<Estado>";
					 echo "<Nombre>".utf8_encode($row[0])."</Nombre>";
					 
					$estado= $bd->query($consulta);	
					
						$numero = mysql_num_fields($estado);										
					
					while ($row2 = mysql_fetch_row($estado)){
					echo "<Municipios> <Nombre>".utf8_encode($row2[1])."</Nombre>";
					echo "<Lada>".utf8_encode($row2[0])."</Lada>";		
					
					
					echo "</Municipios>";
					
					}
				echo "</Estado>";
					 
				}
				echo "</Estados>";

?>
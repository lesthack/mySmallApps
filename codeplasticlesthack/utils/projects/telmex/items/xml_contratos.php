<?php

require('bd/connection.php'); 

	$bd = new connection_telmex;  
	
	$query="SELECT *  FROM `07_contrato` ";
	
	$result= $bd->query($query);		
	
	header('Content-Type: text/xml encoding="iso-8859-1"');
	echo "<?xml version=\"1.0\"?>";
	echo utf8_encode("<contratos>");
	
	 while ($row = mysql_fetch_row($result)){
	 echo utf8_encode("<contrato>");
				
		  echo"<id_contrato>";         
		       echo utf8_encode($row[0]);
	      echo"</id_contrato>"; 
		  echo"<telefono>";         
		       echo utf8_encode($row[1]);
	      echo"</telefono>";        
		    echo"<id_plan>";         
		       echo utf8_encode($row[3]);		   
	      echo"</id_plan>"; 
		  echo"<id_lada>";         
		       echo utf8_encode($row[2]);
	      echo"</id_lada>"; 		  
				$query2="SELECT cd_lada,edo_lada  FROM `07_lada` WHERE id_lada=".$row[2];
				$result2= $bd->query($query2);
				$row2 = mysql_fetch_row($result2);
					echo "<ciudad>";
					echo utf8_encode($row2[0]);
					echo "</ciudad>";
					echo "<estado>";
					echo utf8_encode($row2[1]);
					echo "</estado>";
		  
		  echo"<nombre_cte>";         
		       echo utf8_encode($row[3]);
	      echo"</nombre_cte>";  
		  echo"<direccion>";         
		       echo utf8_encode($row[0]);
	      echo"</direccion>"; 
		  echo"<cp>";         
		       echo utf8_encode($row[1]);
	      echo"</cp>";        
		  echo"<saldo>";         
		       echo utf8_encode($row[2]);
	      echo"</saldo>"; 

		  
			 
          
     echo"</contrato>";
       }
	
	echo"</contratos>";

?>

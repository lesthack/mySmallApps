<?php

		function validate($dato, $acotacion){
			if(!$dato)
				die("<b>La operacion no se llevo a cabo. Falta el campo $acotacion.</b>");
		}

		function formatID($id){
			$n=15-strlen($id);
			$cad="";

			for($i=0;$i<$n;$i++)
				$cad.="0";
		
			return $cad.$id;
		}
	
		function permission(){
			if($_SESSION['usuario_telmex']){
		
				if(!connection_telmex)
					require('bd/connection.php'); 
					 
				if(!$bd)
					$bd = new connection_telmex;

				$id_usuario = $_SESSION['usuario_telmex'];
				$query = "SELECT * FROM 07_usuario WHERE id_usuario='$id_usuario'";
				$result = $bd->query($query);	
				$row = mysql_fetch_array($result);
			
				if($row['tipo']==2)
					return true;
				else
					return false;
			}
			else
				return false;
		}
	
?>

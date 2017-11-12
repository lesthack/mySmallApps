<?php
	
	class user{
		var $id_usuario;
		var $contrasena;		
		var $tipo;
	
		function user(){
		}
		
		function set_values($row){
			$this->id_usuario = $row["id_usuario"];
			$this->contrasena = $row["contrasena"];
			$this->tipo = $row["tipo"];
		}
	}

?>

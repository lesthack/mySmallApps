<?php
	session_start();

	require('bd/connection.php'); //llamamos a nuestra libreria conexion
	require('user.php'); //llamamos a nuestra usuario		

	//seccion de instanciacion a la clase connection_telmex
		$bd = new connection_telmex;  //hacemos la conexion.

	//creamos usuario
		$user = new user();	
	
	//seccion donde recibimos datos
		$username=addslashes($_REQUEST['username']);
		$password=addslashes($_REQUEST['password']);
		$page=addslashes($_REQUEST['page']);
		
	
	if($_SESSION['usuario_telmex']){
	
		$id_usuario = $_SESSION['usuario_telmex'];

		$query = "SELECT * FROM 07_usuario WHERE id_usuario='$id_usuario'";
		$result = $bd->query($query);

		$row = mysql_fetch_array($result);
		
		if(!$row) $error=1;
		else if($row['tipo']==0) $error=2;
		
		if($error) header("Location: error.php?error=$error");
		
		
		if($page==1)//contratos
			require('contratos.php');
		else if($page==2)//planes
			require('planes.php');
		else if($page==3)//ladas
			require('ladas.php');
		else if($page==4)//reportes
			require('reportes.php');
		else if($page==5)//administrador
			require('administrador.php');
		else if($page==6)//llamadas
			require('uppLlamadas.php');																								
		else
			require('panel.php');
	}
	else{
		if(empty($username) || empty($password)){
			require("login.php");
		}
		else
		{
			$query = "select * from 07_usuario where id_usuario='$username' and contrasena='$password' and tipo!=0"; //para solo administradores
				$result = $bd->query($query);
				$num = mysql_num_rows($result);
				
			if($num){
				$row = mysql_fetch_array($result);
				$user->set_values($row);
				
				$_SESSION['usuario_telmex']=$user->id_usuario;
				
				require('panel.php');
			}
			else{
				require("login.php");
			}
		}
	}
?>

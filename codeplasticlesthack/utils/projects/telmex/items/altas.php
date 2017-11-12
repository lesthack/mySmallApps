<?php
	require_once('utils.php'); 
	
	if(!$bd){
		require('bd/connection.php'); 
			$bd = new connection_telmex; 
	}
		
	$op=addslashes($_REQUEST['option']);
	if($op==1){ //contratos
	
		$nombre = addslashes($_REQUEST['nombre']);
		$direccion = addslashes($_REQUEST['direccion']);
		$estado = addslashes($_REQUEST['estado']);
		$ciudad = addslashes($_REQUEST['ciudad']);
		$cp = addslashes($_REQUEST['cp']);
		$telefono = addslashes($_REQUEST['telefono']);
		$plan = addslashes($_REQUEST['plan']);
		$lada = addslashes($_REQUEST['lada']);
		
		//validando
		validate($nombre,"Nombre");
		validate($direccion,"Direccion");
		validate($estado,"Estado");
		validate($ciudad,"Ciudad");
		validate($cp,"Código Postal");
		validate($telefono,"Telefono");
		validate($plan,"Plan");
		
		$query = "SELECT id_contrato FROM 07_contrato ORDER BY id_contrato DESC";
		$result = $bd->query($query);
		$row = mysql_fetch_array($result);
		$id_contrato = 1 + $row['id_contrato'];
		$id_contrato=formatID($id_contrato);

		//Contratos	
		$query = "INSERT INTO 07_contrato(id_contrato, telefono, id_lada, id_plan, nombre_cte, direccion, cp, redondeo, saldo)
								VALUES('$id_contrato','$telefono','$lada','$plan','$nombre','$direccion','$cp','0','0');
		";
		$bd->query($query);
		
		//usuarios
		$query = "INSERT INTO 07_usuario(id_usuario, contrasena, tipo)
								VALUES('$id_contrato','$id_contrato','0');
		";
		$bd->query($query);
		
		echo "<b>Contrato agregado con exito </b>";
		
	}
	else if($op==2){//ladas
		$estado = addslashes($_REQUEST['estado']);
		$ciudad = addslashes($_REQUEST['ciudad']);
		$lada = addslashes($_REQUEST['lada']);
		
		//validando
		validate($lada,"Lada");
		validate($ciudad,"Ciudad");
		validate($estado,"Estado");
	
		//comprobamos si no existe esa lada
		$query = "SELECT * FROM 07_lada WHERE id_lada like '$lada'";
		$result = $bd->query($query);
		
		$num = mysql_num_rows($result);

		if($num!=0)
			die("<b>El registro lada $lada ya existe, compruebe de nuevo. Gracias</b>");
		
		//ladas
		$query = "INSERT INTO 07_lada(id_lada, cd_lada, edo_lada)
								VALUES('$lada','$ciudad','$estado');
		";
		$bd->query($query);
		
		echo "<b>Nueva Lada agregada exitosamente</b>";
	}
	else if($op==3){//planes
		$beneficio = addslashes($_REQUEST['beneficio']);
		$lada_pico = addslashes($_REQUEST['lada_pico']);
		$lada_nopico = addslashes($_REQUEST['lada_nopico']);
		$local = addslashes($_REQUEST['local']);
		$renta = addslashes($_REQUEST['renta']);
		
		validate($beneficio,"Beneficio");
		validate($lada_pico,"Cuota Lada Pico");
		validate($lada_nopico,"Cuota Lada No-Pico");
		validate($local,"Cuota Local");
		validate($renta,"Cuota Renta");
		
		$query = "SELECT id_plan from 07_plan ORDER BY id_plan DESC";
		$result = $bd->query($query);
		
		$row = mysql_fetch_array($result);
		
		$id_plan = 1 + $row['id_plan'];
		
		$query = "INSERT INTO 07_plan(id_plan, beneficio, lada_pico, lada_nopico, local, renta)
								VALUES('$id_plan','$beneficio','$lada_pico', '$lada_nopico','$local','$renta');
		";
		$bd->query($query);
		
		echo "<b>Nuevo Plan $id_plan agregado exitosamente</b>";
	}
	else if($op==4){//administrador
		$nombre = addslashes($_REQUEST['nombre']);
		$cargo = addslashes($_REQUEST['cargo']);
		$telefono = addslashes($_REQUEST['telefono']);
		$direccion = addslashes($_REQUEST['direccion']);
		$lada = addslashes($_REQUEST['lada']);
		$cp = addslashes($_REQUEST['cp']);
		$tipo = addslashes($_REQUEST['tipo']);
		$passwod = addslashes($_REQUEST['password']);
		$repasswod = addslashes($_REQUEST['repassword']);
		
		validate($nombre,"Nombre");
		validate($cargo,"Cargo");
		validate($telefono,"Telefono");
		validate($direccion,"Direccion");
		validate($lada,"Lada");
		validate($cp,"Código Postal");
		validate($password,"Password");
		validate($repassword,"Segundo Password");
		
		$query = "SELECT id_administrador FROM 07_administrador ORDER BY id_administrador DESC";
		$result = $bd->query($query);
		$row = mysql_fetch_array($result);
		
		$id_admin = 1 + $row['id_administrador'];
		$id_admin = formatID($id_admin);
		
		//admin
		$query = "INSERT INTO 07_administrador(id_administrador, nombre, cargo, telefono, direccion, cp, id_lada)
								VALUES('$id_admin','$nombre','$cargo', '$telefono','$direccion','$cp','$lada');
		";
		$bd->query($query);
	
		//usuarios
		$query = "INSERT INTO 07_usuario(id_usuario, contrasena, tipo)
								VALUES('$id_admin','$password','$tipo');
		";
		$bd->query($query);
		
		echo "<b>Nuevo Usuario agregado exitosamente</b>";
	}
	else
		echo "<b>Ninguna acción</b>";
?>

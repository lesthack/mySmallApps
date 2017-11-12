<?php
	require_once('utils.php'); 
	
	if(!$bd){
		require('bd/connection.php'); 
		$bd = new connection_telmex; 
	}

	$op=addslashes($_REQUEST['option']);
	
	
	if($op==1){ //contratos
	
		$id_contrato = addslashes($_REQUEST['id_contrato']);
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
		
		$query="UPDATE 07_contrato SET 
			nombre_cte='$nombre', 
			direccion='$direccion',
			id_plan='$plan',
			id_lada='$lada',
			cp='$cp',
			telefono='$telefono',
			redondeo='0',
			saldo='0'
		WHERE id_contrato='$id_contrato'";
		
		$bd->query($query);
		
		echo "<b>Registro $id_contrato modificado</b>";		
	}
	else if($op==2){//ladas
		$estado = trim(addslashes($_REQUEST['estado']));
		$ciudad = trim(addslashes($_REQUEST['ciudad']));
		$lada = trim(addslashes($_REQUEST['lada']));
		
		//validando
		validate($lada,"Lada");
		validate($ciudad,"Ciudad");
		validate($estado,"Estado");
		
		//ladas
		$query = "UPDATE 07_lada SET 
				cd_lada='$ciudad', 
				edo_lada='$estado' 
			WHERE id_lada='$lada'
		";
		
		$bd->query($query);
		
		echo "<b>Registro Lada $lada modificado</b>";
	}
	else if($op==3){//planes
		$id_plan = addslashes($_REQUEST['id_plan']);
		$beneficio = addslashes($_REQUEST['beneficio']);
		$lada_pico = addslashes($_REQUEST['lada_pico']);
		$lada_nopico = addslashes($_REQUEST['lada_nopico']);
		$local = addslashes($_REQUEST['local']);
		$renta = addslashes($_REQUEST['renta']);
		
		//validando
		validate($id_plan,"Plan");
		validate($beneficio,"Beneficio");
		validate($lada_pico,"Cuota Lada Pico");
		validate($lada_nopico,"Cuota Lada No-Pico");
		validate($local,"Cuota Local");
		validate($renta,"Cuota Renta");
		
		//planes
		$query="UPDATE 07_plan SET 
			beneficio='$beneficio',
			lada_pico='$lada_pico',
			lada_nopico='$lada_nopico',
			local='$local',
			renta='$renta' 
		WHERE id_plan='$id_plan'
		";
		
		$bd->query($query);
		
		echo "<b>Plan $id_plan modificado</b>";
	}	
	else if($op==4){
		$id_admin = addslashes($_REQUEST['id_admin']);
		$nombre = addslashes($_REQUEST['nombre']);
		$cargo = addslashes($_REQUEST['cargo']);
		$telefono = addslashes($_REQUEST['telefono']);
		$direccion = addslashes($_REQUEST['direccion']);
		$lada = addslashes($_REQUEST['lada']);
		$cp = addslashes($_REQUEST['cp']);
		$tipo = addslashes($_REQUEST['tipo']);
		$passwod = addslashes($_REQUEST['password']);
		$repasswod = addslashes($_REQUEST['repassword']);
		
		validate($id_admin,"ID");
		validate($nombre,"Nombre");
		validate($cargo,"Cargo");
		validate($telefono,"Telefono");
		validate($direccion,"Direccion");
		validate($lada,"Lada");
		validate($cp,"Código Postal");
		validate($password,"Password");
		validate($repassword,"Segundo Password");
		
		//administrador
		$query = "UPDATE 07_administrador SET 
			nombre='$nombre',
			cargo='$cargo',
			telefono='$telefono',
			direccion='$direccion',
			cp='$cp',
			id_lada='$lada'
		WHERE id_administrador='$id_admin'
		";
		$bd->query($query);
		
		//usarios
		$query = "UPDATE 07_usuario SET 
			contrasena='$password',
			tipo='$tipo'
		WHERE id_usuario='$id_admin'
		";
		$bd->query($query);
		
		echo "<b>Usuario $id_admin modificado</b>";
	}
	else
		echo "nothing";
?>
















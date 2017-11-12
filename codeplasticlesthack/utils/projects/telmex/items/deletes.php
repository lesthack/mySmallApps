<?php
	require_once('utils.php');
	 
	if(!$bd){
		require('bd/connection.php'); 
		$bd = new connection_telmex; 
	}	
	
	$op=addslashes($_REQUEST['option']);
	
	if($op==1){//Contratos

		$id_contrato=addslashes($_REQUEST['id_contrato']);
		validate($id_contrato,"ID Contrato");
		
		$query="DELETE FROM 07_contrato WHERE id_contrato='$id_contrato'";
		$bd->query($query);
		
		$query="DELETE FROM 07_usuario WHERE id_usuario='$id_contrato'";
		$bd->query($query);
		
		echo "<b>Registro $id_contrato Eliminado</b>";
	}
	else if($op==2){//Ladas
		$id_lada=addslashes($_REQUEST['id_lada']);
		validate($id_lada,"Lada");
				
		$query="DELETE FROM 07_lada WHERE id_lada='$id_lada'";
		$bd->query($query);
		
		echo "<b>Lada $id_lada Eliminada</b>";
	}
	else if($op==3){//planes
		$id_plan=addslashes($_REQUEST['id_plan']);
		validate($id_plan,"Plan");
				
		$query="DELETE FROM 07_plan WHERE id_plan='$id_plan'";
		$bd->query($query);
		
		echo "<b>Plan $id_plan Eliminado</b>";
	}
	else if($op==4){//administrador
		$id_admin=addslashes($_REQUEST['id_admin']);
		validate($id_admin,"ID administrador");
				
		$query="DELETE FROM 07_administrador WHERE id_administrador='$id_admin'";
		$bd->query($query);
		
		$query="DELETE FROM 07_usuario WHERE id_usuario='$id_admin'";
		$bd->query($query);
		
		echo "<b>Usuario $id_admin Eliminado</b>";	
	}
	else
		echo "<b>Ninguna acción</b>";
?>

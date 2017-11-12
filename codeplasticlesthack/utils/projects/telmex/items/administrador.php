<?php
	require("utils.php");
	
	if(!connection_telmex)
		require('bd/connection.php'); 
		
	if(!$bd)
		$bd = new connection_telmex; 

	$op=addslashes($_REQUEST['option']);
	
	if($op==1){
		$id_admin=addslashes($_REQUEST['id_admin']);
		$alter=addslashes($_REQUEST['alter']);
		
		$query="select * from 07_administrador JOIN 07_usuario ON 07_administrador.id_administrador=07_usuario.id_usuario 
				WHERE id_administrador='$id_admin'";
		$result = $bd->query($query);
		
		$row=mysql_fetch_array($result);
		
?>
<div id="administrador">
	<form id="datos_usuario">
	<h1 class="titulo">:: Datos Usuario</h1>
		    <div class="subform">
				<table>
					<tr>                    
					   <td>
							<label for="nombre">
								<span>*</span> Nombre:
							</label>
						</td>
						<td>    
							<input type="text" name="nombre" id="nombre" size="40" maxlength="100" <?php echo $row?"value='$row[nombre]'":"value=''"; ?> /> 
						</td>
						<td>
							<label class="acotacion"> :: ejemplo: Perez Martinez Jose  </label>
						</td>
					</tr>   
					<tr>
						<td>
							<label for="cargo">
								<span>*</span> Cargo:
							</label>
						</td>
						<td>    
							<input type="text" name="cargo" id="cargo" size="40" maxlength="20" <?php echo $row?"value='$row[cargo]'":"value=''"; ?> />
						</td>
						<td>
							<label class="acotacion"> :: ejemplo: Gerente </label>
						</td>
					</tr>   
					<tr>
						<td>
							<label for="telefono">
								<span>*</span> Telefono:
							</label>
						</td>
						<td>    
							<input type="text" name="telefono" id="telefono" size="10" maxlength="7" <?php echo $row?"value='$row[telefono]'":"value=''"; ?> />
						</td>
						<td>
							<label class="acotacion"> :: ejemplo: 1552145 </label>
						</td>
					</tr>   
					<tr>
						<td>
							<label for="direccion">
								<span>*</span> Direccion:
							</label>
						</td>
						<td>    
							<input type="text" name="direccion" id="direccion" size="40" maxlength="100" <?php echo $row?"value='$row[direccion]'":"value=''"; ?> />
						</td>
						<td>
							<label class="acotacion"> :: ejemplo: Calz. de las lagrimas #110 </label>
						</td>
					</tr>   
					<tr>
						<td>
							<label for="lada">
								<span>*</span> Lada:
							</label>
						</td>
						<td>    
							<input type="text" name="lada" id="lada" size="10" maxlength="3" <?php echo $row?"value='$row[id_lada]'":"value=''"; ?> />
						</td>
						<td>
							<label class="acotacion"> :: ejemplo: 411 [3 digitos] </label>
						</td>
					</tr>   
					<tr>
						<td>
							<label for="cp">
								<span>*</span> Codigo postal:
							</label>
						</td>
						<td>    
							<input type="text" name="cp" id="cp" size="5" maxlength="5" <?php echo $row?"value='$row[cp]'":"value=''"; ?> />
						</td>
						<td>
							<label class="acotacion"> :: ejemplo: Guanajuato </label>
						</td>
					</tr>   
				</table>
			</div>
	</form>
	<form id="datos_admin">
	<h1 class="titulo">:: Datos sobre Politicas del Usuario</h1>
	    <div class="subform">
		    <table>
				<tr>                    
					<td>
						<label for="tipo">
							<span>*</span> Tipo:
						</label>
					</td>
					<td>    
						<select id="tipo" name="tipo" /> 
							<option value="1">Gerente</option>
							<option value="2">Administrador</option>
						</select>
					</td>
					<td>
						<label class="acotacion"> :: Eliga dependiendo del Cargo </label>
					</td>
				</tr>
				<tr>                    
					<td>
						<label for="password">
							<span>*</span> Contraseña:
						</label>
					</td>
					<td>    
						<input type="password" id="password" name="password" size="15" maxlength="10" <?php echo $row?"value='$row[contrasena]'":"value=''"; ?> />
					</td>
					<td>
						<label class="acotacion"> :: Use un password de una longitud mayor a 5. Use numeros, letras y simbolos </label>
					</td>
				</tr>
				<tr>                    
					<td>
						<label for="repassword">
							<span>*</span> Repita Contraseña:
						</label>
					</td>
					<td>    
						<input type="password" id="repassword" name="repassword" size="15" maxlength="10" <?php echo $row?"value='$row[contrasena]'":"value=''"; ?> />
					</td>
					<td>
					</td>
				</tr>
			</table>
	    </div>
	</form>
<?php
	if($alter){
?>
		<form id="control" name="control">
               <div class="botones">
                	<input type='button' value='Cancelar' id='bt_cancelar' name='bt_cancelar' class='hide' />
					<input type='button' value='Modificar' id='bt_modificar' name='bt_modificar' />
					<input type='submit' value='Actualizar' id='bt_actualizar' name='bt_actualizar' class='hide' <?php echo permission()?"":"disabled"; ?> />
					<input type='button' value='Eliminar' id='bt_eliminar' name='bt_eliminar' <?php echo permission()?"":"disabled"; ?> />
                </div>
		</form>
<?php
	}
	else{
?>
		<form id="control" name="control">
               <div class="botones">
					<input type="button" value="Reset" id="bt_reset" name="bt_reset" />
					<input type="submit" value="Insertar" />
                </div>
		</form>
<?php
	}
?></div>
<script language="javascript" type="text/javascript">
<?php 
	if(!$alter){
?>	
	//para consultar
	$('bt_reset').addEvent('click', function(){
		Form.reset('datos_usuario');
	});

	$('control').addEvent('submit', function(e){
		new Event(e).stop();
		
		//validando la contraseña
		if(!Form.passwords('password','repassword'))
			return site.putMessage("Las contraseñas no son iguales");
			
		//validando
		if(!Form.validate('datos_usuario') || !Form.validate('datos_admin'))
			return site.putMessage("Datos incompletos");
		
		parametros="option=4&";
		parametros+=Form.getParametersByPHP('datos_usuario')+"&";
		parametros+=Form.getParametersByPHP('datos_admin');
		
		new _Ajax({
			method: 'post',
			url: "items/altas.php",
			data: parametros,
			update: $('messages'),
			onComplete: function(){
				Form.reset('datos_usuario');
				Form.reset('datos_admin');
			}
		}).request();
	});
<?php
	}
	else{
?>
	$('tipo').value = <?php echo $row['tipo']; ?>
	//para modificar
	$('control').addEvent('submit', function(e){
		new Event(e).stop();
		
		//validando
		if(!Form.validate('datos_usuario') || !Form.validate('datos_admin'))
			return site.putMessage("Datos incompletos");
		
		//validando la contraseña
		if(!Form.passwords('password','repassword'))
			return site.putMessage("Las contraseñas no son iguales");
		
		parametros="option=4&id_admin=<?php echo $id_admin; ?>&";
		parametros+=Form.getParametersByPHP('datos_usuario')+"&";
		parametros+=Form.getParametersByPHP('datos_admin');

		new _Ajax({
			method: 'post',
			url: "items/modificaciones.php",
			data: parametros,
			update: $('messages'),
			onComplete: function(){
				$('bt_cancelar').click();
			}
		}).request();
		
	});
	
	$('bt_modificar').addEvent('click', function(){
		Form.enable('datos_usuario');
		Form.enable('datos_admin');
		$('bt_cancelar').removeClass('hide');
		$('bt_actualizar').removeClass('hide');
		$('bt_modificar').addClass('hide');
	});
	
	$('bt_cancelar').addEvent('click', function(){
		Form.disable('datos_usuario');
		Form.disable('datos_admin');
		$('bt_cancelar').addClass('hide');
		$('bt_actualizar').addClass('hide');
		$('bt_modificar').removeClass('hide');
	});
	
	$('bt_eliminar').addEvent('click', function(){
		if(!confirm("¿Estas seguro de eliminar el Usuario seleccionado?"))
			return;
		parametros = "option=4&id_admin=" + seleccionado.getAttribute('id');
		new _Ajax({
			method: 'post',
			url: "items/deletes.php",
			data: parametros,
			update: $('messages'),
			evalScripts: true,
			onComplete: function(){
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=5",
					update: $('content'),
					evalScripts: true
				}).request();
			}
		}).request();
	});
	
<?php
	}
	if($alter)
		echo "
			Form.disable('datos_usuario');
			Form.disable('datos_admin');
		";
?>			
</script>
<?php
	}
	else{
?>
<div id="administrador">
	<form id="consulta">
		<div class="subform">
			<label for="consulta">Consulta: </label>
			<input type="text" id="valor" name="valor" size="50"  maxlength="100" />
			<label for="por">por: </label>
			<select id="por" name="por" >
				<option value="id_administrador">ID</option>
				<option value="nombre">Nombre</option>
				<option value="tipo">Tipo</option>
				<option value="telefono">Telefono</option>
				<option value="id_lada">Lada</option>
				<option value="cp">Código Postal</option>
			</select>
			<input type="submit" value="Filtrar" id="bt_filtrar" name="bt_filtrar" />
		</div>
	</form>
	<form id="resultados">
		<div class="hresult subform">
			<p>
				Seleccione el registro en el cual quiere realizar alguna operación.
			</p>
			<table class="result">
				<thead>
					<tr>
						<th width="200px">ID</th>
						<th width="400px">Nombre</th>
						<th width="200px">Tipo</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$by=addslashes($_REQUEST['by']);
					$valor=addslashes($_REQUEST['valor']);

					$query="SELECT * FROM 07_administrador join 07_usuario on 07_administrador.id_administrador=07_usuario.id_usuario ";
					
					if($by)
						$query.=" WHERE $by LIKE '$valor'";
					
					$query.="ORDER BY id_administrador";
					
					$result = $bd->query($query);
					$classe=true;			
					while($row=mysql_fetch_array($result)){
						if($classe){$class="one";$classe=false;}
						else{$class="";$classe=true;}
						echo "
						<tr id='$row[id_administrador]' class='$class' onclick='onclickHandler(this);'>
							<td>$row[id_administrador]</td>
							<td>$row[nombre]</td>
							<td>".($row['tipo']==1?"Gerente":"Administrador")."</td>
						</tr>
						";
					}
				
				?>
					
				</tbody>
			</table>
		</div>
	</form>
	<form id="control">
		<div class="botones">
			<input type="button" value="Consultar" id="bt_consultar" />
			<input type="button" value="Eliminar" id="bt_eliminar" <?php echo permission()?"":"disabled"; ?> />
		</div>
	</form>

</div>
<script language="javascript" type="text/javascript">
	seleccionado=null;
	
	$('consulta').addEvent('submit', function(e){
		new Event(e).stop();

		parametros = 'page=5&by=' + $('por').value + '&valor=' + $('valor').value;
		
		new _Ajax({
				method: 'post',
				url: "items/validate.php",
				data: parametros,
				update: $('content'),
				evalScripts: true
			}).request();
	});

	$('bt_eliminar').addEvent('click', function(){
		if(!seleccionado)
			alert("No ha elegido un contrato. Gracias"); 
		else{
			if(!confirm("¿Estas seguro de eliminar el Usuario seleccionado?"))
				return;
			parametros = "option=4&id_admin=" + seleccionado.getAttribute('id');
			new _Ajax({
				method: 'post',
				url: "items/deletes.php",
				data: parametros,
				update: $('messages'),
				evalScripts: true,
				onComplete: function(){
					var padre = seleccionado.parentNode;
					padre.removeChild(seleccionado);
					seleccionado=null;
				}
			}).request();
		}
	});
	
	$('bt_consultar').addEvent('click', function(){
		if(!seleccionado)
			alert("No ha elegido un contrato. Gracias"); 
		else{
			parametros = "page=5&option=1&alter=true&id_admin=" + seleccionado.getAttribute('id');
			new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: parametros,
					update: $('content'),
					evalScripts: true
				}).request();
		}
	});
		
	function onclickHandler(element) {
        if(seleccionado) 
        	$(seleccionado).removeClass("select");

        $(element).addClass('select');
        seleccionado=element;
	}	
</script>
<?php
	}
?>

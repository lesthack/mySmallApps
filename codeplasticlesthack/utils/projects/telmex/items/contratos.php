<?php
	require("utils.php");
	
	if(!connection_telmex)
		require('bd/connection.php'); 
		
	if(!$bd)
		$bd = new connection_telmex; 
	
	$op=addslashes($_REQUEST['option']);
		
	if($op==1){
		$id_contrato=addslashes($_REQUEST['id_contrato']);
		$alter=addslashes($_REQUEST['alter']);
		
		$query="select * from 07_contrato where id_contrato='$id_contrato'";
		$result = $bd->query($query);
		
		$row=mysql_fetch_array($result);
		
		$query="select edo_lada, cd_lada from 07_lada where id_lada='$row[id_lada]'";
		$result = $bd->query($query);
		
		$row2=mysql_fetch_array($result);
		
		$estado=$row2['edo_lada'];
		$ciudad=$row2['cd_lada'];
		$id_plan=$row['id_plan']
?>
<div id="contratos">
	<p>
		La informacion se encuentra dividida en secciones para mejorar su visivilidad y usavilidad. Ingrese los datos correspondientes en el formulario.
	</p>
	<form id="datos_personales">
		<h1 class="titulo">:: Datos Personales</h1>
		<div class="subform">
			<table>
					<tr>
						<td>
							<label for="nombre">
								<span>*</span> Nombre:
							</label>
						</td>
						<td>
							<input type="text" name="nombre" id="nombre" size="40" maxlength="100" <?php if($row) echo "value='$row[nombre_cte]'"; ?> />
						</td>
						<td>
							<label class="acotacion">
								:: Ejemplo: Hernández Patiño Ricardo 
							</label>
						</td>
					</tr>
					<tr>
						<td>
							<label for="direccion">
								<span>*</span> Dirección:
							</label>
						</td>
						<td>
							<input type="text" name="direccion" id="direccion" size="40" maxlength="100" <?php if($row) echo "value='$row[direccion]'"; ?> />
						</td>
						<td>
							<label class="acotacion">
								:: Direccion del cliente incluyendo el numero.
							</label>
						</td>
					</tr>
					<tr>
						<td>
							<label for="estado">
								<span>*</span> Estado:
							</label>
						</td>
						<td>
							<select id="estado" name="estado">
								<option <?php if($row) echo "value='$estado'"; ?>> <?php echo $estado; ?> </option>
							</select>
						</td>
						<td>
							<label class="acotacion">
								:: Estado de la dirección del cliente.
							</label>
						</td>
					</tr>
					<tr>
						<td>
							<label for="ciudad">
								<span>*</span> Ciudad:
							</label>
						</td>
						<td>
							<select id="ciudad" name="ciudad" >
								<option <?php if($row) echo "value='$ciudad'"; ?>> <?php echo $ciudad; ?></option>
							</select>
						</td>
						<td>
							<label class="acotacion">
								:: Ciudad de la dirección del cliente.
							</label>
						</td>
					</tr>
					<tr>
						<td>
							<label for="cp">
								<span>*</span> Código Postal:
							</label>
						</td>
						<td>
							<input type="text" id="cp" name="cp" size="10" maxlength="5" <?php if($row) echo "value='$row[cp]'"; ?> />
							<input type="hidden" id="lada" name="lada" size="10" maxlength="5" <?php if($row) echo "value='$row[id_lada]'"; ?> />
						</td>
						<td>
							<label class="acotacion">
								:: Codigo Postal de la dirección del cliente.
							</label>
						</td>
					</tr>
				</table>
		</div>
	</form>
	<form id="datos_contrato">
		<h1 class="titulo">:: Información sobre el contrato</h1>
		<div class="subform">
			<table>
				<tr>
					<td>
						<label for='telefono'>
							Telefono asignado:
						</label>
					</td>
					<td>
						<?php
							if($row) 
								$telefono=$row['telefono'];
							else{
								$query="select telefono from 07_contrato order by telefono DESC";
								$result = $bd->query($query);
							
								$row=mysql_fetch_array($result);
								$telefono = 1+$row['telefono'];
							}
							echo "<input type='text' size='10' maxlength='7' id='telefono' name='telefono' value='$telefono' readonly='readonly'/>";
						?>
					</td>
					<td>
						<label class="acotacion">
							:: El telefono mostrado fue generado por el sistema.
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<label for='plan'>
							<span>*</span> Plan:
						</label>
					</td>
					<td>
						<select id="plan" name="plan">
							<option <?php echo $id_plan?"value='$id_plan'":"value=''"; ?>> <?php echo $id_plan?"Plan $id_plan":""; ?></option>
							<?php

									$query="select * from 07_plan";
									$result = $bd->query($query);
								
									while($row=mysql_fetch_array($result))
										if($row['id_plan']!=$id_plan)
 											echo "<option value='$row[id_plan]'>Plan $row[id_plan]</option>";

							?>
						</select>
					</td>
					<td>
						<label class="acotacion">
							:: Seleccione un plan.
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							Saldo:
						</label>
					</td>
					<td>
						<?php echo $row['saldo']?money_format("%(#10n",$row['saldo']):"$ 0.00"; ?>
					</td>
					<td>
						<label class="acotacion">
							:: Saldo inicial del nuevo usuario.
						</label>
					</td>
				</tr>
				<tr>
					<td>
						<label>
							Redondeo:
						</label>
					</td>
					<td>
						<?php echo $row['redondeo']?money_format("%(#10n",$row['redondeo']):"$ 0.00"; ?>
					</td>
					<td>
						<label class="acotacion">
							:: Redondeo inicial del nuevo usuario.
						</label>
					</td>
				</tr>
			</table>
		</div>
	</form>
<?php
	if($alter){
?>
		<form id='control'>
			<div class='botones'>
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
		<form id='control'>
			<div class='botones'>
				<input type='button' value='Reset' id='bt_reset' name='bt_reset' />
				<input type='submit' value='Insertar' id='bt_insertar' name='bt_insertar' />
			</div>
		</form>
<?php
	}
?>
</div>
<script language="javascript" type="text/javascript">
	var documentXML; //contendra la respuesta xml de estados
	$('estado').addEvent('change', function(){
		changeEdo('ciudad',this.value);
	});
	
	$('ciudad').addEvent('change', function(){
		var estados = documentXML.getElementsByTagName('Estado');
		for(var i=0;i<estados.length;i++){
			if(estados[i].getElementsByTagName("Nombre")[0].firstChild.nodeValue==$('estado').value){
				var municipios = estados[i].getElementsByTagName("Municipios");
				for(var j=0;j<municipios.length;j++){
					if(municipios[j].getElementsByTagName("Nombre")[0].firstChild.nodeValue==this.value){
						$('lada').value = municipios[j].getElementsByTagName("Lada")[0].firstChild.nodeValue;
						return;
					}
				}
			}
		}
	});
	
	function changeEdo(id,estado){
		var element = $(id);
		element.innerHTML="";
		var estados = documentXML.getElementsByTagName("Estado");
		for(var i=0;i<estados.length;i++){
			if(estados[i].getElementsByTagName("Nombre")[0].firstChild.nodeValue==estado)
			{
				var municipios = estados[i].getElementsByTagName("Municipios");
				for(var j=0;j<municipios.length;j++){
					var nombre = municipios[j].getElementsByTagName("Nombre")[0].firstChild.nodeValue;
		<?php
			if($ciudad)
				echo "
					if(nombre!='$ciudad'){
				";
		?>
						var option = document.createElement('option');
							option.setAttribute('value',nombre);
							option.appendChild(document.createTextNode(nombre));
						element.appendChild(option);
		<?php
			if($ciudad)
				echo "
					}
				";
			
		?>
				}
			}
		}
	}
	
	XMLRequest.open("POST","items/xml_estados.php",true);
	XMLRequest.onreadystatechange = function(){
		if(XMLRequest.readyState == 4) {
			documentXML = XMLRequest.responseXML;
			var estados = documentXML.getElementsByTagName("Estado");
			for(var i=0;i<estados.length;i++){
				var nombre = estados[i].getElementsByTagName("Nombre")[0].firstChild.nodeValue;
					var option = document.createElement('option');
						option.setAttribute('value',nombre);
						option.appendChild(document.createTextNode(nombre));
					$('estado').appendChild(option);
			}
		}
	}
	XMLRequest.send(null);
<?php
	if($alter){
?>	
	$('control').addEvent('submit', function(e){
		new Event(e).stop();
		
		//validando
		var dpersonales = Form.validate('datos_personales');
		var dcontrato = Form.validate('datos_contrato');

		if(dpersonales==false || dcontrato==false){
			site.putMessage("Datos incompletos");
			return;
		}
		
		parametros="option=1&id_contrato=<?php echo $id_contrato; ?>&";
		parametros+=Form.getParametersByPHP('datos_personales')+"&";
		parametros+=Form.getParametersByPHP('datos_contrato');

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
		Form.enable('datos_personales');
		Form.enable('datos_contrato');
		$('telefono').disabled='true';
		$('bt_cancelar').removeClass('hide');
		$('bt_actualizar').removeClass('hide');
		$('bt_modificar').addClass('hide');
	});
	
	$('bt_eliminar').addEvent('click', function(){
		if(!confirm("¿Estas seguro de eliminar el contrato seleccionado?"))
			return;
		parametros = "option=1&id_contrato=" + seleccionado.getAttribute('id');
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
					data: "page=1",
					update: $('content'),
					evalScripts: true
				}).request();
			}
		}).request();
	});

	$('bt_cancelar').addEvent('click', function(){
		Form.disable('datos_personales');
		Form.disable('datos_contrato');
		$('bt_cancelar').addClass('hide');
		$('bt_actualizar').addClass('hide');
		$('bt_modificar').removeClass('hide');
	});
	
	Form.disable('datos_personales');
	Form.disable('datos_contrato');
<?php
	}
	else{
?>	
	$('control').addEvent('submit', function(e){
		new Event(e).stop();
		
		//validando
		var dpersonales = Form.validate('datos_personales');
		var dcontrato = Form.validate('datos_contrato');

		if(dpersonales==false || dcontrato==false){
			site.putMessage("Datos incompletos");
			return;
		}
		
			
		parametros="option=1&";
		parametros+=Form.getParametersByPHP('datos_personales')+"&";
		parametros+=Form.getParametersByPHP('datos_contrato');

		new _Ajax({
			method: 'post',
			url: "items/altas.php",
			data: parametros,
			update: $('messages'),
			onComplete: function(){
				Form.reset('datos_personales');
				Form.reset('datos_contrato');
			}
		}).request();
		
	});
	
	$('bt_reset').addEvent('click', function(){
		Form.reset('datos_personales');
		Form.reset('datos_contrato');
	});
<?php
	}
?>
</script>
<?php
	}
	else if($op==2){
		echo "nada";
	}
	else{

?>
<div id="contratos">
	<form id="consulta">
		<div class="subform">
			<label for="valor">Consulta: </label>
			<input type="text" id="valor" name="valor" size="50"  maxlength="100" />
			<label for="por">por: </label>
			<select id="por" name="por" >
				<option value="id_contrato">ID</option>
				<option value="nombre_cte">Nombre</option>
				<option value="telefono">Telefono</option>
				<option value="id_lada">Lada</option>
				<option value="direccion">Dirección</option>
				<option value="cp">Codigo Postal</option>
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
						<th width="100px">ID</th>
						<th width="300px">Nombre</th>
						<th width="150px">Lada</th>
						<th width="150px">Telefono</th>
						<th width="100px"></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$by=addslashes($_REQUEST['by']);
					$valor=addslashes($_REQUEST['valor']);

					$query="select * from 07_contrato";
					
					if($by)
						$query.=" where $by like '$valor'";
						
					$result = $bd->query($query);
					$classe=true;			
					while($row=mysql_fetch_array($result)){
						if($classe){$class="one";$classe=false;}
						else{$class="";$classe=true;}
						echo "
						<tr id='$row[id_contrato]' class='$class' onclick='onclickHandler(this);'>
							<td>$row[id_contrato]</td>
							<td>$row[nombre_cte]</td>
							<td>$row[id_lada]</td>
							<td>$row[telefono]</td>
							<td><a target='_blank' href='items/generarPDF.php?id=$row[id_contrato]&mes=".date("n")."&anio=".date("Y")."' title='Genera recibo para $row[id_contrato]'>Recibo</a></td>
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
	
	
	
	$('bt_consultar').addEvent('click', function(){
		if(!seleccionado)
			alert("No ha elegido un contrato. Gracias"); 
		else{
			parametros = "page=1&option=1&alter=true&id_contrato=" + seleccionado.getAttribute('id');
			
			new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: parametros,
					update: $('content'),
					evalScripts: true
				}).request();
		}
	});
	
	$('bt_eliminar').addEvent('click', function(){
		if(!seleccionado)
			alert("No ha elegido un contrato. Gracias"); 
		else{
			
			if(!confirm("¿Estas seguro de eliminar el contrato seleccionado?"))
				return;
				
			parametros = "option=1&id_contrato=" + seleccionado.getAttribute('id');
			
			new _Ajax({
				method: 'post',
				url: "items/deletes.php",
				data: parametros,
				update: $('messages'),
				evalScripts: true,
				onComplete: function(){
					var padre = seleccionado.parentNode;
					padre.removeChild(seleccionado);
				}
			}).request();
		}
	});
	
	$('consulta').addEvent('submit', function(e){
		new Event(e).stop();
		
		parametros = 'page=1&by=' + $('por').value + '&valor=' + $('valor').value;
		
		new _Ajax({
				method: 'post',
				url: "items/validate.php",
				data: parametros,
				update: $('content'),
				evalScripts: true
			}).request();
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

<?php
	require("utils.php");
	
	if(!connection_telmex)
		require('bd/connection.php'); 
		
	if(!$bd)
		$bd = new connection_telmex; 

	$op=addslashes($_REQUEST['option']);
	
	if($op==1){
		$id_lada=addslashes($_REQUEST['id_lada']);
		$alter=addslashes($_REQUEST['alter']);
		
		$query="select * from 07_lada where id_lada='$id_lada'";
		$result = $bd->query($query);
		
		$row=mysql_fetch_array($result);
		
?>
<div id="ladas">
		<form id="datos_ladas">
        
        <h1 class="titulo">:: Ladas</h1>
        
                <div class="subform">                    <table>
                    <tr>
                        <td>
                            <label for="lada">
                            	<span>*</span> Lada
                            </label>
                        </td>
                        <td>   
                            <input type="text" name="lada" id="lada" size="5" maxlength="3" <?php echo $row?"value='$row[id_lada]'":"value=''"; ?>/>
                        </td>
                        <td>
                            <label class="acotacion">:: ejemplo: 411 [solo 3 digitos] </label>
                        </td>
                    </tr>
                    <tr>                    
                       <td>
                            <label for="ciudad">
                            	<span>*</span> Ciudad
                            </label>
                        </td>
                        <td>    
                            <input type="text" name="ciudad" id="ciudad" size="25" maxlength="30" <?php echo $row?"value='".utf8_encode($row['cd_lada'])."'":"value=''"; ?> /> 
                        </td>
                        <td>
                            <label class="acotacion">:: ejemplo: Celaya </label>
                        </td>
                    </tr>   
                    <tr>
                        <td>
                            <label for="estado">
                            	<span>*</span> Estado
                            </label>
                        </td>
                        <td>    
                            <select name="estado" id="estado">
                            	<option value=""></option>
                            </select>
                        </td>
                        <td>
                            <label class="acotacion">:: ejemplo: Guanajuato </label>
                        </td>
                    </tr>   
                    <tr>
                    	<td>
                            <label for="new_estado"></label>
                        </td>
                        <td>    
                            <input type="button" name="bt_newedo" id="bt_newedo" value="Nuevo Estado"/> 
                        </td>
                        <td>
                            <label class="acotacion">:: Agregar un nuevo estado </label>
                        </td>
                    </tr>
                    </table>
                </center>
                
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
                	<input type="submit" value="Agregar" id="bt_insertar" name="bt_insertar" />
                </div>
		</form>
<?php 
	}
?>
</div>
<script language="javascript" type="text/javascript">
	
	var documentXML; //contendra la respuesta xml de estados
	
	$('bt_newedo').addEvent('click', function(){
		if(confirm("Agregar un nuevo estado implica mucha responsabilidad, ¿Decesa hacerlo?")){
			var nedo = prompt("Nombre del nuevo Estado");
			var option = document.createElement("option");
				option.setAttribute('value',nedo);
				option.appendChild(document.createTextNode(nedo));
			$('estado').appendChild(option);
			alert("El estado " + nedo + " fue agregado al final de la lista de Estados.");
		}	
	});
	
<?php 
	if(!$alter){
?>	
	//para insertar consultar
	$('bt_reset').addEvent('click', function(){
		Form.reset('datos_ladas');
	});

	$('control').addEvent('submit', function(e){
		new Event(e).stop();
		
		//validando
		if(!Form.validate('datos_ladas'))
			return site.putMessage("Datos incompletos");

		parametros="option=2&";
		parametros+=Form.getParametersByPHP('datos_ladas');
		
		new _Ajax({
			method: 'post',
			url: "items/altas.php",
			data: parametros,
			update: $('messages'),
			onComplete: function(){
				Form.reset('datos_ladas');
			}
		}).request();
	});
<?php
	}
	else{
?>	
	//para modificar
	$('control').addEvent('submit', function(e){
		new Event(e).stop();

		//validando
		if(!Form.validate('datos_ladas'))
			return site.putMessage("Datos incompletos");
		
		parametros="option=2&id_lada=<?php echo $id_lada; ?>&";
		parametros+=Form.getParametersByPHP('datos_ladas');

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
		Form.enable('datos_ladas');
		$('bt_cancelar').removeClass('hide');
		$('bt_actualizar').removeClass('hide');
		$('bt_modificar').addClass('hide');
	});
	
	$('bt_cancelar').addEvent('click', function(){
		Form.disable('datos_ladas');
		$('bt_cancelar').addClass('hide');
		$('bt_actualizar').addClass('hide');
		$('bt_modificar').removeClass('hide');
	});
	
	$('bt_eliminar').addEvent('click', function(){
		if(!confirm("¿Estas seguro de eliminar la Lada seleccionada?"))
			return;
		parametros = "option=2&id_lada=" + seleccionado.getAttribute('id');
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
					data: "page=3",
					update: $('content'),
					evalScripts: true
				}).request();
			}
		}).request();
	});	
	
<?php
	}
?>
	XMLRequest.open("POST","items/xml_estados.php",true);
	XMLRequest.onreadystatechange = function(){
		if(XMLRequest.readyState == 4) {
			documentXML = XMLRequest.responseXML;
			var estados = documentXML.getElementsByTagName("Estado");
			<?php
				if($row)
					echo "var edoselect='$row[edo_lada]';";
			?>			
			for(var i=0;i<estados.length;i++){
				var nombre = estados[i].getElementsByTagName("Nombre")[0].firstChild.nodeValue;
				var option = document.createElement('option');
					option.setAttribute('value',nombre);
					option.appendChild(document.createTextNode(nombre));
				$('estado').appendChild(option);
			<?php
				if($row)
					echo "
					if(edoselect==nombre)
						pos=$('estado').length-1;
					";
			?>
			}
			<?php
				if($row)
					echo "
			if(pos)
				$('estado').selectedIndex=pos;
					";
			?>
		}
	}
	XMLRequest.send(null);
<?php
	if($alter)
		echo "
			Form.disable('datos_ladas');
		";
?>	
</script>
<?php
	}
	else{
?>
<div id="ladas">
	<form id="consulta">
		<div class="subform">
			<label for="consulta">Consulta: </label>
			<input type="text" id="valor" name="valor" size="50"  maxlength="100" />
			<label for="por">por: </label>
			<select id="por" name="por" >
				<option value="id_lada">Lada</option>
				<option value="cd_lada">Ciudad</option>
				<option value="edo_lada">Estado</option>
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
						<th width="200px">Lada</th>
						<th width="400px">Ciudad</th>
						<th width="200px">Estado</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$by=addslashes($_REQUEST['by']);
					$valor=addslashes($_REQUEST['valor']);

					$query="SELECT * FROM 07_lada ";
					
					if($by)
						$query.=" WHERE $by LIKE '$valor'";
					
					$query.="GROUP BY id_lada ORDER BY edo_lada";
					
					$result = $bd->query($query);
					$classe=true;			
					while($row=mysql_fetch_array($result)){
						if($classe){$class="one";$classe=false;}
						else{$class="";$classe=true;}
						echo "
						<tr id='$row[id_lada]' class='$class' onclick='onclickHandler(this);'>
							<td>$row[id_lada]</td>
							<td>".utf8_encode($row['cd_lada'])."</td>
							<td>".utf8_encode($row['edo_lada'])."</td>
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
			alert("No ha elegido una Lada. Gracias"); 
		else{
			parametros = "page=3&option=1&alter=true&id_lada=" + seleccionado.getAttribute('id');
			new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: parametros,
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
					
					}
				}).request();
		}
	});
	
	$('bt_eliminar').addEvent('click', function(){
		if(!seleccionado)
			alert("No ha elegido una Lada. Gracias"); 
		else{
			if(!confirm("¿Estas seguro de eliminar la Lada seleccionada?"))
				return;
			parametros = "option=2&id_lada=" + seleccionado.getAttribute('id');
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
	
	$('consulta').addEvent('submit', function(e){
		new Event(e).stop();
		
		parametros = 'page=3&by=' + $('por').value + '&valor=' + $('valor').value;
		
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


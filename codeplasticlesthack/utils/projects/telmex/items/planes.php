<?php
	require("utils.php");
	
	if(!connection_telmex)
		require('bd/connection.php'); 
		
	if(!$bd)
		$bd = new connection_telmex; 

	$op=addslashes($_REQUEST['option']);
	
	if($op==1){
		$id_plan=addslashes($_REQUEST['id_plan']);
		$alter=addslashes($_REQUEST['alter']);
		
		$query="select * from 07_plan where id_plan='$id_plan'";
		$result = $bd->query($query);
		
		$row=mysql_fetch_array($result);
		
?>

<div id="planes">
		<form id="datos_plan">
        
        <h1 class="titulo">:: Planes</h1>
        
                <div class="subform">
                    <table>
                    <tr>
                        <td>
                            <label for="">ID Plan:</label>
                        </td>
                        <td>   
                        <?php
		                    if($row)
		                    	echo $row['id_plan'];
		                    else{
			                    $queryp = "SELECT id_plan from 07_plan ORDER BY id_plan DESC";
								$resultp = $bd->query($queryp);
								$rowp = mysql_fetch_array($resultp);
								$id_plan = 1 + $rowp['id_plan'];
							
								echo $id_plan;
							}
                        ?>
                            
                        </td>
                        <td>
                            <label class="acotacion">:: Asignado por el sistema </label>
                        </td>
                    </tr>
                    <tr>                    
                       <td>
                            <label for="beneficio">
                            	<span>*</span> Beneficion:
                            </label>
                        </td>
                        <td>    
                            <input type="text" name="beneficio" id="beneficio" size="10" maxlength="6" <?php echo $row?"value='$row[beneficio]'":"value=''"; ?> /> 
                        </td>
                        <td>
                            <label class="acotacion">:: Numero de llamadas locales gratis</label>
                        </td>
                    </tr>   
                    <tr>
                        <td>
                            <label for="lada_pico">
	                            <span>*</span> Lada Pico:
	                        </label>
                        </td>
                        <td>    
                            <input type="text" name="lada_pico" id="lada_pico" size="10" maxlength="6" <?php echo $row?"value='$row[lada_pico]'":"value=''"; ?> />
                        </td>
                        <td>
                            <label class="acotacion">:: Costo para cuota Lada Pico</label>
                        </td>
                    </tr>   
                    <tr>
                        <td>
                            <label for="lada_nopico">
                            	<span>*</span> Lada No-Pico:
                            </label>
                        </td>
                        <td>    
                            <input type="text" name="lada_nopico" id="lada_nopico" size="10" maxlength="6" <?php echo $row?"value='$row[lada_nopico]'":"value=''"; ?> />
                        </td>
                        <td
                            <label class="acotacion">:: Costo para cuota Lada No-Pico</label>                            
                        </td>    
                    </tr>
                    <tr>
                        <td>
                            <label for="local">
                            	<span>*</span> Cuota local:
                            </label>
                        </td>
                        <td>    
                            <input type="text" name="local" id="local" size="10" maxlength="6" <?php echo $row?"value='$row[local]'":"value=''"; ?> />
                        </td>
                        <td>                        	
                            <label class="acotacion">:: Costo por la llamada local </label>
                        </td>
					</tr>
                    <tr>                        
                        <td>
                            <label for="renta">
                            	<span>*</span> Renta:
                            </label>
                         </td>
                         <td>   
                            <input type="text" name="renta" id="renta" size="10" maxlength="6" <?php echo $row?"value='$row[renta]'":"value=''"; ?> />
                        </td>
                        <td>
                        	<label class="acotacion">:: Renta del plan </label>
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
		<form id="control">
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
		Form.reset('datos_plan');
	});

	$('control').addEvent('submit', function(e){
		new Event(e).stop();
		
		//validando
		if(!Form.validate('datos_plan'))
			return site.putMessage("Datos incompletos");
			
		parametros="option=3&";
		parametros+=Form.getParametersByPHP('datos_plan');
		
		new _Ajax({
			method: 'post',
			url: "items/altas.php",
			data: parametros,
			update: $('messages'),
			onComplete: function(){
				Form.reset('datos_plan');
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
		if(!Form.validate('datos_plan'))
			return site.putMessage("Datos incompletos");
		
		parametros="option=3&id_plan=<?php echo $id_plan; ?>&";
		parametros+=Form.getParametersByPHP('datos_plan');

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
		Form.enable('datos_plan');
		$('bt_cancelar').removeClass('hide');
		$('bt_actualizar').removeClass('hide');
		$('bt_modificar').addClass('hide');
	});
	
	$('bt_cancelar').addEvent('click', function(){
		Form.disable('datos_plan');
		$('bt_cancelar').addClass('hide');
		$('bt_actualizar').addClass('hide');
		$('bt_modificar').removeClass('hide');
	});
	
	$('bt_eliminar').addEvent('click', function(){
		if(!confirm("¿Estas seguro de eliminar el Plan seleccionado?"))
			return;
		parametros = "option=3&id_plan=" + seleccionado.getAttribute('id');
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
					data: "page=2",
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
			Form.disable('datos_plan');
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
				<option value="id_plan">Plan</option>
				<option value="beneficio">Beneficio</option>
				<option value="lada_pico">Lada Pico</option>
				<option value="lada_nopico">Lada No-Pico</option>
				<option value="local">Cuota Local</option>
				<option value="renta">Renta</option>
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
						<th width="200px">Plan</th>
						<th width="400px">Beneficio</th>
						<th width="200px">Renta</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$by=addslashes($_REQUEST['by']);
					$valor=addslashes($_REQUEST['valor']);

					$query="SELECT * FROM 07_plan ";
					
					if($by)
						$query.=" WHERE $by LIKE '$valor'";
					
					$query.="ORDER BY id_plan";
					
					$result = $bd->query($query);
					$classe=true;			
					while($row=mysql_fetch_array($result)){
						if($classe){$class="one";$classe=false;}
						else{$class="";$classe=true;}
						echo "
						<tr id='$row[id_plan]' class='$class' onclick='onclickHandler(this);'>
							<td>$row[id_plan]</td>
							<td>$row[beneficio]</td>
							<td>$row[renta]</td>
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

		parametros = 'page=2&by=' + $('por').value + '&valor=' + $('valor').value;
		
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
			alert("No ha elegido un Plan"); 
		else{
			if(!confirm("¿Estas seguro de eliminar el Plan seleccionado?"))
				return;
			parametros = "option=3&id_plan=" + seleccionado.getAttribute('id');
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
			alert("No ha elegido un Plan"); 
		else{
			parametros = "page=2&option=1&alter=true&id_plan=" + seleccionado.getAttribute('id');
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

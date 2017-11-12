

<div id="contratos">
	<p>
		La informacion se encuentra dividida en secciones para mejorar su visivilidad y usavilidad. Ingrese los datos correspondientes en el formulario.
	</p>
	<form id="reporte_llamadas">
		<h1 class="titulo">:: Graficar</h1>
		<div class="subform">
			<table>
					<tr>
						<td>
							<label>
							Meses</label>
						</td>
						<td>
							<label>Enero</label> <INPUT TYPE="CHECKBOX" NAME="meses[]" id="1" >							
						</td>
						<td>
							<label>Febrero</label> <INPUT TYPE="CHECKBOX" NAME="meses[]" id="2" VALUE="2">							
						</td>
						<td>
							<label>Marzo</label> <INPUT TYPE="CHECKBOX" NAME="meses[]" id="3" VALUE="3">							
						</td>
						<td>
							<label>Abril</label> <INPUT TYPE="CHECKBOX" NAME="meses[]" id="4" VALUE="4">							
						</td>
						<td>
							<label>Mayo</label> <INPUT TYPE="CHECKBOX" NAME="meses[]" id="5" VALUE="5">							
						</td>
						<td>
							<label>Junio</label> <INPUT TYPE="CHECKBOX" NAME="meses[]" id="6" VALUE="6">							
						</td>
						<td>
							<label>Julio </label><INPUT TYPE="CHECKBOX" NAME="meses[]" id="7" VALUE="7">							
						</td>
						<td>
							<label>Agosto </label><INPUT TYPE="CHECKBOX" NAME="meses[]"  id="8" VALUE="8">							
						</td>
						<td>
							<label>Septiembre</label> <INPUT TYPE="CHECKBOX" NAME="meses[]" id="9" VALUE="9">							
						</td>
						<td>
							<label>Octubre </label><INPUT TYPE="CHECKBOX" NAME="meses[]" id="10" VALUE="10">							
						</td>
						<td>
							<label>Noviembre</label> <INPUT TYPE="CHECKBOX" NAME="meses[]" id="11"VALUE="11">							
						</td>
						<td>
							<label>Diciembre</label> <INPUT TYPE="CHECKBOX" NAME="meses[]" id="12"VALUE="12">							
						</td>
                        <td>
                        	<input type="button" id="all" name="all" value="Todos" onclick="selectAll();"/>
                        </td>
					</tr>
                    <tr> 
                    	<td colspan="3">
                        	<label>Tipo de Grafica:: </label>
                        </td>         
                        <td colspan="2">
                            <label>Barras</label> <INPUT TYPE="radio" NAME="tGrafica" id="tGraficaB" VALUE="barras" checked="checked"/>
                        </td>
                        <td colspan="2">
                            <label>Pie</label> <INPUT TYPE="radio" NAME="tGrafica" id="tGraficaP" VALUE="pie"/>
                        </td>
                        <td colspan="2">
                            <label>Anillo</label> <INPUT TYPE="radio" NAME="tGrafica" id="tGraficaA" VALUE="pie"/>
                        </td>                            
                    </tr>					
					
			</table>			
					
			
		</div>
		
	</form>
<div id="contratos">
	<form id="resultados">
		<div class="hresult subform">
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
					if(!$bd){
						require('bd/connection.php'); 
						$bd = new connection_telmex;  
					}	
					$query="select * from 07_contrato";
					$result = $bd->query($query);
					$classe=true;			
					while($row=mysql_fetch_array($result)){
						if($classe){$class="one";$classe=false;}
						else{$class="";$classe=true;}
						echo "
						<tr class='$class'>
							<td>$row[id_contrato]</td>
							<td>$row[nombre_cte]</td>
							<td>$row[id_lada]</td>
							<td>$row[telefono]</td>
							<td><input  maxlength='7' TYPE='button' VALUE='Generar'  
							onclick='enviardatos(\"$row[id_contrato]\");'/></td>
						</tr>
						";
					}
				
				?>
					
				</tbody>
			</table>
		</div>
	</form>

</div>


<script language="javascript" type="text/javascript" >
	

				
	function enviardatos(id_cliente){		
				
		meses = new Array ();
		Msk=document.getElementsByName('meses[]');
		tGB=document.getElementById('tGraficaB');
		tGP=document.getElementById('tGraficaP');
		
		k=0;
		j=1;
		for(i=0;i<Msk.length;i++){
		
				if(Msk[i].checked){
					meses[k]=j;
					k++;
				}			
				j++;
		}
		
		tipo=1;
		tGB.checked?tipo:tGP.checked?tipo=2:tipo=3;
		meses.length==0?meses=0:meses;
		
		
				var temp = new _Ajax({
					method: 'post',
					url:"items/grafica1.php",
					data: "id="+id_cliente+"&meses="+meses+"&tipo="+tipo,
					update: $('content'),
					evalScripts: true
				}).request();	
		

	}	

	function selectAll(){
		meses=document.getElementsByName('meses[]');
		for(i=0;i<meses.length;i++){
			meses[i].checked="checked";
		}		
	
	}
							

		</script>
								

</div>

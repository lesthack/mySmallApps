
<div id="contratos">
	<p>
		La informacion se encuentra dividida en secciones para mejorar su visivilidad y usavilidad. Ingrese los datos correspondientes en el formulario.
	</p>
	<form id="reporte_llamadas">
		<h1 class="titulo">:: Comparativa Estados</h1>
		<div class="subform">
			<table>
					<tr align="left">
						<th colspan="5">
							<label>::Seleccione los Estados::</label>
						</th>
                        <td width="80"></td>
                        <th colspan="3">
							<label>::Tipo de Grafica::</label>
						</th>
                    </tr>
                    <tr>
                    
                    <?php
						if(!$bd){
							require('bd/connection.php'); 
							$bd = new connection_telmex;  
						}	
						$query="select * from 07_lada group by edo_lada";
						
						for($i=0;$i<5;$i++){
							$result = $bd->query($query);
							$elemento="<td><select id='$i' name='$i'>";
							$elemento.="<option value='0' selected>--Select--</option>";
							while($row=mysql_fetch_array($result)){
								$elemento.="<option value='$row[edo_lada]' >$row[edo_lada]</option>";	
							}
							$elemento.="</select></td>";
							echo $elemento;
						}
					?> 
                    	<td width="80"></td>
                        <td>
                             <INPUT TYPE="radio" NAME="tGrafica" id="tGraficaB" VALUE="1" checked/><label>Barras</label>
                        </td>
                        <td>
                             <INPUT TYPE="radio" NAME="tGrafica" id="tGraficaP" VALUE="2"/><label>Pastel</label>
                        </td>
                        <td>
                             <INPUT TYPE="radio" NAME="tGrafica" id="tGraficaA" VALUE="3"/><label>Anillo</label>
                        </td>                   
                                       	
					</tr>
                    <tr>&nbsp;</tr>
                    <tr>
                    	<td>
							 <INPUT TYPE="radio" NAME="meses[]" id="1" value="1" checked/>	<label>Enero</label>						
						</td>
						<td>
							 <INPUT TYPE="radio" NAME="meses[]" id="2" VALUE="2"/><label>Febrero</label>							
						</td>
						<td>
							<INPUT TYPE="radio" NAME="meses[]" id="3" VALUE="3"/>	<label>Marzo</label> 						
						</td>
						<td>
							<INPUT TYPE="radio" NAME="meses[]" id="4" VALUE="4"/><label>Abril</label> 							
						</td>
						<td>
							 <INPUT TYPE="radio" NAME="meses[]" id="5" VALUE="5"/><label>Mayo</label>							
						</td>
						<td>
							 <INPUT TYPE="radio" NAME="meses[]" id="6" VALUE="6"/><label>Junio</label>							
						</td>
                     </tr>
                     <tr>
						<td>
							<INPUT TYPE="radio" NAME="meses[]" id="7" VALUE="7"/><label>Julio </label>							
						</td>
						<td>
							<INPUT TYPE="radio" NAME="meses[]"  id="8" VALUE="8"/><label>Agosto </label>							
						</td>
						<td>
							 <INPUT TYPE="radio" NAME="meses[]" id="9" VALUE="9"/><label>Septiembre</label>							
						</td>
						<td>
							<INPUT TYPE="radio" NAME="meses[]" id="10" VALUE="10"/><label>Octubre </label>							
						</td>
						<td>
							 <INPUT TYPE="radio" NAME="meses[]" id="11"VALUE="11"/><label>Noviembre</label>							
						</td>
						<td>
							 <INPUT TYPE="radio" NAME="meses[]" id="12"VALUE="12"/><label>Diciembre</label>							
						</td>
                        <td width="70">&nbsp;</td>
                        <td>
                    		<input type="button" value="Graficar" onClick="grafica();" />
						</td>
                     </tr>         
			</table>			
					
			
		</div>
		
	</form>

<?php  include("FusionCharts.php"); 


	$cont="<div id='Grafica'>
	<form id='res'>
		<div class='hresult subform'>
			
		</div>
	</form>
	</div>";
   
	if(isset($_REQUEST['mes']) && isset($_REQUEST['estados']) && isset($_REQUEST['tipo'])){
		$mes=$_REQUEST['mes'];
		$estados=$_REQUEST['estados'];
		$tipo=$_REQUEST['tipo'];
		if($estados!="0"){
			$edos=explode(",",$estados);
?>

<div id='Grafica'>
	<form id='resultados-grafica'>
		<div class='hresult subform'>
        
        			<?php
						if(!$bd){
							require('bd/connection.php'); 
							$bd = new connection_telmex;  
						}	
						
						
						if($tipo==2){					
							$strXML="<chart palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70'>";
							
						}else if($tipo==3){
							$strXML="<chart palette='2' showBorder='1'>";	
						}else{
							$strXML="<chart caption='Comparativa de Llamadas Entre Estados' xAxisName='Estado' yAxisName='Llamadas' showValues='0' formatNumberScale='0' showBorder='1'>";
						}
						
						
						for($i=0;$i<sizeof($edos);$i++){
							$res=$bd->query("SELECT * FROM 07_llamada join 07_lada on 07_llamada.lada_origen = 07_lada.id_lada WHERE  edo_lada='".$edos[$i]."' and  MONTH(fecha)=".$mes." and YEAR(fecha)=".date('Y'));
							
							$num=mysql_num_rows($res)!=null?mysql_num_rows($res):0;
							$strXML.="<set label='".$edos[$i]."' value='".$num."' />";
						}
													
						$strXML.="</chart>";
						
						if($tipo==2){	
							echo renderChartHTML("items/Charts/Pie3D.swf", "", $strXML, "myFirst", 710, 295, false);
						}else if($tipo==3){
							echo renderChartHTML("items/Charts/Doughnut3D.swf", "", $strXML, "myFirst", 710, 295, false);
						}else{
							echo renderChartHTML("items/Charts/Column3D.swf", "", $strXML, "myFirst", 710, 295, false);	
						}
					?>
			
		</div>
	</form>
</div>
<div id='Grafica-Tabla'>
	<form id='resultados-tabla'>
		<div >
        <table class="result">
				<thead>
					<tr>
						<th width="365px">Estado</th>
						<th width="365px">Cantidad</th>
					</tr>
				</thead>
				<tbody>
        	<?php
						if(!$bd){
							require('bd/connection.php'); 
							$bd = new connection_telmex;  
						}	
						
						for($i=0;$i<sizeof($edos);$i++){
							$res=$bd->query("SELECT * FROM 07_llamada join 07_lada on 07_llamada.lada_origen = 07_lada.id_lada WHERE  edo_lada='".$edos[$i]."' and  MONTH(fecha)=".$mes." and YEAR(fecha)=".date('Y'));
							
							$num=mysql_num_rows($res)!=null?mysql_num_rows($res):0;
							echo "<tr>
									<td>$edos[$i]</td>
									<td>$num</td>
								</tr>";
						}	
			?>
            	</tbody>
			</table>
		</div>
	</form>
</div>

<?php
		}else echo $cont;		
	}else echo $cont;
?>    


<script language="javascript" type="text/javascript">
	function grafica(){
		elementos=document.getElementsByTagName("select");
		meses=document.getElementsByName('meses[]');
		tipos=document.getElementsByName('tGrafica');
		
		edos=new Array();
		mes=1;
		tipo=1;
		k=-1;
		
		for(i=0;i<elementos.length;i++){
			elementos[i].value==0?elementos[i].value:edos[++k]=elementos[i].value;
		}
		edos.length==0?edos=0:edos;
		
		for(i=0;i<meses.length;i++){
			if(meses[i].checked){
				mes=meses[i].value;break;
			}
		}
		
		for(i=0;i<tipos.length;i++){
			if(tipos[i].checked){
				tipo=tipos[i].value;break;
			}
		}
		
		var temp = new _Ajax({
					method: 'post',
					url:"items/gComEdos.php",
					data: "mes="+mes+"&estados="+edos+"&tipo="+tipo,
					update: $('content'),
					evalScripts: true
				}).request();
	}
</script>
								

</div>

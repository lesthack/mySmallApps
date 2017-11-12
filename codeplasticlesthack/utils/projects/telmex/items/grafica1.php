<div id="grafica">
		<form>
        	<h1 class='titulo'>:: Grafica Comparativa :: Llamadas Realizadas</h1>
        	<?php  
			include("FusionCharts.php");
			if(!$bd)
				require('bd/connection.php');
			
				if(isset($_REQUEST['tipo']) && isset($_REQUEST['id']) && isset($_REQUEST['meses'])){
					$meses=$_REQUEST['meses'];
					$id=$_REQUEST['id'];
					$tipo=$_REQUEST['tipo'];
										
					if($meses != 0){
							$con=new connection_telmex;
							$meses=explode(",",$meses);
							
							if($tipo==2){					
								$strXML="<chart palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70'>";
								
							}else if($tipo==3){
								$strXML="<chart palette='2' showBorder='1'>";	
							}else{
								$strXML="<chart caption='Comparativa de Llamadas por Mes' xAxisName='Mes' yAxisName='Llamadas' showValues='0' formatNumberScale='0' showBorder='1'>";
							}
							
							for($i=0;$i<sizeof($meses);$i++){
								$res=$con->query("SELECT * FROM 07_llamada join 07_contrato on 07_llamada.lada_origen = 07_contrato.id_lada WHERE id_contrato='".$id."'  and tel_origen=telefono and MONTH(fecha)=".$meses[$i]." and YEAR(fecha)=".date('Y'));
								
								$num=mysql_num_rows($res)!=null?mysql_num_rows($res):0;
								$strXML.="<set label='".getMes($meses[$i])."' value='".$num."' />";
							}
														
							$strXML.="</chart>";
							
							if($tipo==2){	
								echo renderChartHTML("items/Charts/Pie3D.swf", "", $strXML, "myFirst", 740, 350, false);
							}else if($tipo==3){
								echo renderChartHTML("items/Charts/Doughnut3D.swf", "", $strXML, "myFirst", 740, 350, false);
							}else{
								echo renderChartHTML("items/Charts/Column3D.swf", "", $strXML, "myFirst", 740, 350, false);	
							}					
				?>
 	</form>
 </div>	
                
				<div id='Grafica-Tabla'>
                    <form id='resultados-tabla'>
                        <div >
                        <table class="result">
                                <thead>
                                    <tr>
                                        <th width="365px">Mes</th>
                                        <th width="365px">Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
											$classe=true;
											for($i=0;$i<sizeof($meses);$i++){
												$res=$con->query("SELECT * FROM 07_llamada join 07_contrato on 07_llamada.lada_origen = 07_contrato.id_lada WHERE id_contrato='".$id."'  and tel_origen=telefono and MONTH(fecha)=".$meses[$i]." and YEAR(fecha)=".date('Y'));
												
												if($classe){$class="one";$classe=false;}
												else{$class="";$classe=true;}
												
												$num=mysql_num_rows($res)!=null?mysql_num_rows($res):0;
												$mes=getMes($meses[$i]);
												echo "<tr class='$class'>
														<td>$mes</td>
														<td>$num Llamadas</td>
													</tr>";
											}
                				?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                
				<?php											
					}else{
						echo "<h1 class='titulo'>:: Imposible Generar :: Falta Parametros</h1>";
					}		
				}else{				
					echo "<h1 class='titulo'>:: Imposible Generar :: Nose resibieron parametros</h1>";
				}				
				
				
	function getMes($ms){
		$res="";
		switch ($ms) {
			 case 1:$res="Enero";break;
			 case 2:$res="Febrero";break;
			 case 3:$res="Marzo";break;
			 case 4:$res="Abril";break;
			 case 5:$res="Mayo";break;
			 case 6:$res="Junio";break;
			 case 7:$res="Julio";break;
			 case 8:$res="Agosto";break;
			 case 9:$res="Septiembre";break;
			 case 10:$res="Octubre";break;
			 case 11:$res="Noviembre";break;
			 case 12:$res="Diciembre";break;
		 }		 
		 return $res;	
	}
				
				
			?>
	

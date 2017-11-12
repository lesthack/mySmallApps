<?php
	include("FusionCharts2.php");
	require('bd/connection.php'); //llamamos a nuestra libreria conexion
	
	//seccion de instanciacion a la clase connection_telmex
		$bd = new connection_telmex;  //hacemos la conexion.

	$mes=addslashes($_REQUEST['mes']);
	$ano=addslashes($_REQUEST['ano']);
	$usuario=addslashes($_REQUEST['usuario']);
	$tipo=addslashes($_REQUEST['tipo']);
			
	$condicion="";		
	$condicionExtra="";
			
		if($tipo==1){	
			switch($mes){
				case 'enero': $mes="01";
						break;
				case 'febrero': $mes="02";
						break;
				case 'marzo': $mes="03";
						break;
				case 'abril': $mes="04";
						break;
				case 'mayo': $mes="05";
						break;
				case 'junio': $mes="06";
						break;
				case 'julio': $mes="07";
						break;
				case 'agosto': $mes="08";
						break;
				case 'septiembre': $mes="09";
						break;
				case 'octubre': $mes="10";
						break;
				case 'noviembre': $mes="11";
						break;
				case 'diciembre': $mes="12";
						break;
			
			}//switch		
		
				$condicion = "and MONTH(fecha)='$mes' ";
		}
		else if($tipo==0 || $tipo==2){
				$condicion = "and fecha like ('$ano%')";
			 	$condicionExtra = "and nombre_cte like('%$usuario%')";
				}

//saca el telefono de origen, el tiempo local, asi como su costo.
		$query="select tel_origen,(SUM(tiempo_fin-tiempo_ini))/100 as 'tiempoLocal',local from 07_llamada,07_lada,07_contrato,07_plan where lada_origen=lada_destino and lada_origen=07_lada.id_lada and 07_lada.id_lada=07_contrato.id_lada and 07_contrato.id_plan=07_plan.id_plan and tel_origen=telefono $condicion $condicionExtra group by tel_origen order by tel_origen LIMIT 0,10";
		$result = $bd->query($query);

				$y=0;
			while ($linea = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$x=0;
					foreach ($linea as $valor_col) {
						$totalLocal[$x][$y] = $valor_col;
						$x++;
					}//foreach
					$y++;
				}//while

//saca el telefono de origen, el tiempo pico, asi como su costo.
		$query="select tel_origen,(SUM(tiempo_fin-tiempo_ini))/100 as 'tiempoPico',lada_pico from 07_llamada,07_lada,07_contrato,07_plan where lada_origen<>lada_destino and tiempo_ini between '08:00:00' and '19:59:00' and lada_origen=07_lada.id_lada and 07_lada.id_lada=07_contrato.id_lada and 07_contrato.id_plan=07_plan.id_plan and tel_origen=telefono  $condicion $condicionExtra group by tel_origen order by tel_origen LIMIT 0,10";
		$result = $bd->query($query);

				$y=0;
			while ($linea = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$x=0;
					foreach ($linea as $valor_col) {
						$totalPico[$x][$y] = $valor_col;
						$x++;
					}//foreach
					$y++;
				}//while

//saca el telefono de origen, el tiempo no pico, asi como su costo.
		$query="select tel_origen,(SUM(tiempo_fin-tiempo_ini))/100 as 'tiempoNoPico',lada_nopico from 07_llamada,07_lada,07_contrato,07_plan where lada_origen<>lada_destino and tiempo_ini not between '08:00:00' and '19:59:00' and lada_origen=07_lada.id_lada and 07_lada.id_lada=07_contrato.id_lada and 07_contrato.id_plan=07_plan.id_plan and tel_origen=telefono  $condicion $condicionExtra group by tel_origen order by tel_origen LIMIT 0,10";
		$result = $bd->query($query);

				$y=0;
			while ($linea = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$x=0;
					foreach ($linea as $valor_col) {
						$totalNoPico[$x][$y] = $valor_col;
						$x++;
					}//foreach
					$y++;
				}//while

//sacamos los nombres de los usarios mas destacados
		$query="select tel_origen,nombre_cte from 07_llamada,07_lada,07_contrato,07_plan where lada_origen=07_lada.id_lada and 07_lada.id_lada=07_contrato.id_lada and 07_contrato.id_plan=07_plan.id_plan and tel_origen=telefono  $condicion $condicionExtra group by tel_origen order by tel_origen LIMIT 0,10";
		$result = $bd->query($query);

				$y=0;
			while ($linea = mysql_fetch_array($result, MYSQL_ASSOC)) {
						$x=0;
					foreach ($linea as $valor_col) {
						$totalUsuarios[$x][$y] = $valor_col;
						$x++;
					}//foreach
					$y++;
				}//while

//calculamos el costo de los minutos realizados por determinado numero
$usuario=array();
$index=0;
for($x=0;$x<sizeof($totalUsuarios);$x++){

$usuario[0][$x] = $totalUsuarios[1][$x];

	//sacamos el tiempo pico
	for($y=0;$y<sizeof($totalPico);$y++)
		if($totalUsuarios[0][$x]==$totalPico[0][$y]){
			$usuario[1][$index] += $totalPico[1][$y] * $totalPico[2][$y];
			}//if
	
	//sacamos el tiempo no pico
	for($y=0;$y<sizeof($totalNoPico);$y++)
		if($totalUsuarios[0][$x]==$totalNoPico[0][$y]){
			$usuario[1][$index] += $totalNoPico[1][$y] * $totalNoPico[2][$y];
			}//if	
	
	//sacamos el tiempo local
	for($y=0;$y<sizeof($totalLocal);$y++)
		if($totalUsuarios[0][$x]==$totalLocal[0][$y]){
			$usuario[1][$index] += $totalLocal[1][$y] * $totalLocal[2][$y];
			}//if
	
	if($usuario[0][$index]!="")
	 $index++;		
	
}//for

if($usuario[0][0]==""){
	echo "<strong>no hay registros para mostrar</strong>";
}
else {

	//creamos la string con el contenido xml
   $strXML  = "";
   $strXML .= "<graph caption='Usuarios Destacados' xAxisName='Usuarios' yAxisName='Gastos' decimalPrecision='1' formatNumberScale='0'>";
for($x=0;$x<sizeof($usuario);$x++)
      $strXML .= "<set name='".$usuario[0][$x]."' value='".$usuario[1][$x]."' color='AFD8F8' />";
   $strXML .= "</graph>";

   //Create the chart - Column 3D Chart with data from strXML variable using dataXML method
   echo renderChartHTML("items/Charts/Column3D.swf", "", $strXML, "myNext", 500, 300);
}//else

?>

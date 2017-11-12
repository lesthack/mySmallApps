<?php
require('bd/connection.php');
 
class InfoRecibo{
	var $mes;
	var $anio;
	
	var $con;

	var $id;
	var $nombre;
	var $direccion;
	var $ciudad;
	var $estado;
	var $telefono;
	var $plan;
	var $lada;
	var $cp;
	var $saldoAnt;
	var $redondeo;
	
	var $saldo;
	var $cargosMes;
	var $iva;
	var $subTotal;
	var $creRedondeo;
	var $total;
	
	var $servicioLocal;
	var $servicioEstatal;
	var $servicioNacional;
	
	var $pagarAntes;
	var $mesFacturacion;
	var $noFactura;
	
	var $beneficio;
	var $nacional;
	var $estatal;
	var $local;
	var $renta;
	
	var $consultaLocal;
	var $consultaEstatal;
	var $consultaNacional;	
	
	function InfoRecibo($id,$mes,$anio){
		$this->id=$id;
		$this->mes=$mes;
		$this->anio=$anio;
		$this->con=new connection_telmex;
		$this->loadDataUsr();
		$this->loadDataPlan();
		$this->estadoDeCuenta();
		$this->loadDataDates();
	}
	
	function loadDataUsr(){
		$res=$this->con->query("SELECT * FROM 07_contrato WHERE id_contrato='".$this->id."'");
		$row = mysql_fetch_row($res);
		
		$this->telefono=$row[1];
		$this->lada=$row[2];
		$this->plan=$row[3];
		$this->nombre=$row[4];
		$this->direccion=$row[5];
		$this->cp=$row[6];
		$this->redondeo=$row[7];
		$this->saldoAnt=$row[8];
		
		$res=$this->con->query("SELECT cd_lada,edo_lada FROM 07_lada WHERE id_lada='".$this->lada."'");
		$row = mysql_fetch_row($res);
		
		$this->ciudad=$row[0];
		$this->estado=$row[1];
	}
	
	function loadDataPlan(){
		$res=$this->con->query("SELECT * FROM 07_plan WHERE id_plan= 0000001");
		$plan = mysql_fetch_row($res);
		
		$this->beneficio=$plan[1];
		$this->nacional=$plan[2];
		$this->estatal=$plan[3];
		$this->local=$plan[4];
		$this->renta=$plan[5];
		
	}
	
	function estadoDeCuenta(){
		$this->saldo=$this->saldoAnt-$this->saldoAnt;
		$this->cargosMes=$this->cargosDelMes();
		$this->iva=($this->cargosMes * 0.15);
		$this->subTotal=0 + $this->redondeo + $this->cargosMes + $this->iva;
		$re=explode(".",$this->subTotal);
		$this->creRedondeo=$this->subTotal-$re[0];
		$this->total= $this->saldo + $this->subTotal - $this->creRedondeo;
	}
	
	function loadDataDates(){
		$this->mesFacturacion=$this->getMes($this->mes);
		$this->pagarAntes=$this->getFechaLimite();
	}
	
	function cargosDelMes(){
		$this->servicioLocal=$this->calculaLocal();
		$this->servicioEstatal=$this->calculaEstatal();
		$this->servicioNacional=$this->calculaNacional();
				
		return $this->servicioLocal + $this->servicioEstatal + $this->servicioNacional;
	}
	
	function calculaLocal(){
		$llamadas=$this->con->query("SELECT * FROM 07_llamada WHERE lada_origen='".$this->lada."' and tel_origen='".$this->telefono."' and MONTH(fecha) =".$this->mes ." and YEAR(fecha) =".$this->anio." and lada_destino='".$this->lada."'");
		
		$salida=0;
		
		if($llamadas){
			$this->consultaLocal=$llamadas;
			if(mysql_num_rows($llamadas)>$this->beneficio){
				for($i=$this->beneficio;$i<mysql_num_rows($llamadas);$i++){
					mysql_data_seek($llamadas,$i);
					$ar=mysql_fetch_row($llamadas);
					
					$salida+=($this->getDiferenciaMinutos($ar[5],$ar[6])*$this->local);
					
				}
			}			
		}
		
		return $salida+$this->renta;
		
	}
	
	function calculaEstatal(){
		$llamadas=$this->con->query("SELECT lada_origen,tel_origen,lada_destino,tel_destino,fecha,tiempo_ini,tiempo_fin FROM 07_llamada join 07_lada on 07_llamada.lada_destino=07_lada.id_lada WHERE lada_origen='".$this->lada."' and tel_origen='".$this->telefono."' and MONTH(fecha) =".$this->mes ." and YEAR(fecha) =".$this->anio." and edo_lada='".$this->estado."' and lada_destino != '".$this->lada."'");
		
		$salida=0;
		
		if($llamadas){
			$this->consultaEstatal=$llamadas;
				while($ar=mysql_fetch_row($llamadas)){
					
					$salida+=($this->getDiferenciaMinutos($ar[5],$ar[6])*$this->estatal);
					
				}
		}
		
		return $salida;
	}
	
	function calculaNacional(){
		$llamadas=$this->con->query("SELECT lada_origen,tel_origen,lada_destino,tel_destino,fecha,tiempo_ini,tiempo_fin FROM 07_llamada join 07_lada on 07_llamada.lada_destino=07_lada.id_lada WHERE lada_origen='".$this->lada."' and tel_origen='".$this->telefono."' and MONTH(fecha) =".$this->mes ." and YEAR(fecha) =".$this->anio." and edo_lada != '".$this->estado."' and lada_destino != '".$this->lada."'");
		
		$salida=0;
		
		if($llamadas){
			$this->consultaNacional=$llamadas;
				while($ar=mysql_fetch_row($llamadas)){
					
					$salida+=($this->getDiferenciaMinutos($ar[5],$ar[6])*$this->nacional);
					
				}
		}
		
		return $salida;	
				
		
	}
	
	function getDiferenciaMinutos($inicio,$final){
		return $this->getMinutos($final)-$this->getMinutos($inicio);
	}
	
	function getMinutos($hora){
		$arHora=split(":",$hora);
		$total=(0+$arHora[0])*60;
		$total+=(0+$arHora[1]);
		$total+=(0+$arHora[2])/60;
		
		return $total;
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
	
	function getFechaLimite(){
		$ms=$this->mes + 1;
		$an=$this->anio;
		$res="";
		if($ms==13){
			$ms=1;
			$an+=1;
		}
		
		switch ($ms) {
			 case 1:$res="05-ENE-".$an;break;
			 case 2:$res="05-FEB-".$an;break;
			 case 3:$res="05-MAR-".$an;break;
			 case 4:$res="05-ABR-".$an;break;
			 case 5:$res="05-MAY-".$an;break;
			 case 6:$res="05-JUN-".$an;break;
			 case 7:$res="05-JUL-".$an;break;
			 case 8:$res="05-AGO-".$an;break;
			 case 9:$res="05-SEP-".$an;break;
			 case 10:$res="05-OCT-".$an;break;
			 case 11:$res="05-NOV-".$an;break;
			 case 12:$res="05-DIC-".$an;break;
		 }		 
		 return $res;	
	}

}

?>

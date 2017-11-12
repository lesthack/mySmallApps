<?php 
	require('fpdf/fpdf.php');
	require('InfoRecibo.php');
	
	if(isset($_REQUEST['id']) && isset($_REQUEST['mes']) && isset($_REQUEST['anio'])){
			
			$data=new InfoRecibo($_REQUEST['id'],$_REQUEST['mes'],$_REQUEST['anio']); 
	
			$pdf=new FPDF();
			$pdf->AddPage();
			
			//imagenes
			$pdf->Image("../css/images/logRecibo.jpg",5,7,60,30);
			$pdf->Image("../css/images/publicidad.jpg",99,82,60,130);
			$pdf->Image("../css/images/publicidad2.jpg",99,227,60,45);
			
			//modulo superios izquierdo
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(98,19);
			$pdf->Cell(50,5,'Total a Pagar:','B');$pdf->SetXY(98,19); $pdf->Cell(50,5,'$'.$data->total.".00",0,0,'R');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(98,24);
			$pdf->Cell(50,5,'Pagar antes de:','B'); $pdf->SetXY(98,24); $pdf->Cell(50,5,$data->pagarAntes,0,0,'R');
			$pdf->SetXY(98,29);
			$pdf->Cell(50,5,'Mes de Facturacion:','B');$pdf->SetXY(98,29); $pdf->Cell(50,5,$data->mesFacturacion,0,0,'R');
			$pdf->SetXY(98,34);
			$pdf->Cell(50,5,'Telefono:','B'); $pdf->SetXY(98,34); $pdf->Cell(50,5,'('.$data->lada.')'.$data->telefono,0,0,'R');
			$pdf->SetXY(98,39);
			$pdf->Cell(50,5,'Factura No.:','B'); $pdf->SetXY(98,39); $pdf->Cell(50,5,$data->id,0,0,'R');
			
			//modulo de datos personales
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,42);
			$pdf->Cell(50,5,$data->nombre);
			$pdf->SetXY(5,48);
			$pdf->Cell(50,5,$data->direccion);
			$pdf->SetXY(5,52);
			$pdf->Cell(50,5,$data->ciudad.", ".$data->estado);
			$pdf->SetXY(5,56);
			$pdf->Cell(50,5,"C.P. ".$data->cp);
			
			//modulo de estado de cuenta
			$pdf->SetFont('Arial','B',12);
			$pdf->SetXY(5,82);
			$pdf->Cell(84,5,'Estado de cuenta','B');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,87);
			$pdf->Cell(84,5,'Saldo Anterior','B'); $pdf->SetXY(5,87); $pdf->Cell(84,5,$data->saldoAnt,0,0,'R');
			$pdf->SetXY(5,92);
			$pdf->Cell(84,5,'Su Pago Gracias','B');$pdf->SetXY(5,92); $pdf->Cell(84,5,'-'.$data->saldoAnt,0,0,'R');
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,97);
			$pdf->Cell(84,5,'Saldo'); $pdf->SetXY(5,97); $pdf->Cell(84,5,$data->saldo,0,0,'R');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,102);
			$pdf->Cell(84,5,'Cargo por Redondeo'); $pdf->SetXY(5,102); $pdf->Cell(84,5,"+".$data->redondeo,0,0,'R');
			$pdf->SetXY(5,107);
			$pdf->Cell(84,5,'Cargos del Mes','B'); $pdf->SetXY(5,107); $pdf->Cell(84,5,'+'.$data->cargosMes,0,0,'R');
			$pdf->SetXY(5,112);
			$pdf->Cell(84,5,'IVA','B');$pdf->SetXY(5,112); $pdf->Cell(84,5,'+'.$data->iva,0,0,'R');
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,117);
			$pdf->Cell(84,5,'SubTotal');$pdf->SetXY(5,117); $pdf->Cell(84,5,'$ '.$data->subTotal,0,0,'R');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,122);
			$pdf->Cell(84,5,'Credito por Redondeo','B');$pdf->SetXY(5,122); $pdf->Cell(84,5,'-'.$data->creRedondeo,0,0,'R');
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,127);
			$pdf->Cell(84,5,'Total a Pagar');$pdf->SetXY(5,127); $pdf->Cell(84,5,'$ '.$data->total.".00",0,0,'R');
			
			//modulo de cargos del mes
			$pdf->SetFont('Arial','B',12);
			$pdf->SetXY(5,147);
			$pdf->Cell(84,5,'Cargos del Mes','B');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,152);
			$pdf->Cell(84,5,'Servicio Local','B');$pdf->SetXY(5,152); $pdf->Cell(84,5,$data->servicioLocal,0,0,'R');
			$pdf->SetXY(5,157);
			$pdf->Cell(84,5,'Servicio Estatal','B');$pdf->SetXY(5,157); $pdf->Cell(84,5,$data->servicioEstatal,0,0,'R');
			$pdf->SetXY(5,162);
			$pdf->Cell(84,5,'Servicio Nacional','B');$pdf->SetXY(5,162); $pdf->Cell(84,5,$data->servicioNacional,0,0,'R');
			$pdf->SetXY(5,167);
			$pdf->Cell(84,5,'SubTotal');$pdf->SetXY(5,167); $pdf->Cell(84,5,'$ '.$data->cargosMes,0,0,'R');
			
			//modulo de informacion
			$pdf->SetFont('Arial','B',8);
			$pdf->SetXY(5,192);
			$pdf->Cell(84,5,'Informacion','B');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,197);
			$pdf->Cell(84,5,'***> Atencion a clientes: 01 (800) 123 0000'); 
			$pdf->SetXY(5,202);
			$pdf->Cell(84,5,'***> Paga tu recibo facil y rapido en: telmex.com');
			$pdf->SetXY(5,207);
			$pdf->Cell(84,5,'','B');
			
			//modulo del infrmacion talon
			$pdf->SetFont('Arial','',12);
			$pdf->SetXY(5,227);
			$pdf->Cell(84,5,'Nombre del Cliente','B');
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(5,232);
			$pdf->Cell(84,5,'Telefono: '.'('.$data->lada.')'.$data->telefono,'B');
			$pdf->SetXY(5,237);
			$pdf->Cell(84,5,'Mes de facturacion: '.$data->mesFacturacion,'B'); 
			
			$pdf->SetXY(55,232);
			$pdf->Cell(42,5,'Total a Pagar: $'.$data->total.".00",'B');
			$pdf->SetXY(55,237);
			$pdf->Cell(42,5,'Pagar antes de: '.$data->pagarAntes,'B');  		
			
			
			$pdf->Output();
		}else{
			$pdf=new FPDF();
			$pdf->AddPage();
			$pdf->Image("../css/images/logRecibo.jpg",5,7,60,30);
			$pdf->SetFont('Arial','B',18);
			$pdf->SetXY(0,40);
			$pdf->Cell(80,5,'No se puede Generar.','B');
			$pdf->Output();
		}
?>
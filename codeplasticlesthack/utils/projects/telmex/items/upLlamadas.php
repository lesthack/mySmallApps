<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" /> 
		<title>Telefonos de México Telmex</title>
		<meta content="es" http-equiv="Content-Language" />
		<meta content="Telmex" name="Author" />
		<meta content="Telefonos de MÃ©xico Telmex" name="Description" />
		<link media="all" href="../css/style.css" type="text/css" rel="stylesheet" />
        
        </head>
	<body>
    <div id="root">
    <div id="bodier">
    <div id="content">
        <div id="llamadas">
        <p>
            Seleccione el archivoque contiene las llamadas que seran subidas al servidor(formato .txt). 
        </p>
        <form id="datos_personales" action="upLlamadas.php" method="POST" enctype="multipart/form-data">
            <h1 class="titulo">:: Altas Llamadas</h1>
            <div class="subform">
                <table>
                        <tr>
                            <td>
                                <label for="nombre">
                                    File*:							
                                 </label>						
                            </td>
                            <td><input id="file" name="file" type="file"/><br/></td>
                            <td><input id="subFile" name="subFile"type="submit" value="Subir"/></td>
                         </tr>
                 </table>
             </div>
       </form>   
    </div>
   </div>
   </div>
   </div>
    
    </body>
</html>


<?php	
		$nameFile="files\\Llmadas";
		
		if (is_uploaded_file($HTTP_POST_FILES['file']['tmp_name'])) {
	       if($HTTP_POST_FILES['file']['type']=="text/plain"){
	           copy($HTTP_POST_FILES['file']['tmp_name'],$nameFile);
			   subirLlamadas($nameFile);
			   echo "El archivo se ha suvido satisfactoriamente";
			}else{
				echo "el archivo no se puede subir ya que no tiene la extension .txt";
			}		
		}		
		
		function subirLlamadas($file){
			if(!$bd) require('bd/connection.php');

			$con = new connection_telmex;
			
			$fo=fopen($file,'r') or die(' No se encuentra el archivo '.$file);
			echo $con->Error;
			while(!feof($fo)){
				$line=fgets($fo);
				$ar_line=split(" ",$line);
				
				$query="INSERT INTO	07_llamada (lada_origen,tel_origen,lada_destino,tel_destino,fecha,tiempo_ini,tiempo_fin) VALUES 
				('".$ar_line[0]."','".$ar_line[1]."','".$ar_line[2]."','".$ar_line[3]."','".$ar_line[4]."','".$ar_line[5]."','".$ar_line[6]."')";
				
				
				$con->query($query);
				echo $con->Error;
			}
		}
?>
		
        
        
		

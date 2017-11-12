    <script language="javascript" type="text/javascript">
	
	function recuperarRegistros(){
	
		if(document.getElementById("semes").checked)		
		 	tipo=1;		 
		else
		 	tipo=0;
			
		if(document.getElementById("usuario").value!="")	
		 tipo=2;
	
		new _Ajax({
				method: 'post',
				url: "items/consultarMes.php",
				data: 'mes=' + document.getElementById("mes").value + '&ano='+ new Date().getFullYear() + '&usuario=' + document.getElementById("usuario").value + '&tipo='+ tipo,
				update: $('grafica'),
				evalScripts: true,
				onComplete: function(){

				}
			}).request();
	
	}//recuperarRegistros

	function mostrarCapa(capa){
	
		if(capa == 'pago de usuarios'){
		  $('capa2').addClass('hide');
		  $('capa1').removeClass('hide');
		  document.getElementById("usuario").value="";
		  }
		else{
		  $('capa1').addClass('hide');
		  $('capa2').removeClass('hide');		  
		  document.getElementById("semes").checked=0;
  		  document.getElementById("seano").checked=0;
		  }	
	}//mostrarCapa
    
    function verificar(){

	var totalMeses = new Date().getMonth();	
		var meses = document.getElementById("mes");
		
	  if(meses.value=="")
		for(x=0;x<=totalMeses;x++){		
			var opcion = document.createElement("option");
			
				switch(x){
							
					case 0: var txt = document.createTextNode("enero")
								break;
					case 1: var txt = document.createTextNode("febrero")
								break;	
					case 2: var txt = document.createTextNode("marzo")
								break;	
					case 3: var txt = document.createTextNode("abril")
								break;	
					case 4: var txt = document.createTextNode("mayo")
								break;	
					case 5: var txt = document.createTextNode("junio")
								break;	
					case 6: var txt = document.createTextNode("julio")
								break;	
					case 7: var txt = document.createTextNode("agosto")
								break;	
					case 8: var txt = document.createTextNode("septiembre")
								break;	
					case 9: var txt = document.createTextNode("octubre")
								break;	
					case 10: var txt = document.createTextNode("noviembre")
								break;	
					case 11: var txt = document.createTextNode("diciembre")
								break;					
					
				}//switch
				
			opcion.appendChild(txt);
			meses.appendChild(opcion);
			
		}//for
		
	}
    </script>
    
        <form>
        	<label for="opciones">Graficar por</label>
            <select id="opciones">
                <option>pago de usuarios</option>
                <option>por usuario</option>            
            </select>
            <input type="button" id="siguiente" name="siguiente" value="Siguiente" onclick="javascript:mostrarCapa(opciones.value);"/>
        </form>

		<form id="capa1">
                <div class="subform">
            		<label for="siguientes" >por mes</label>
					<input type="radio"  id="semes" name="a" onclick="javascript:verificar();" />
                    <select id="mes" name="mes">
                    </select>
                    
                    <label for="siguientes" >&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;año actual </label>
					<input type="radio"  id="seano" name="a"/>
                    
                    <label for="siguientes" >&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</label>
                    <input type="button" id="graficar" name="graficar" value="Graficar" onclick="javascript:recuperarRegistros();"/>
                    
            	</div>
		</form>


		<form id="capa2">
                <div class="subform">
            		<label for="id usuario: " >usuario</label>
					<input type="text"  id="usuario" name="usuario" />
                                        
					<input type="button"  id="filtrar" name="filtrar" value="Graficar" onclick="javascript:recuperarRegistros();"/>
                    
            	</div>
		</form>


		<form id="plan">
        
        <h1 class="titulo"> Formulario Gràficas </h1>
        
        <div id="grafica" align="center"> </div>
        
    	</form>

<script language="javascript" type="text/javascript">
		$('capa1').addClass('hide');
		$('capa2').addClass('hide');
</script>

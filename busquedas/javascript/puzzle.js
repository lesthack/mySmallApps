	var TimerIDP;
	var z = ['pi00','pf00'];

	
	function readXMLPuzzle(){
		changePuzzleIni();
		$('p_nodos').innerHTML = "0";
		$('p_edo').innerHTML = "Operando...";
		clearQueens();
		documentXML = null;
		XMLRequest.open("GET","puzzle.php?ini="+getPuzzleIni()+"&fin="+getPuzzleFin(),true);
		XMLRequest.onreadystatechange = function(){
			if(XMLRequest.readyState == 1){
				document.body.appendChild(shadow);
			}		
			else if(XMLRequest.readyState == 4) {
				parseXMLPuzzle(XMLRequest.responseXML);
				$('p_edo').innerHTML = "Activo";
				if($('shadow'))
					document.body.removeChild($('shadow'));
			}
		};
		XMLRequest.send(null);
	}
	
	function parseXMLPuzzle(documentXML){
		try{
			if (documentXML.getElementsByTagName("solved").length == 0){
				iters = documentXML.getElementsByTagName("iter");
				TimerIDP = setTimeout("MovePositionPuzzle(iters, 0)",500);
			}
			else{
				alert("El puzzle no tiene solucion.");
			}
		}
		catch(err){
			alert("Ocurrio un error, vuelva a intentarlo de nuevo.");
		}
	}
	
	function MovePositionPuzzle(iters,n){
		if(n < iters.length){
			for(var i=0; i<3; i++){
				for(var j=0; j<3; j++){
					value = iters[n].getElementsByTagName("p"+i+j)[0].firstChild.nodeValue;
					
					if(value == 0)
						$("p"+i+j).addClass('zero');
					else
						if($("p"+i+j).hasClass('zero'))
							$("p"+i+j).removeClass('zero');
							
					$("p"+i+j).innerHTML = value;
				}
			}
			TimerIDP = setTimeout("MovePositionPuzzle(iters,"+ (n+1) +")",500);
		}
		else{
			$('p_edo').innerHTML = "Pasivo";
			$('p_nodos').innerHTML = iters.length;
			clearTimeout(TimerIDP);
		}
	}
	
	function getPuzzleIni(){
		ini = "";
		for(var i=0; i<3; i++){
			for(var j=0; j<3; j++){
				ini += $("pi"+i+j).value;
			}
		}
		return ini;
	}
	
	function getPuzzleFin(){
		ini = "";
		for(var i=0; i<3; i++){
			for(var j=0; j<3; j++){
				ini += $("pf"+i+j).value;
			}
		}
		return ini;
	}
	
	function changePuzzleIni(){
		for(var i=0; i<3; i++){
			for(var j=0; j<3; j++){
				if($("pi"+i+j).value == 0)
					$("p"+i+j).addClass('zero');
				else
					if($("p"+i+j).hasClass('zero'))
						$("p"+i+j).removeClass('zero');	
				$("p"+i+j).innerHTML = $("pi"+i+j).value;
			}
		}
	}
	
	function changePos(element,p){
		if(!isValid($(element).id,$(z[p]).id))
			return;
 		$(z[p]).removeClass('zero');
		$(z[p]).value = $(element).value;

		$(element).value = '0';
		$(element).addClass('zero');
		
		z[p] = $(element).id;
		
		changePuzzleIni();
	}
	
	function isValid(pos, zero){
		if(Math.abs(zero.substring(2,3)-pos.substring(2,3))+Math.abs(zero.substring(3,4)-pos.substring(3,4)) <= 1)
			return true;
		return false;
	}
	
	
	
	
	
	
	
	

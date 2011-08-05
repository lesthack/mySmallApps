	var TimerIDR;
	function readXMLReinas(){
		if($("x").value >=0 && $("x").value < 8 && $("y").value >=0 && $("y").value < 8){
			$('r_nodos').innerHTML = "0";
			$('r_edo').innerHTML = "Operando...";
			clearQueens();
			documentXML = null;
			XMLRequest.open("GET","reinas.php?x="+$("x").value+"&y="+$("y").value,true);
			XMLRequest.onreadystatechange = function(){
				if(XMLRequest.readyState == 1){
					document.body.appendChild(shadow);
				}
				else if(XMLRequest.readyState == 4) {
					console.log(XMLRequest.responseXML);
					parseXMLReinas(XMLRequest.responseXML);
					$('r_edo').innerHTML = "Activo";
					if($('shadow'))
						document.body.removeChild($('shadow'));
				}
			};
			XMLRequest.send(null);
		}
		else{
			alert("Los datos de entrada son erroneos");
		}
	}
	
	function clearQueens(){
		for(var i=0; i<8; i++){
			for(var j=0; j<8; j++){
				if($("r"+i+j).hasClass("queen"))
					$("r"+i+j).removeClass("queen");
			}
		}
	}
	
	function parseXMLReinas(documentXML){
		items = documentXML.getElementsByTagName("item");
		for(var i=0; i<items.length; i++){
			positions = items[i].getElementsByTagName("position");
			TimerIDR = setTimeout("AddOrRemoveQueen(positions, 0)",$("mytime").value);
		}
	}
	
	function AddOrRemoveQueen(positions, n){
		if(n<positions.length){
			if (positions[n].getElementsByTagName("in").length>0){
				$("r"+positions[n].getElementsByTagName("in")[0].firstChild.nodeValue).addClass("queen");
			}
			else{
				$("r"+positions[n].getElementsByTagName("out")[0].firstChild.nodeValue).removeClass("queen");
			}
			TimerIDR = setTimeout("AddOrRemoveQueen(positions, "+(n+1)+")",$("mytime").value);
		}
		else{
			$('r_edo').innerHTML = "Pasivo";
			$('r_nodos').innerHTML = positions.length;
			clearTimeout(TimerIDR);
			//alert("Operacion Completa.\nNodos Generados:" + positions.length);
		}
	}


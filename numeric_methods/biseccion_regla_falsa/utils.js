	if (!Array.prototype.clone) {
		Array.prototype.clone = function() {
			var length = this.length, i;
			var clone = new Array(length);
			
			for(i = 0; i < length; i++) {
				if(this[i].constructor == Array)
					clone[i] = this[i].slice();
				else
					clone[i] = this[i];
			}
			
			return clone;
		}
	}
	
	function FormatDecimal(numero, n){
		var snumero=new String(numero);
		if(snumero.indexOf(".",0)==-1)
			return numero;
		var separacion = snumero.split(".");
		
		var i;
		var part_decimal=new String("");
		
		for(i=0;i<n;i++)
			part_decimal+=separacion[1].charAt(i);
		
		return parseFloat(separacion[0]+"."+part_decimal);
	}
	
	function eliminarUltimo(idobject)
	{
		var puntero=document.getElementById(idobject);
		if (puntero.childNodes.length>0) 
		puntero.removeChild(puntero.childNodes[puntero.childNodes.length-1]);  
	}
//var pila1 = new Stack(5);
var pila2 = new Array();

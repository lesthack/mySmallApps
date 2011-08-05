	
	
	function romberg(funcion, a, b){
		//var romb = document.getElementById("trapecio");
		Element.show('trapecio');
		var h1 = document.getElementById("h1");
		var h2 = document.getElementById("h2");
		var h3 = document.getElementById("h3");
		var h4 = document.getElementById("h4");
		
		var eh1=trapecio(funcion, a, b, 2);
		var eh2=trapecio(funcion, a, b, 4);
		var eh3=trapecio(funcion, a, b, 8);
		var eh4=trapecio(funcion, a, b, 16);
		
		h1.value = FormatDecimal(eh1,4);
		h2.value = FormatDecimal(eh2,4);
		h3.value = FormatDecimal(eh3,4);
		h4.value = FormatDecimal(eh4,4);
		
		R1.value = FormatDecimal((4/3)*eh2-(1/3)*eh1,4);
		R2.value = FormatDecimal((4/3)*eh3-(1/3)*eh2,4);
		R3.value = FormatDecimal((4/3)*eh4-(1/3)*eh3,4);
		R4.value = FormatDecimal((4/3)*parseFloat(R2.value)-(1/3)*parseFloat(R1.value),4);
		R5.value = FormatDecimal((4/3)*parseFloat(R4.value)-(1/3)*parseFloat(R3.value),4);
		R6.value = FormatDecimal((4/3)*parseFloat(R5.value)-(1/3)*parseFloat(R4.value),4);

		document.getElementById("raiz").value=R6.value;
	}
	
	function trapecio(funcion, fa, fb, fn){
		var a = parseFloat(fa);
		var b = parseFloat(fb);
		var n = parseFloat(fn);
		
		var increment=(b-a)/(n/2);
		
		var cont=a+increment;
		var s=0;
		
		while(cont<b){
			s+=2*function_evaluate(funcion,cont);
			cont+=increment;
		}
		
		var r = ((b-a)/n)*(function_evaluate(funcion,a) + s + function_evaluate(funcion,b));
		
		return r;
	}
	
	
	
	
	
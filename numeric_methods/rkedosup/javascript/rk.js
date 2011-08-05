	
	
	function rk4_explicit(funcion, x0, y0, h){

		k1=function_evaluate(funcion, x0, y0);
		k2=function_evaluate(funcion, x0 + h/2, y0 + (k1*h)/2);
		k3=function_evaluate(funcion, x0 + h/2, y0 + (k2*h)/2);
		k4=function_evaluate(funcion, x0 + h/2, y0 + (k3*h)/2);

		y1=y0+(h/6)*(k1+2*k2+2*k3+k4);

		return y1;
	}

	function rk4(funcion, x0, y0, a, b, n){
		y0=parseFloat(y0);
		x0=parseFloat(x0);
		a=parseFloat(a);
		b=parseFloat(b);
		n=parseFloat(n);

		h=(b-a)/n;
		eliminarUltimo('rk4_table'); //elimina el tbody
		elemento=document.getElementById('rk4_table'); //selecciona al objeto por id
		var tbody = document.createElement("tbody"); //crea un objeto tbody
		elemento.appendChild(tbody);	//se lo agrega a biseccion_table

		var k1=0, k2=0, k3=0, k4=0;
		
		for(w=0;w<n;w++){
			
			/*k1=function_evaluate(funcion, w, y0);
			k2=function_evaluate(funcion, w + h/2, y0 + (k1*h)/2);
			k3=function_evaluate(funcion, w + h/2, y0 + (k2*h)/2);
			k4=function_evaluate(funcion, w + h/2, y0 + (k3*h)/2);
			*/
			k1=h*function_evaluate(funcion, x0);
			k2=h*function_evaluate(funcion, x0 + h/2);
			k3=h*function_evaluate(funcion, x0 + h/2);
			k4=h*function_evaluate(funcion, x0 + h);

			//if(k1==null || k2==null || k3 == nul || k4==null)
				//return;
			
			y0=y0+(k1+2*k2+2*k3+k4)/6;
			x0=a+w*h;
			
			var row = document.createElement("tr");
				var cell1 = document.createElement("td");
					cell1.appendChild(document.createTextNode(FormatDecimal(x0,4)));
					row.appendChild(cell1);
				var cell2 = document.createElement("td");
					cell2.appendChild(document.createTextNode(FormatDecimal(k1,4)));
					row.appendChild(cell2);
				var cell3 = document.createElement("td");
					cell3.appendChild(document.createTextNode(FormatDecimal(k2,4)));
					row.appendChild(cell3);
				var cell4 = document.createElement("td");
					cell4.appendChild(document.createTextNode(FormatDecimal(k3,4)));
					row.appendChild(cell4);
				var cell5 = document.createElement("td");
					cell5.appendChild(document.createTextNode(FormatDecimal(k4,4)));
					row.appendChild(cell5);
				var cell6 = document.createElement("td");
					cell6.appendChild(document.createTextNode(FormatDecimal(y0,4)));
					row.appendChild(cell6);
				/*var cell3 = document.createElement("td");
				cell3.appendChild(document.createTextNode(""));
				row.appendChild(cell3);*/
			elemento.tBodies[0].appendChild(row);
		}
	}

	
	
	
	
	
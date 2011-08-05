	function biseccion(cadena,xi,xu,n){
		var MN = new MethodNumeric();
		if(MN.CheckExpresion(cadena)){
			xi=parseFloat(xi);
			xu=parseFloat(xu);
			n=parseInt(n);
			
			eliminarUltimo("biseccion_table"); //elimina el tbody
			elemento=document.getElementById('biseccion_table'); //selecciona al objeto por id
			var tbody = document.createElement("tbody"); //crea un objeto tbody
			elemento.appendChild(tbody);	//se lo agrega a biseccion_table
			
			var i;
			var xr_old=0;
			for(i=0;i<n;i++){
				var Mxi = new MethodNumeric();
				var Mxu = new MethodNumeric();
				var Mxr = new MethodNumeric();
				
				var funcionxi = Mxi.RemplaceFunctions(cadena);
					funcionxi = Mxi.ExpDiv(funcionxi);
					funcionxi = Mxi.RemplaceElement(funcionxi,"x",xi);
					funcionxi = Mxi.ConvertPostfix(funcionxi);
				var fxi = Mxi.EvaluePostfix(funcionxi); //evalua la ecuacion postfija

				var funcionxu = Mxu.RemplaceFunctions(cadena);
					funcionxu = Mxu.ExpDiv(funcionxu);
					funcionxu = Mxu.RemplaceElement(funcionxu,"x",xu);
					funcionxu = Mxu.ConvertPostfix(funcionxu);
				var fxu = Mxu.EvaluePostfix(funcionxu); //evalua la ecuacion postfija
				
				var xr=(xi+xu)/2;
				var funcionxr = Mxr.RemplaceFunctions(cadena);
					funcionxr = Mxr.ExpDiv(funcionxr);
					funcionxr = Mxr.RemplaceElement(funcionxr,"x",xr);
					funcionxr = Mxr.ConvertPostfix(funcionxr);
				var fxr = Mxr.EvaluePostfix(funcionxr); //evalua la ecuacion postfija

				var error=Math.abs(((xr-xr_old)/xr)*100);
				
				var row = document.createElement("tr");
					var cell1 = document.createElement("td");
						cell1.appendChild(document.createTextNode(i+1));
						row.appendChild(cell1);
					var cell2 = document.createElement("td");
						cell2.appendChild(document.createTextNode(FormatDecimal(xi,4)));
						row.appendChild(cell2);
					var cell3 = document.createElement("td");
						cell3.appendChild(document.createTextNode(FormatDecimal(xu,4)));
						row.appendChild(cell3);
					var cell4 = document.createElement("td");
						cell4.appendChild(document.createTextNode(FormatDecimal(fxi,4)));
						row.appendChild(cell4);
					var cell5 = document.createElement("td");
						cell5.appendChild(document.createTextNode(FormatDecimal(fxu,4)));
						row.appendChild(cell5);
					var cell6 = document.createElement("td");
						cell6.appendChild(document.createTextNode(FormatDecimal(xr,4)));
						row.appendChild(cell6);
					var cell7 = document.createElement("td");
						cell7.appendChild(document.createTextNode(FormatDecimal(fxr,4)));
						row.appendChild(cell7);
					var cell8 = document.createElement("td");
						cell8.appendChild(document.createTextNode(FormatDecimal(error,4)+"%"));
						row.appendChild(cell8);
				elemento.tBodies[0].appendChild(row);
				if(fxi*fxr>0) xi=xr;
				if(fxi*fxr<0) xu=xr;
				xr_old=xr;
			}
			
			
		}
		else
			alert("La expresion NO cumple las condiciones");
	}
	
	function falsi(cadena,xi,xu,n){
		var MN = new MethodNumeric();
		if(MN.CheckExpresion(cadena)){
			xi=parseFloat(xi);
			xu=parseFloat(xu);
			n=parseInt(n);
			
			eliminarUltimo("falsi_table"); //elimina el tbody
			elemento=document.getElementById('falsi_table'); //selecciona al objeto por id
			var tbody = document.createElement("tbody"); //crea un objeto tbody
			elemento.appendChild(tbody);	//se lo agrega a biseccion_table
			
			var i;
			var xr_old=0;
			for(i=0;i<n;i++){
				var Mxi = new MethodNumeric();
				var Mxu = new MethodNumeric();
				var Mxr = new MethodNumeric();
				
				var funcionxi = Mxi.RemplaceFunctions(cadena);
					funcionxi = Mxi.ExpDiv(funcionxi);
					funcionxi = Mxi.RemplaceElement(funcionxi,"x",xi);
					funcionxi = Mxi.ConvertPostfix(funcionxi);
				var fxi = Mxi.EvaluePostfix(funcionxi); //evalua la ecuacion postfija

				var funcionxu = Mxu.RemplaceFunctions(cadena);
					funcionxu = Mxu.ExpDiv(funcionxu);
					funcionxu = Mxu.RemplaceElement(funcionxu,"x",xu);
					funcionxu = Mxu.ConvertPostfix(funcionxu);
				var fxu = Mxu.EvaluePostfix(funcionxu); //evalua la ecuacion postfija
				
				var xr=xu-(fxu*(xi-xu))/(fxi-fxu);
				var funcionxr = Mxr.RemplaceFunctions(cadena);
					funcionxr = Mxr.ExpDiv(funcionxr);
					funcionxr = Mxr.RemplaceElement(funcionxr,"x",xr);
					funcionxr = Mxr.ConvertPostfix(funcionxr);
				var fxr = Mxr.EvaluePostfix(funcionxr); //evalua la ecuacion postfija

				var error=Math.abs(((xr-xr_old)/xr)*100);
				
				var row = document.createElement("tr");
					var cell1 = document.createElement("td");
						cell1.appendChild(document.createTextNode(i+1));
						row.appendChild(cell1);
					var cell2 = document.createElement("td");
						cell2.appendChild(document.createTextNode(FormatDecimal(xi,4)));
						row.appendChild(cell2);
					var cell3 = document.createElement("td");
						cell3.appendChild(document.createTextNode(FormatDecimal(xu,4)));
						row.appendChild(cell3);
					var cell4 = document.createElement("td");
						cell4.appendChild(document.createTextNode(FormatDecimal(fxi,4)));
						row.appendChild(cell4);
					var cell5 = document.createElement("td");
						cell5.appendChild(document.createTextNode(FormatDecimal(fxu,4)));
						row.appendChild(cell5);
					var cell6 = document.createElement("td");
						cell6.appendChild(document.createTextNode(FormatDecimal(xr,4)));
						row.appendChild(cell6);
					var cell7 = document.createElement("td");
						cell7.appendChild(document.createTextNode(FormatDecimal(fxr,4)));
						row.appendChild(cell7);
					var cell8 = document.createElement("td");
						cell8.appendChild(document.createTextNode(FormatDecimal(error,4)+"%"));
						row.appendChild(cell8);
				elemento.tBodies[0].appendChild(row);
				if(fxi*fxu>0) xi=xr;
				if(fxi*fxu<0) xu=xr;
				xr_old=xr;
			}
			
			
		}
		else
			alert("La expresion NO cumple las condiciones");
	}
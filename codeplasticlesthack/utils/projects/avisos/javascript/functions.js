	
	function MyHttpRequest(){
		try {
			objAjax = new XMLHttpRequest();
		} catch (trymicrosoft) {
			try {
				objAjax = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (othermicrosoft) {
				try {
					objAjax = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (failed) {
					objAjax = false;
				}
			}
		}
		return objAjax;
	}


	var avisos = new Array();

	
	function loadAvisosPageRGG(){
		var divrgg = document.getElementById("idrgg");
		objAjax = MyHttpRequest();
		objAjax.open("GET", "rgg");
		objAjax.onreadystatechange = function(){
			if (objAjax.readyState==4) {
// 				var divrgg = document.createElement("div");
				divrgg.innerHTML = objAjax.responseText;
				
				var divavisos = document.getElementById("contenido");
				var tabla = divavisos.getElementsByTagName("table");

				if(tabla.length<=0)
					return;
				
				var trs = tabla[0].getElementsByTagName("tr");
				
				for(var i=1;i<trs.length;i++){
					var node = {};
						node.id = trs[i].cells[0];
						node.descripcion = trs[i].cells[1];
						node.ingreso = trs[i].cells[2];
						node.expira = trs[i].cells[3];
					avisos.push(node);

				}
				
				divrgg.innerHTML = "";
				
				var table = document.getElementById("tabavisoscuerpo");
				
					for(var i=0;i<avisos.length;i++){
						var tr = document.createElement("tr");
// 							var td1 = document.createElement("td");
// 								td1.appendChild(document.createTextNode(avisos[i].id.innerHTML));
// 							tr.appendChild(td1);
							var td2 = document.createElement("td");
								var a = document.createElement("a");
								a.href="javascript:loadAvisoById(" + avisos[i].id.innerHTML + ")";
								a.appendChild(document.createTextNode(avisos[i].descripcion.innerHTML));
								td2.appendChild(a);
							tr.appendChild(td2);
							var td3 = document.createElement("td");
								td3.appendChild(document.createTextNode(avisos[i].ingreso.innerHTML));
							tr.appendChild(td3);
							var td4 = document.createElement("td");
								td4.appendChild(document.createTextNode(avisos[i].expira.innerHTML));
							tr.appendChild(td4);
						table.appendChild(tr);
						var tr2 = document.createElement("tr");
							var td5 = document.createElement("td");
								td5.colSpan = "3";
								td5.id = avisos[i].id.innerHTML;
								td5.style.display="none";
// 								td5.appendChild(document.createTextNode(loadAvisoById(avisos[i].id.innerHTML)));
							tr2.appendChild(td5);
						table.appendChild(tr2);
					}

			}
		}
		objAjax.send(null);
		
	}

	function loadAvisoById(id){
		var divaviso = document.getElementById("idavisos");
		var idaviso = document.getElementById(id);
		idaviso.style.display="";
		objAjax2 = MyHttpRequest();
		objAjax2.open("GET", "avisoId?id_p=" + id);
		objAjax2.onreadystatechange = function(){
			if (objAjax2.readyState==4){
				divaviso.innerHTML = objAjax2.responseText;
					var Detalles = document.getElementById("Detalles");
						var font = Detalles.getElementsByTagName("font");
						if(font.length<=0)
							return
						idaviso.innerHTML = font[0].innerHTML;
				divaviso.innerHTML = "";
			}
		}
		objAjax2.send(null);
	}
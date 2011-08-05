	var MethodNumeric = function(){
		//pila
		this.stack = new Array();
		this.postfix = new Array();
		//alfabeto
		this.alfa = new String("0123456789.+-*/^xy()=&COSENTANEXPLOG ");
		//simbolo anterior
		this.old_simbol = new String("");
		
		//cheka si la expresion tiene todos los caracteres permitidos
		this.CheckExpresion = function(expresion){
			var i;
			for(i=0;i<expresion.length;i++)
				if(!this.IsIntoAlfa(expresion.charAt(i)))
					return false;
			return true;
		}
		
		//cheka si un caracter esta permitido
		this.IsIntoAlfa=function(character){
			var j;
			for(j=0;j<this.alfa.length;j++)
				if(character==this.alfa.charAt(j))
					return true;
			return false;
		}
		
		//evalua una expresion postfija
		this.EvaluePostfix = function(stack_expresion_postfix){
			var resp=0;
			try{
				if(stack_expresion_postfix[stack_expresion_postfix.length-1]!="=")
					stack_expresion_postfix.push("=");
				while(stack_expresion_postfix.length>0){
					var i;
					for(i=0;i<stack_expresion_postfix.length;i++){
						var nextop=false;
						var nextopfunctions=false;
						var longitud=2;
						//alert(stack_expresion_postfix[i-2]+" "+stack_expresion_postfix[i]+" "+stack_expresion_postfix[i-1]);
						switch(stack_expresion_postfix[i]){
							case "+":
								resp=stack_expresion_postfix[i-2]+stack_expresion_postfix[i-1];
								nextop=true;
								break;
							case "-":
								resp=stack_expresion_postfix[i-2]-stack_expresion_postfix[i-1];
								nextop=true;
								break;
							case "*":
								resp=stack_expresion_postfix[i-2]*stack_expresion_postfix[i-1];
								nextop=true;
								break;
							case "/":
								resp=stack_expresion_postfix[i-2]/stack_expresion_postfix[i-1];
								nextop=true;
								break;
							case "^":
								resp=Math.pow(stack_expresion_postfix[i-2],stack_expresion_postfix[i-1]);
								nextop=true;
								break;
							case "C":
								resp=Math.cos(stack_expresion_postfix[i-1]);
								longitud=1;
								nextop=true;
								break;
							case "S":
								resp=Math.sin(stack_expresion_postfix[i-1]);
								longitud=1;
								nextop=true;
								break;
							case "T":
								resp=Math.tan(stack_expresion_postfix[i-1]);
								longitud=1;
								nextop=true;
								break;
							case "E":
								resp=Math.exp(stack_expresion_postfix[i-1]);
								longitud=1;
								nextop=true;
								break;
							case "L":
									resp=Math.log(stack_expresion_postfix[i-1]);
								longitud=1;
								nextop=true;
								break;
							case "=":
								return stack_expresion_postfix[0];
							
						}
						
						if(nextop){
							stack_expresion_postfix.splice(i-longitud,longitud+1,resp);
							//if(!confirm("r: "+resp+" stack:"+stack_expresion_postfix)) return null;
							break;
						}
						/*else if(nextopfunctions){
							stack_expresion_postfix.splice(i-1,2,resp);
							break;
						}*/
					}
				}
			}catch(e){	
				alert('Ocurrio un error. reportelo a lesthack@gmail con este fragmento:'+e);
			}
		}
		
		//convierte una expresion infija a postfija
		this.ConvertPostfix = function(stack_expresion){
			var i;
			//alert(stack_expresion);
			for(i=0;i<stack_expresion.length;i++){
				//alert("simbolo leido: " + stack_expresion[i]);
				if(typeof(stack_expresion[i])=="number" || stack_expresion[i]=="x"){
					this.postfix.push(stack_expresion[i]);
					this.old_simbol="";
				}
				else{
					//alert("simbolo anterior" + this.old_simbol);
					if(this.old_simbol=="^" || this.old_simbol=="*" || this.old_simbol=="/" || this.old_simbol=="("){
						this.old_simbol=stack_expresion[i];
						if(stack_expresion[i]=="(" || this.IsFunction(stack_expresion[i]))
							this.stack.push(stack_expresion[i]);
						else if(stack_expresion[i]=="-"){
							stack_expresion[i+1]=(-1)*stack_expresion[i+1];
							this.old_simbol="";
						}
					}
					else{
						this.old_simbol=stack_expresion[i];
						this.ChekPrecedence(stack_expresion[i]);
					}	
					
				}
				
			}
			return (this.postfix);
		}
		
		this.ChekPrecedence = function(simbol){
			if(this.stack.length==0){
				this.stack.push(simbol);
			}
			else{
				if(simbol=="("){
					this.stack.push(simbol);
				}
				else if(simbol==")"){
					while(true){
						var g=this.stack.pop();
						if(g=="(") break;
						if(this.stack.length==0){
							alert("La expresion esta escrita incorrectamente, mire si no falta alguna parentesis.");
							return null;
						}
						this.postfix.push(g);
					}
					if(this.stack.length>0)
						if(this.IsFunction(this.stack[this.stack.length]))
							this.postfix.push(this.stack.pop());
				}
				else if(simbol=="="){
					while(this.stack.length>0)
						this.postfix.push(this.stack.pop());
					this.postfix.push("=");
				}
				else{
					if(this.Precedence(simbol)<=this.Precedence(this.stack[this.stack.length-1]) && this.Asociative(simbol)=="L"){
						//alert("La presedencia de " + simbol + " es menor o igual a " + this.stack[this.stack.length-1]);
						//alert("Pila: " + this.stack + " simbolo:" + simbol);
						while(this.stack.length>0)
							this.postfix.push(this.stack.pop());
						this.stack.push(simbol);
					}
					else
						this.stack.push(simbol);
				}
			}
		}
		
		this.Precedence = function(simbol){
			switch(simbol){
				case "(": return 0;
				case "+":
				case "-": return 1;
				case "*":
				case "/": return 2;
				case "^": return 3;
			}
			return null;
		}
		
		this.Asociative = function(simbol){
			if(simbol=="^") return "R";
			return "L";
		}
		
		//Divide la expresion
		this.ExpDiv = function(expresion){
			var numer = new String("");
			var stack_expresion = new Array();
			var i;
			if(expresion.charAt(0)=="-") expresion="0"+expresion;
			if(expresion.length==1) expresion="0+"+expresion;
			expresion+="=";
			//Mientras no sean numeros, agregarlos a la expresion, si no, juntarlos hasta tener todo el numero
			for(i=0;i<expresion.length;i++){
				if(this.IsNumber(expresion.charAt(i))){
					numer+=expresion.charAt(i);
				}
				else{
					if(numer.length>0)
						stack_expresion.push(parseFloat(numer));
					numer="";
					stack_expresion.push(expresion.charAt(i));
				}
			}
			return stack_expresion;
		}
		
		//Obtiene si es numero o no
		this.IsNumber = function(cadena){
			var Number = new String("0123456789. ");
			for(i=0;i<Number.length;i++)
				if(cadena==Number.charAt(i))
					return true;
			return false;
		}
		
		this.IsFunction = function(cadena){
			if(cadena=="C" || cadena=="S" || cadena=="T" || cadena=="E" || cadena=="L")
				return true;
			return false
		}
		
		this.RemplaceElement = function(stack_expresion, element, remplace){
			var i=0;
			for(i=0;i<stack_expresion.length;i++)
				if(stack_expresion[i]==element)
					stack_expresion[i]=remplace;
			return stack_expresion;
		}
		
		this.RemplaceFunctions = function(cadena){
			//convierte a minusculas
			cadena = cadena.toLowerCase();
			//remplaza funciones trigonometricas
			cadena = cadena.replace("cos","C");
			cadena = cadena.replace("sen","S");
			cadena = cadena.replace("tan","T");
			cadena = cadena.replace("exp","E");
			cadena = cadena.replace("log","L");
			return cadena;
		}
	}
	
	function function_evaluate(funcion, fx)
	{
		var x=parseFloat(fx);
		var Fx = new MethodNumeric();
		if(!Fx.CheckExpresion(funcion))
			return null;
			
		var funcionx = Fx.RemplaceFunctions(funcion); //Remplazamos las funciones cos, sen, tan,...
			funcionx = Fx.ExpDiv(funcionx); //Dividmos la expresion
			funcionx = Fx.RemplaceElement(funcionx,"x",x); //Remplazamos el elemento x
			funcionx = Fx.ConvertPostfix(funcionx); //Convertimos a postfija
			//alert(funcionx);
		var Rx = Fx.EvaluePostfix(funcionx); //evalua la ecuacion postfija
		
		return Rx;
	}


	function function_evaluate(funcion, fx, fy)
	{
		var x=parseFloat(fx);
		var y=parseFloat(fy);
		
		var Fx = new MethodNumeric();
		if(!Fx.CheckExpresion(funcion))
			return null;
			
		var funcionx = Fx.RemplaceFunctions(funcion); //Remplazamos las funciones cos,sen, tan
				funcionx = Fx.ExpDiv(funcionx); //Dividmos la expresion
				
				funcionx = Fx.RemplaceElement(funcionx,"x",x); //Remplazamos el elemento x
				
				funcionx = Fx.RemplaceElement(funcionx,"y",y); //Remplazamos el elemento x
				
				funcionx = Fx.ConvertPostfix(funcionx); //Convertimos a postfija
				
			//alert(funcionx);
				var Rx = Fx.EvaluePostfix(funcionx); //evalua la ecuacion postfija
		
				return Rx;
	}
	
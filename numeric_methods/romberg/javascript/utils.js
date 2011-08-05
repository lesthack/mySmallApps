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
	
	function $() {
		var elements = new Array();
		var element;

		for (var i = 0; i < arguments.length; i++) {
			element = arguments[i];
			if (typeof element == 'string')
				element = document.getElementById(element);

			if (arguments.length == 1) 
				return element;

			elements.push(element);
		}

		return elements;
	}	
	
	var objeto = {
		hide: function(id){
			for (var i = 0; i < arguments.length; i++)
				$(arguments[i]).style.display = 'none';
		},
		show: function(id){
			for (var i = 0; i < arguments.length; i++)
				$(arguments[i]).style.display = '';
		},
		toggle: function(element) {
			var element;
			for (var i = 0; i < arguments.length; i++) {
				element = $(arguments[i]);
				element.style.display = (element.style.display == 'none' ? '' : 'none');
			}
		},
	  	remove: function(element) {
			element = $(element);
			element.parentNode.removeChild(element);
		},
		getHeight: function(element) {
			element = $(element);
			return element.offsetHeight; 
		},
		hasClassName: function(element, className) {
			element = $(element);
			if (!element)
				return;
			var a = element.className.split(' ');
			for (var i = 0; i < a.length; i++) {
				if (a[i] == className)
					return true;
			}
			return false;
		},
		addClassName: function(element, className) {
			element = $(element);
			Element.removeClassName(element, className);
			element.className += ' ' + className;
		},

		removeClassName: function(element, className) {
			element = $(element);
			if (!element)
				return;
			var newClassName = '';
			var a = element.className.split(' ');
	    	for (var i = 0; i < a.length; i++) {
				if (a[i] != className) {
					if (i > 0)
						newClassName += ' ';
					newClassName += a[i];
				}
			}
			element.className = newClassName;
		},
		// removes whitespace-only text node children
	  	cleanWhitespace: function(element) {
			var element = $(element);
			var node;
			for (var i = 0; i < element.childNodes.length; i++) {
				node = element.childNodes[i];
				if (node.nodeType == 3 && !/\S/.test(node.nodeValue)) 
					Element.remove(node);
			}
		}
	}

	
	
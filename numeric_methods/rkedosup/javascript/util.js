/*
 * Useful functions, from http://prototype.conio.net/
 */

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

Object.extend = function(destination, source) {
	for (property in source) {
		destination[property] = source[property];
	}
	return destination;
}

Object.prototype.extend = function(object) {
	return Object.extend.apply(this, [this, object]);
}

if (!Function.prototype.apply) {
	// Based on code from http://www.youngpup.net/
	Function.prototype.apply = function(object, parameters) {
		var parameterStrings = new Array();
		if (!object)     object = window;
		if (!parameters) parameters = new Array();

		for (var i = 0; i < parameters.length; i++)
			parameterStrings[i] = 'parameters[' + i + ']';

		object.__apply__ = this;
		var result = eval('object.__apply__(' + 
			parameterStrings.join(', ') + ')');
		object.__apply__ = null;
    
		return result;
	}
}

if (!Array.prototype.push) {
	Array.prototype.push = function() {
		var startLength = this.length;
		for (var i = (arguments.length - 1); i >= 0; i--)
			this[startLength + i] = arguments[i];
		return this.length;
	}
}

if(!Array.prototype.indexOf) {
	Array.prototype.indexOf = function(n) {
		var i = this.length - 1;
		while(i >= 0) {
			if(this[i] === n)
				return i;
			i--;
		}
		return -1;
	}
}

if (!Array.prototype.contains) {
	Array.prototype.contains = function(elm) {
		if(elm.constructor != Array) return this.indexOf(elm);
		
		var i = this.length - 1, j, arr;
		
		contains_outer:
		for(i = this.length - 1; i >= 0; i--) {
			arr = this[i];
			if(arr.constructor != Array) continue;
			if(arr.length != elm.length) continue;
			
			for(j = (arr.length - 1); j >= 0; j--) {
				if(arr[j] != elm[j]) continue contains_outer;
			}
			
			return i;
		}
		return -1;
	}
}

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

/*--------------------------------------------------------------------------*/

if (!window.Element) {
  var Element = new Object();
}

Object.extend(Element, {
	toggle: function() {
		var element;
		for (var i = 0; i < arguments.length; i++) {
			element = $(arguments[i]);
			element.style.display = 
				(element.style.display == 'none' ? '' : 'none');
		}
	},

	hide: function() {
		var element;
		for (var i = 0; i < arguments.length; i++) {
			element = $(arguments[i]);
			element.style.display = 'none';
		}
	},

	show: function() {
		var element;
		for (var i = 0; i < arguments.length; i++) {
			element = $(arguments[i]);
			element.style.display = '';
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
});

/*--------------------------------------------------------------------------*/

var Field = {
	clear: function() {
		for (var i = 0; i < arguments.length; i++)
			$(arguments[i]).value = '';
	},

	focus: function(element) {
		$(element).focus();
	},
  
	present: function() {
		for (var i = 0; i < arguments.length; i++)
			if ($(arguments[i]).value == '') return false;
		return true;
	},
  
	select: function(element) {
		$(element).select();
	},
   
	activate: function(element) {
		$(element).focus();
		$(element).select();
	}
}

/*--------------------------------------------------------------------------*/

var Form = {
	serialize: function(form) {
		var elements = Form.getElements($(form));
		var queryComponents = new Array();
    
		for (var i = 0; i < elements.length; i++) {
			var queryComponent = Form.Element.serialize(elements[i]);
			if (queryComponent)
				queryComponents.push(queryComponent);
		}
    
		return queryComponents.join('&');
	},
  
	getElements: function(form) {
		var form = $(form);
		var elements = new Array();
	
		for (tagName in Form.Element.Serializers) {
			var tagElements = form.getElementsByTagName(tagName);
			for (var j = 0; j < tagElements.length; j++)
				elements.push(tagElements[j]);
		}
		return elements;
	},
  
	getInputs: function(form, typeName, name) {
		var form = $(form);
		var inputs = form.getElementsByTagName('input');
    
		if (!typeName && !name)
			return inputs;
      
		var matchingInputs = new Array();
		for (var i = 0; i < inputs.length; i++) {
			var input = inputs[i];
			if ((typeName && input.type != typeName) ||
				(name && input.name != name)) 
			continue;
			matchingInputs.push(input);
		}

		return matchingInputs;
	},

	disable: function(form) {
		var elements = Form.getElements(form);
		for (var i = 0; i < elements.length; i++) {
			var element = elements[i];
			element.blur();
			element.disabled = 'true';
		}
	},

	enable: function(form) {
		var elements = Form.getElements(form);
		for (var i = 0; i < elements.length; i++) {
			var element = elements[i];
			element.disabled = '';
		}
	},

	focusFirstElement: function(form) {
		var form = $(form);
		var elements = Form.getElements(form);
		for (var i = 0; i < elements.length; i++) {
			var element = elements[i];
			if (element.type != 'hidden' && !element.disabled) {
				Field.activate(element);
				break;
			}
		}
	},

	reset: function(form) {
		$(form).reset();
	}
}

Form.Element = {
	serialize: function(element) {
		var element = $(element);
		var method = element.tagName.toLowerCase();
		var parameter = Form.Element.Serializers[method](element);
    
		if (parameter)
			return encodeURIComponent(parameter[0]) + '=' + 
        	encodeURIComponent(parameter[1]);
	},
  
	getValue: function(element) {
		var element = $(element);
		var method = element.tagName.toLowerCase();
		var parameter = Form.Element.Serializers[method](element);
    
		if (parameter) 
			return parameter[1];
	}
}

Form.Element.Serializers = {
	input: function(element) {
		switch (element.type.toLowerCase()) {
		case 'submit':
		case 'hidden':
		case 'password':
		case 'text':
			return Form.Element.Serializers.textarea(element);
		case 'checkbox':  
		case 'radio':
			return Form.Element.Serializers.inputSelector(element);
		}
		return false;
	},

	inputSelector: function(element) {
		if (element.checked)
			return [element.name, element.value];
	},

	textarea: function(element) {
		return [element.name, element.value];
	},

	select: function(element) {
		var value = '';
		if (element.type == 'select-one') {
			var index = element.selectedIndex;
			if (index >= 0)
				value = element.options[index].value || element.options[index].text;
		} else {
			value = new Array();
			for (var i = 0; i < element.length; i++) {
				var opt = element.options[i];
				if (opt.selected)
					value.push(opt.value || opt.text);
			}
		}
		return [element.name, value];
	}
}

/*--------------------------------------------------------------------------*/

var $F = Form.Element.getValue;

/*--------------------------------------------------------------------------*/

function debug(o, n) {
	w = window.open();
	d = w.document;
	d.open();
	alert(uneval(o));
	d.writeln('<html><head><title>Debugging '+n+'</title></head><body>');
	if(typeof(o) == 'string') {
		d.writeln('<pre>'+n+' = '+o.split('<').join('&lt;')+'</pre>');
	} else {
		d.writeln('<ul><li>'+n+' = '+o+'</li>');
		for(p in o) {
			d.writeln('<li>'+n+'.'+p+' = '+o[p]+'</li>');
		}
		d.writeln('</ul>');
	}
	d.writeln('</body></html>');
	d.close();
}

var StringBuffer = function() {
	this.contents = [];
	
	if(arguments.length > 0)
		StringBuffer.prototype.append.apply(this, arguments);
};

StringBuffer.prototype = {
	append: function() {
		var count = 0;
		for(var i = 0; i < arguments.length; i++) {
			if(typeof(arguments[i]) == "string") {
				this.contents.push(arguments[i]);
				count++;
			}
		}
		return count;
	},
	toString: function() {
		return this.contents.join("");
	}
};


/*
 * Matrix functions.
 *
 *	Author		: Luis Héctor Chávez <lhchavez@lhchavez.com>
 *	Copyright	: 2005
 */

function squareMatrix(n) {
	if(isNaN(n) || n <= 0) return false;
	
	var matrix = new Array(n);
	var val;
	
	if(arguments.length == 2)
		val = arguments[1];
	else
		val = 0;
	
	var i = n - 1, j;
	do {
		matrix[i] = new Array(n);
		j = n - 1;
		do {
			matrix[i][j] = val;
		} while(j--);
	} while(i--);
	
	return matrix;
}

function matrix(r, c) {
	if(isNaN(r) || r <= 0) return false;
	if(isNaN(c) || c <= 0) return false;
	
	var matrix = new Array(r);
	var val;
	
	if(arguments.length == 3)
		val = arguments[2];
	else
		val = 0;
	
	var i = r - 1, j;
	do {
		matrix[i] = new Array(n);
		j = c - 1;
		do {
			matrix[i][j] = val;
		} while(j--);
	} while(i--);
	
	return matrix;
}

function matrixIsomorphism(matrix_a, matrix_b) {
	if(matrix_a.length != matrix_b.length) return false;
	
	var len = matrix_a.length;
	
	var ma_r = new Array(len);
	var ma_c = new Array(len);
	var mb_r = new Array(len);
	var mb_c = new Array(len);
	
	var i = len-1, j = len-1;
	do {
		ma_r[i] = matrix_a[i].slice();
		mb_r[i] = matrix_b[i].slice();
		ma_c[i] = new Array(len);
		mb_c[i] = new Array(len);
	} while(i--);
	
	i = len-1;
	do {
		j = len-1;
		do {
			ma_c[i][j] = ma_r[j][i];
			mb_c[i][j] = mb_r[j][i];
		} while(j--);
	} while(i--);
	
	i = len-1;
	do {
		ma_r[i].sort();
		mb_r[i].sort();
		ma_c[i].sort();
		mb_c[i].sort();
	} while(i--);
	
	var iso = [];
	
	if(isomorphism()) return iso;
	else return false;
	
	function isomorphism() {
		var row = iso.length;
		var i, j;
		var ret;
		
		i = len - 1;
		
		outer: 
		do {
			if(iso.indexOf(i) != -1) continue;

			// ra == rb[i] && ca == cb[i]
			j = len-1;
			do {
				if(ma_r[row][j] != mb_r[i][j] || ma_c[row][j] != mb_c[i][j]) continue outer;
			} while(j--);

			// Si llegó hasta aquí, i es un candidato
			iso.push(i);
			row++;
			
			if(testmatch() && (row == len || isomorphism())) return true;
			
			iso.pop();
			row--;
		} while(i--);
		
		return false;
	}
	
	function testmatch() {
		var changes = iso.length - 1;
		
		if(changes == 0) return true;
		
		var n = changes - 1;
		
		do {
			if(matrix_a[changes][n] != matrix_b[iso[changes]][iso[n]]) return false;
		} while(n--);

		return true;
	}
}

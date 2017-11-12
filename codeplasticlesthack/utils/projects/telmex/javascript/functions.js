	var site = {
		prueba: function(){
			alert();
		},
		
		logout: function(){
			this.changeWindow("logout");
		},
		showLogin: function(){
			this.changeWindow("validate");
		},
		login: function(parametros){
			this.changeWindow("validate","username="+parametros.username,"password="+parametros.password);
		},
		changeWindow: function(){
			atributos="";
			
			for(var i=1;i<arguments.length;i++)
				atributos+=arguments[i]+((i==arguments.length-1)?"":"&");

			new _Ajax({
						method: 'post',
						url: "items/"+arguments[0]+".php",
						data: atributos,
						update: $('root'),
						evalScripts: true
					}).request();
			
		},
		cleanMsg: function(){
			$('messages').innerHTML="";
		},
		putMessage: function(mensaje){
			$('messages').innerHTML="<b>" + mensaje + "</b>";
		} 
	}
	
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
				try{
					element.addClass('disable');
				}catch(e){}
			}
		},

		enable: function(form) {
			var elements = Form.getElements(form);
			for (var i = 0; i < elements.length; i++) {
				var element = elements[i];
				element.disabled = '';
				try{
					element.removeClass('disable');
				}catch(e){}
			}
		},
		
		blocked: function(form) {
			var elements = Form.getElements(form);
			for (var i = 0; i < elements.length; i++) {
				var element = elements[i];
				element.blur();
				if(element.type.toLowerCase()=="select-one" || element.type.toLowerCase()=="button" || element.type.toLowerCase()=="checkbox" || element.type.toLowerCase()=="radio" || element.type.toLowerCase()=="password")
					element.disabled = 'true';
				else
					element.readOnly = 'true';
			}
		},
		
		disblocked: function(form) {
			var elements = Form.getElements(form);
			for (var i = 0; i < elements.length; i++) {
				var element = elements[i];
				element.blur();
				if(element.type.toLowerCase()=="select-one" || element.type.toLowerCase()=="button" || element.type.toLowerCase()=="checkbox" || element.type.toLowerCase()=="radio" || element.type.toLowerCase()=="password")
					element.disabled = '';
				else
					element.readOnly = '';
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
		},
		
		getParametersByPHP: function(form){
			var elements = Form.getElements(form);
			var parametros="";
			for (var i = 0; i < elements.length; i++) {
				var element = elements[i];
				switch (element.type.toLowerCase()) {
					case 'text':
					case 'select-one':
					case 'hidden':
					case 'password':
					case 'checkbox':  
					case 'radio':	
						parametros+=element.id+"="+element.value+"&";
				}
			}
			return parametros.slice(0,-1);;
		},
		getLabels: function(form, element){
			var form = $(form);
			var labels = form.getElementsByTagName('label');
			var elements = new Array();

			for (var i = 0; i < labels.length; i++) 
				if(labels[i].getAttribute("for")==element)
					elements.push(labels[i]);

			return elements;
		},
		
		validate: function(form){
			var elements = Form.getElements(form);
			var complete=true;
			for (var i = 0; i < elements.length; i++) {
				var element = elements[i];
					if(element.value.length==0){
						complete=false;
						var labels = Form.getLabels(form, element.id);
						for (var j = 0; j < labels.length; j++)
							labels[j].addClass("vacio");
					}
					else{
						var labels = Form.getLabels(form, element.id);
						for (var j = 0; j < labels.length; j++)
							labels[j].removeClass("vacio");
					}
			}
			if(!complete)
				return false;
			return true;
		},
		
		passwords: function(password, repassword){
			password = $(password);
			repassword = $(repassword);

			if(password.value==repassword.value)
				return true;
			
			return false;
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

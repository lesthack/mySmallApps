	var _Ajax = new Class({
		options: {
			async: true,
			method: 'get',
			url: null,
			data: null,
			update: Class.empty,
			onComplete: Class.empty,
			encoding: 'utf-8',
			headers: {},
			evalScripts: false
		},
		initialize: function(options){
			this.setOptions(options);
			this.myAjax = (window.XMLHttpRequest) ? new XMLHttpRequest() : (window.ie ? new ActiveXObject('Microsoft.XMLHTTP') : false);
			this.headers = {};
			this.headers['Content-type']='application/x-www-form-urlencoded' + ((this.options.encoding) ? '; charset=' + this.options.encoding : '');
			
		},
		request: function(){
			data = this.options.data;
		
			var url=this.options.url + ((this.options.method.toUpperCase()=='GET')?'?'+this.options.data:'');

			this.myAjax.open(this.options.method,url,this.options.async);

			for (var type in this.headers) try {this.myAjax.setRequestHeader(type, this.headers[type]);} catch(e){};
			
			this.myAjax.onreadystatechange = this.readystatechange.bind(this);
			
			(this.options.method.toUpperCase()=='POST')?this.myAjax.send((this.options.data)?this.options.data:null):this.myAjax.send(null);

		},
		readystatechange: function(){
			if(this.myAjax.readyState == 1){
				var shadow = document.createElement("div");
					shadow.setAttribute('id','shadow');
					shadow.setAttribute('class','shadow');
				document.body.appendChild(shadow);
			}
			else if(this.myAjax.readyState == 4) {
				if(this.myAjax.status == 200)
					if (this.options.update) $(this.options.update).empty().setHTML(this.myAjax.responseText);
					if (this.options.evalScripts) this.evalScripts();
				this.options.onComplete();
				if($('shadow'))
					document.body.removeChild($('shadow'));
			}
		},
		evalScripts: function(){
			var script, scripts;
			if (this.options.evalResponse) 
				scripts = this.myAjax.responseText;
			else{
				scripts = [];
				var regexp = /<script[^>]*>([\s\S]*?)<\/script>/gi;
				while ((script = regexp.exec(this.myAjax.responseText))) scripts.push(script[1]);
				scripts = scripts.join('\n');
			}
			if (scripts) (window.execScript) ? window.execScript(scripts) : window.setTimeout(scripts, 0);
		}
	});
	
	_Ajax.implement(new Options);
	
	var XMLRequest = (window.XMLHttpRequest) ? new XMLHttpRequest() : (window.ie ? new ActiveXObject('Microsoft.XMLHTTP') : false);

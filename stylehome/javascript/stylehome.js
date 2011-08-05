
	function mas(id){
		var obj = $(id);
		var k=parseFloat($('increment').value);
		var valor = parseFloat(obj.value);
		if(valor<=(255-k))
			obj.value=valor+k;
	}

	function menos(id){
		var obj = $(id);
		var k=parseFloat($('increment').value);
		var valor = parseFloat(obj.value);
		if(valor>=(0+k))
			obj.value=valor-k;
	}

	function cambia(id,n,cr,cg,cb){
		var r=$(cr).value;
		var g=$(cg).value;
		var b=$(cb).value;
		for(var i=0;i<n;i++){
			var obj = $(id+"[" + i + "]");
			obj.style.background="rgb(" + r + "," + g + "," + b + ")";
		}
		
	}
	
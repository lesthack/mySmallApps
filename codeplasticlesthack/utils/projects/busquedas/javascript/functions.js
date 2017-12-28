	var XMLRequest = (window.XMLHttpRequest) ? new XMLHttpRequest() : (window.ie ? new ActiveXObject('Microsoft.XMLHTTP') : false);
	var shadow = document.createElement("div");
		shadow.setAttribute('id','shadow');
		shadow.setAttribute('class','shadow');
	
	var activeTab = 'mreinas';

	function showTab(tab){
		newtab = tab.id.slice(1,tab.id.length);
		oldtab = activeTab.slice(1,activeTab.length);
		
		$(activeTab).removeClass('active');
		$(tab).addClass('active');
		activeTab = $(tab).id;
		
		$(newtab).removeClass('hide');
		$(oldtab).addClass('hide');
	}



<?php
	session_start(); //iniciamos las sesiones
?>
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" /> 
		<title>Telefonos de México Telmex</title>
		<meta content="es" http-equiv="Content-Language" />
		<meta content="Telmex" name="Author" />
		<meta content="Telefonos de MÃ©xico Telmex" name="Description" />
		<link media="all" href="css/style.css" type="text/css" rel="stylesheet" />
		<!-- script src="http://www.savethedevelopers.org/say.no.to.ie.6.js"></script -->
		<script language="javascript" src="javascript/mootools.js" type="text/javascript" ></script>
		<script language="javascript" src="javascript/Ajax.js" type="text/javascript" ></script>
		<script language="javascript" src="javascript/functions.js" type="text/javascript" ></script>
		<script language="javascript" src="javascript/FusionCharts.js" type="text/javascript" ></script>
	</head>
	<body>
		<div id="root">
			<?php
				$ACTIVE=true; //vandera para ver si esta activo	
			?>
		</div>
	</body>
	<script language="javascript" type="text/javascript">
		window.addEvent("domready", function(){
			site.showLogin();
		});
	</script>
</html> 

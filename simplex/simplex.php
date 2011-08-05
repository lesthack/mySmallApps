    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <title>Simplex Inocorp</title>
            <meta http-equiv="content-type" content="text/html;charset=utf-8" />
            <link rel="stylesheet" type="text/css" href="css/style.css" />
            <link rel="stylesheet" type="text/css" href="css/simplex.css" />
        </head>

        <body>
   			<div class="simplex"></div>
			<div class="inocorp"></div>
            <div id="first_container">
                <div id="second_container">
                    <div id="third_container">
                        <ul id="menu">
                            <li><a href="ayuda.php">Ayuda</a></li>
                            <li><span id="menuselected">Simplex()</span></li>
                            <li><a href="proyecto.php">Proyecto</a></li>
                            <li><a href="index.php">Home</a></li>
                        </ul>
                        <div class="border">
                            <div class="content">
                               <?php
                               	$phase=$_REQUEST["phase"]; 

                               	switch($phase){
                               		case 0:
                               			require_once("phase0.php");
                               			break;
                               		case 1:
                               			require_once("phase1.php");
                               			break;
                               		case 2:
                               			require_once("phase2.5.php");
                               			break;
                               		case 3:
                               			require_once("phasen.php");
                               			break;
                               		case 4:
                               			require_once("phase2n.php");
                               			break;
                               	}
                               ?> 
                            </div>
                        </div>

                        <ul id="submenu">
                            <li><span id="submenuselected">Español</span></li>
                            <li><a href="">English</a></li>
                        </ul>
                        
                        <div class="designinfo">
                            valid XHTML | valid CSS | Inocorp
                        </div>
                        
                    </div>
                </div>
            </div>
                    
        </body>
        
    </html>
    

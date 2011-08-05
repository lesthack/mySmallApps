    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <title>Simplex Inocorp</title>
            <meta http-equiv="content-type" content="="text/ht; charset=UTF-8" ">
            <link rel="stylesheet" type="text/css" href="css/style.css" />
        </head>

        <body>
			<div class="simplex"></div>
			<div class="inocorp"></div>        
            <div id="first_container">
                <div id="second_container">
                    <div id="third_container">
                        <ul id="menu">
                            <li><span id="menuselected">Ayuda</span></li>
                            <li><a href="simplex.php">Simplex()</a></li>
                            <li><a href="proyecto.php">Proyecto</a></li>
                            <li><a href="index.php">Home</a></li>
                        </ul>
                        
                        <div class="title"></div>

                        <div class="border">
                            <div class="content">
                                    <h1>¿Como Utilizar el programa simplex?</h1>
                              <div class="text">
                                        <p>
                                        	Para el uso de la aplicación de simplex Inocorp se le da click en la pestaña de simplex().  La siguiente pantalla muestra el lugar exacto donde se puede entonctrar esta.
                                        </p>
										<p><img src="css/images/IM1.JPG" alt=""/></p>
										<p>Para observar el funcionamiento de la aplicacion utilizaremos el siguiente problema:<br />
											Max z=  3x1 – 5 x2<br />
												s.a<br />
												x1&lt;=4<br />
												2x2&lt;=12<br />
												3x1+  2x2&lt;=18<br />
												X1,x2&gt;=  0<br /></p>
																						
                                        <p>En la siguiente pantalla se muestra la fase 0 de la aplicacion donde se deben de introducir los siguientes datos:  <br /><ol>
<li>Numero de Variables: en esta opción se pondrán el numero de variables que  queramos para el problema a resolver</li>
<li>Numero  de Restricciones: aqui pondremos cuantas restricciones tendrá el modelo simplex</li>
<li>Objetivo: dependiendo que si la función objetivo es maximizar o minimizar.</li>
Nota:  tanto el numero de variables como restricciones serán mayores que 0.<br /></p>
</ol>
<p>Estos datos se introducen de acuerdo al problema que se desea resolver. En este caso como numero de variables se utilizo el dos pues las variables que se utilizan son la X1 y X2.  Por otro lado el numero de restricciones fue tres pues el problema esta sujeto a tres restricciones( x1&lt;=4, 2x2&lt;=12,3x1+  2x2&lt;=18).</p>
<p><img src="css/images/IM2.JPG" alt=""></p>
<P>

                                        <p>Cuando se termina de llenar se le da clic en el botón indicado para continuar como se mostro en la figura anterior</p>
										<p>Esto nos lleva a la fase 1 de la aplicacion. Esta se muestra en la siguiente pantalla  </p>
										<p><img src="css/images/IM3.JPG" alt=""/></p>
										<p>En esta fase se llena con la funcion objetivo, y las restricciones. La siguiente figura muestra la forma en que fue llenada para el problema que se trata de resolver</p>
										<img src="css/images/IM4.JPG" alt="" />
										<p>Ya teniendo los datos daremos click en siguiente(el boton que se muestra debajo de las restricciones) y como resultado obtendremos esto</p>
										<img src="css/images/IM5.JPG" alt="" />
										<p>Y asi saldrá la primera iteración, se dara click en el botón siguiente para continuar con las iteraciones o Anterior para ver una iteración anterior.</p>
										<p>Al aplicar siguiente y ver todas las iteraciones llegara el punto en que encontrar la solución optima el cual se presentara de la siguiente manera:
</p>
										<img src="css/images/IM6.JPG" alt="" heigth=95% width=95%/>
										<p>Aquí nos muestra como fueron encontrados los valores de las variables asi como el valor de z.</p>										<img src="css/images/IM7.JPG" alt="" />
                              </div>
									
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
    

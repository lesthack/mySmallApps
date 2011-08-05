    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <title>Simplex Inocorp</title>
            <meta http-equiv="content-type" content="text/html;charset=utf-8" />
            <link rel="stylesheet" type="text/css" href="css/style.css" />
        </head>

        <body>
        <div class="simplex"></div>
		<div class="inocorp"></div>
        <div id="first_container">
          <div id="second_container">
            <div id="third_container">
              <ul id="menu">
                <li><a href="ayuda.php">Ayuda</a></li>
                <li><a href="simplex.php">Simplex()</a></li>
                <li><span id="menuselected">Proyecto</span></li>
                <li><a href="index.php">Home</a></li>
              </ul>
              <div class="title"></div>
              <div class="border">
                <div class="content">
				<div class="text">
				
				<h1>Planteamiento del problema</h1>
				<ul><li>Introducción</li>
				<li>Antecedentes</li>
				<li>Objetivos</li>
				<li>Justificación</li>
				<li>Alcance</li>
				<li>Limitaciones</li>
                </ul>
				<h1>Marco Teorico</h1>   
                <ul>
				<li>Método Simplex</li>
				<li>Preparando El Modelo Para Adaptarlo al Método Simplex</li>
				<li>Cambio del tipo de optimización</li>
				<li>Desarrollando el Método Simplex</li>
				<li>Metodo Grafico</li>
				<li>PHP</li>
					<ul>
					<li>Los principales usos del PHP</li>
					<li>Ventajas de PHP</li>
					<li>Desventajas de PHP</li>
					</ul>
				</ul>
				<h1>Metodo</h1>
				<ul>
				<li>Algoritmo del Metodo Simplex</li>
				<li>Método Simplex</li>
				<li>Método de las Dos Fases</li>
				</ul>
				<p></p>
				</div>
				<hr />
				  <h1 name="Planteamientodelproblema" id="Planteamientodelproblema">1 Planteamiento del problema</h1>
                  <h2>1.1 Introducción</h2>
                  <div class="text">
                    <p> En la actualidad existen negocios en los cuales es difícil tomar una decisión en cuanto
                      a la producción se refiere, ya sea monetaria o material. Existen problemas en los
                      cuales se desea la maximización y en otros en los cuales se desea la minimización ya
                      que esto depende del problema el cual se desea resolver. Es por ello, que para estos
                      problemas se requiere tener conocimientos sobre la investigación de operaciones,
                      para así poder conocer cuál es la mejor decisión. Para esto es que los integrantes del
                      equipo de trabajo INOCORP decidieron buscar una solución la cual ayudara en este
                      tipo de problemas a personas cuyos conocimientos sobre la IO son escasos.  Los siguientes puntos dictaminaran lo que se realizara por parte
                      de INOCORP para poder darle solución a este problema.</p>
                  </div>
                  <h2>1.2 Antecedentes</h2>
                  <div class="text">
                    <p>El hombre desde sus inicios ha generado herramientas que le faciliten ciertas
                      actividades, desde la revolución industrial, muchos procesos fueron automatizados, de
                      ello, que la actualidad existan muchas utilidades del tipo software que le ayudan al ser
                      humano la tarea de hacerlo manualmente.</p>
                    <p>Existen herramientas de software en el mercado (por ejemplo Winqsb) capaces de
                      realizar las tareas que el equipo de INOCORP pretende desarrollar, sin embargo, su
                      uso requiere de una licencia que tiene precio. INOCORP pretende hacer de este
                      proyecto parte de la iniciativa de Software Libre.</p>
                  </div>
                  <h2>1.3 Objetivos</h2>
                  <div class="text">
                    <p>El objetivo del proyecto es proporciona al usuario, una herramienta capaz de resolver
                      los problemas que se presentan en la toma de decisiones (Investigación de
                      Operaciones), de una manera rápida, sencilla. Por lo tanto la solución de este será la
                      adecuada en el problema.<br />
                      Además, la construcción del software permitirá al usuario la correcta interpretación de
                      modelos de decisión basados en descripciones matemáticas, con el objetivo de tomar
                      decisiones en situaciones de complejidad o incertidumbre.</p>
                  </div>
                  <h2>1.4 Justificación</h2>
                  <div class="text">
                    <p>La aplicación de la investigación de operaciones es una herramienta a la solución de 
                      problemas de incremento de producción, o la disminución de recursos que le
                      ahorrarían a una empresa mucho capital.<br />
                      Es pues, indispensable, que el desarrollo de un software sea capaz de facilitarle el
                      proceso de predicción sobre estos aspectos tan importantes.<br />
                      Basados en el problema (llamado por nosotros como plantilla) el equipo de desarrollo 
                      INOCORP está empeñado en generar una herramienta que resuelva de manera 
                      dinámica y eficiente no solo el problema planteado, si no que a la par, sea capaz de
                      resolver todo problema planteado de manera coherente y adecuo a los requisitos que
                      exige.</p>
                  </div>
                  <h2>1.5 Alcance</h2>
                  <div class="text">
                    <p>El proyecto desarrollado pretende ser una herramienta capaz de interpretar datos de
                      entrada para arrojar datos de salida satisfactorios, coherentes y sobre todo útiles en la
                      industria. Dicho proyecto realiza problemas reales teniendo en cuenta el objetivo del
                      problema y las limitantes (restricciones) que tengan tanto el problema como el
                      software para su resolución. Es por ello que solo serán capaces de ser resueltos
                      aquellos problemas que sean factibles de realizar y capaces de arrojar resultados
                      coherentes.</p>
                  </div>
                  <h2>1.6 Limitaciones</h2>
                  <div class="text">
                    <p>Como para toda solución existen limitantes, también así para la realización de este
                      software existen ciertas limitantes pues como se sabe es imposible crear un software
                      el cual abarque todo y cada uno de los problemas de la vida real. Es por ello que
                      después de haberse definido completamente los objetivos de este proyecto, es
                      importante declarar las posibles limitaciones de puedan presentarse durante la
                      realización del mismo. Por lo tanto, algunas de ellas son:
				    <ul>
                      <li>El alcance del proyecto puede ser demasiado ambicioso, es decir, el proyecto
                      del desarrollo de software solo pretende resolver problemas de programación
                      lineal bien planteados de dos a mas variables.<br /></li>
                      <li>El factor tiempo puede no ser muy factible debido a las diversas actividades de
                      los integrantes del equipo INOCORP.<br /></li>
                      <li>El problema planteado como base tal vez no abarque todas las posibilidades
                      requeridas para el desarrollo del software por lo que será necesario buscar
                      mas.<br /></li>
                      <li>El capital para la creación física del software no sea el necesario para su
                      desarrollo.<br /></li>
                      <li>Los conocimientos de programación no sean los suficientes y esto aplace el
                      tiempo considerado para el desarrollo.</li>
				    </ul>
                      Estas limitantes son solo algunas de las cuales se tomaran en cuenta en la realización
                      de este proyecto. Pues existe la posibilidad de que surjan nuevas, las cuales se
                      trataran de resolver tan pronto como surjan.</p>
                  </div>
				  <h1>Marco Teorico</h1>
				  <div class="text">
                    <p>El proyecto del equipo Inocorp constituye un software  basado en el modelado de problemas (Método Simplex), capaz de resolver casos en  una pequeña cantidad de tiempo, se utilizara tecnología php, Java, para crear  el programa, a continuación definiremos cada una de las partes a usar para el  programa.</p>
                  <h3><strong>Método Simplex</strong></h3>
                    <p>El  método Simplex es un procedimiento iterativo que permite ir mejorando la  solución a cada paso. El proceso concluye cuando no es posible seguir mejorando  más dicha solución.</p>
                    <p>Partiendo  del valor de la función objetivo en un vértice cualquiera, el método consiste  en buscar sucesivamente otro vértice que mejore al anterior. La búsqueda se  hace siempre a través de los lados del polígono (o de las aristas del poliedro,  si el número de variables es mayor). Cómo el número de vértices<br />
                      (y de  aristas) es finito, siempre se podrá encontrar la solución. (Véase método  Gráfico)</p>
                    <p>El  método Simplex se basa en la siguiente propiedad: si la función objetivo, f, no  toma su valor máximo en el vértice A, entonces hay una arista que parte de A, a  lo largo de la cual f aumenta.</p>
                    <p>Deberá  tenerse en cuenta que este método sólo trabaja para restricciones que tengan un  tipo de desigualdad &quot;≤&quot; y coeficientes independientes mayores o  iguales a 0, y habrá que estandarizar las mismas para el algoritmo. En caso de  que después de éste proceso, aparezcan (o no varíen) restricciones del tipo  &quot;≥&quot; o &quot;=&quot; habrá que emplear otros métodos, siendo el más  común el método de las<br />
                      Dos  Fases.</p>
                  
				  <p><strong>Preparando El Modelo Para Adaptarlo al Método Simplex</strong></p>
				  
                    <p>Esta  es la forma estándar del modelo:</p>
                    <p>Función  objetivo: c1∙x1 + c2∙x2 + ... + cn∙xn<br />
                      Sujeto  a: <br />
                      a11∙x1  + a12∙x2 + ... + a1n∙xn = b1<br />
                      a21∙x1 + a22∙x2 + ... + a2n∙xn = b2<br />
                      ...<br />
                      am1∙x1 + am2∙x2 + ... + amn∙xn = bm<br />
                      x1,...,  xn ≥ 0</p>
                    <p>Para  ello se deben cumplir las siguientes condiciones:<br />
                      1. El  objetivo es de la forma de maximización o de minimización.<br />
                      2.  Todas las restricciones son de igualdad.<br />
                      3.  Todas las variables son no negativas.<br />
                      4. Las  constantes a la derecha de las restricciones son no negativas.</p>
				  <h3><strong>Cambio del tipo de optimización.</strong></h3>
				    <p>Si en  nuestro modelo, deseamos minimizar, podemos dejarlo tal y como está, pero  deberemos tener en cuenta nuevos criterios para la condición de parada  (deberemos parar de realizar iteraciones cuando en la fila del valor de la  función objetivo sean todos menores o iguales a 0), así como para la condición  de salida de la fila. Con objeto de no cambiar criterios, se puede convertir el  objetivo de minimizar la función F por el de maximizar F∙(1).</p>
                    <p>Ventajas:  No deberemos preocuparnos por los criterios de parada, o condición de salida de  filas, ya que se mantienen.</p>
                    <p>Inconvenientes:  En el caso de que la función tenga todas sus variables básicas positivas, y  además las restricciones sean de desigualdad &quot;≤&quot;, al hacer el cambio  se quedan negativas y en la fila del valor de la función objetivo se quedan  positivos, por lo que se cumple la condición de parada, y por defecto el<br />
                      valor  óptimo que se obtendría es 0.</p>
                    <p>Solución:  En la realidad no existen este tipo de problemas, ya que para que la solución  quedara por encima de 0, alguna restricción debería tener la condición &quot;≥&quot;,  y entonces entraríamos en un modelo para el método de las Dos Fases.<br />
                      Conversión  de signo de los términos independientes (las constantes a la derecha de las  restricciones) Deberemos preparar nuestro modelo de forma que los términos  independientes de las restricciones sean mayores o iguales a 0, sino no se  puede emplear el método Simplex.</p>
                    <p>Lo  único que habría que hacer es multiplicar por &quot;1&quot; las restricciones  donde los términos independientes sean menores que 0.</p>
                    <p>Ventaja:  Con ésta simple modificación de los signos en la restricción podemos aplicar el  método Simplex a nuestro modelo.<br />
                      Inconvenientes:  Puede resultar que en las restricciones donde tengamos que modificar los signos  de las constantes, los signos de las desigualdades fueran (&quot;=&quot;,  &quot;≤&quot;), quedando (&quot;=&quot;,&quot;≥&quot;) por lo que en cualquier  caso deberemos desarrollar el método de las Dos Fases. Este inconveniente no es  controlable,<br />
                      aunque  nos podría beneficiar si sólo existen términos de desigualdad  (&quot;≤&quot;,&quot;≥&quot;), y los &quot;≥&quot; coincidieran con restricciones  donde el término independiente es negativo.</p>
                    <p>Todas  las restricciones son de igualdad.<br />
                      Si en  nuestro modelo aparece una inecuación con una desigualdad del tipo  &quot;≥&quot;, deberemos añadir una nueva variable, llamada variable de exceso  si, con la restricción si ≥ 0. La nueva variable aparece con coeficiente cero  en la función objetivo, y restando en las inecuaciones.</p>
                    <p>Surge  ahora un problema, veamos como queda una de nuestras inecuaciones que contenga  una desigualdad &quot;≥&quot; :<br />
                      a11∙x1 + a12∙x2 ≥ b1 a11∙x1 + a12∙x2 1∙ xs = b1</p>
                    <p>Como  todo nuestro modelo, está basado en que todas sus variables sean mayores o  iguales que cero,cuando hagamos la primera iteración con el método Simplex, las  variables básicas no estarán en la base y tomarán valor cero, y el resto el  valor que tengan. En este caso nuestra variable xs, tras hacer cero a x1 y x2,  tomará el valor b1.</p>
                    <p>No  cumpliría la condición de no negatividad, por lo que habrá que añadir<br />
                      una  nueva variable, xr, que aparecerá con coeficiente cero en la función  objetivo, y sumando en la inecuación de la  restricción correspondiente. </p>
                    <p>Quedaría  entonces de la siguiente manera:<br />
                      a11∙x1 + a12∙x2 ≥ b1 a11∙x1 + a12∙x2 1∙ xs + 1 ∙xr = b1</p>
                    <p>Este  tipo de variables se les llama variables artificiales, y aparecerán cuando haya  inecuaciones con desigualdad (&quot;=&quot;,&quot;≥&quot;). Esto nos llevará  obligadamente a realizar el método de las Dos Fases, que se explicará más  adelante.<br />
                      Del  mismo modo, si la inecuación tiene una desigualdad del tipo &quot;≤&quot;,  deberemos añadir una nueva variable, llamada variable de holgura si, con la  restricción si &quot;≥&quot; 0 . La nueva variable aparece con coeficiente cero  en la función objetivo, y sumando en las inecuaciones.</p>
                    <p>A modo  resumen podemos dejar esta tabla, según la desigualdad que aparezca, y con el  valor que deben estar las nuevas variables.</p>
				  <p><img src="css/images/MTImagen1.JPG" alt=""  /></p>
				  <p><strong>Desarrollando el Método Simplex</strong></p>
                    <p>Construcción  de la primera tabla: En la primera columna de la tabla aparecerá lo que  llamaremos base, en la segunda el coeficiente que tiene en la función objetivo  cada variable que aparece en la base (llamaremos a esta columna Cb), en la  tercera el término independiente de cada restricción (P0), y a  
partir  de ésta columna aparecerán cada una de las variables de la función objetivo  (Pi). Para tener una visión más clara de la tabla, incluiremos una fila en la  que pondremos cada uno de los nombres de las columnas. Sobre ésta tabla que  tenemos incluiremos dos nuevas filas: una que será la que liderará la
tabla  donde aparecerán las constantes de los coeficientes de la función objetivo, y  otra que será la última fila, donde tomará valor la función objetivo. Nuestra  tabla final tendrá tantas filas como restricciones.</p>
                  <img src="css/images/MTImagen2.JPG" alt=""  />
                  
                    <p>Los  valores de la fila Z se obtienen de la siguiente forma: El valor Z0 será el de  sustituir Cim en la función objetivo (y cero si no aparece en la base). El  resto de columnas se obtiene restando a este valorel del coeficiente que  aparece en la primera fila de la tabla.</p>
                    <p>Se  observará al realizar el método Simplex, que en esta primera tabla, en la base  estarán las variables deholgura.</p>
                    <p>Condición  de parada: Comprobaremos si debemos de dar una nueva iteración o no, que lo  sabremos si en la fila Z aparece algún valor negativo. Si no aparece ninguno,  es que hemos llegado a la solución óptima del problema.</p>
                    <p>Elección  de la variable que entra: Si no se ha dado la  condición de parada, debemos seleccionar una variable para que entre en la base  en la siguiente tabla. Para ello nos fijamos en los valores estrictamente  negativos de la fila Z, y el menor de ellos será el que nos de la variable  entrante.</p>
                    <p>Elección  de la variable que sale: Una vez obtenida la variable entrante, obtendremos la  variable que sale, sin más que seleccionar aquella fila cuyo cociente P0/Pj sea  el menor de los estrictamente positivos (teniendo en cuenta que sólo se hará  cuando Pj sea mayor de 0). La intersección entre la columna entrante y la fila  saliente nos determinará el elemento pivote.</p>
                    <p>Actualización  de la tabla: Las filas correspondientes a la función objetivo y a los títulos  permanecerán inalterados en la nueva tabla. El resto deberá calcularse de dos  formas diferentes:</p>
                    <p>• Si  es la fila pivote cada nuevo elemento se calculará:<br />
                      Nuevo  Elemento Fila Pivote = Elemento Fila Pivote actual / Pivote.</p>
                    <p>• Para  el resto de elementos de filas se calculará:<br />
                      Nuevo  Elemento Fila = Elemento Fila Pivote actual ( Elemento Columna Pivote en la  fila actual * Nuevo Elemento Fila).</p>
                  <h3>Metodo Grafico </h3>
                    <p>Interpretación  gráfica del Método Simplex</p>
                    <p>La  resolución de problemas lineales con sólo dos o tres variables de decisión se  puede ilustrar gráficamente, mostrándose como una ayuda visual para comprender  muchos de los conceptos y términos que se utilizan y formalizan con métodos de  solución más sofisticados, como por ejemplo el Método Simplex, necesarios para  la resolución de problemas con varias variables. Para ello se puede usar el  método Gráfico.</p>
                    <p>Aunque  en la realidad rara vez surgen problemas con sólo dos o tres variables de  decisión, es sin embargo muy útil esta metodología de solución e  interpretación, en la que se verán las situaciones típicas que se pueden dar,  como son la existencia de una solución óptima única, de soluciones óptimas  alternativas, la no existencia de solución y la no acotación. Describimos aquí  las fases del procedimiento de solución del Método Gráfico:</p>
                    <p>1.  Dibujar un sistema de coordenadas cartesianas en el que cada variable de  decisión esté representada por un eje, con la escala de medida adecuada a su  variable asociada.</p>
                    <p>2.  Dibujar en el sistema de coordenadas las restricciones del problema (incluyendo  las de no negatividad). Para ello, observamos que si una restricción es una  inecuación, define una región que será el semiplano limitado por la línea recta  que se tiene al considerar la restricción como una igualdad. Si la restricción  fuera una ecuación, la región que define se dibuja como una línea recta. La  intersección de todas las<br />
                      regiones  determina la región factible o espacio de soluciones (que es un conjunto  convexo). Si esta región es no vacía, ir a la fase siguiente. En otro caso, no  existe solución que satisfaga (simultáneamente) todas las restricciones y el  problema no tiene solución, denominándose no factible.</p>
                    <p>3.  Determinar los puntos extremos (puntos que no están situados en segmentos de  línea que unen otros dos puntos del conjunto convexo) de la región factible  (que, como probaremos en la siguiente sección, son los candidatos a solución  óptima). Evaluar la función objetivo en estos puntos y aquél o aquellos que  maximicen (o minimicen) el objetivo, corresponden a las soluciones óptimas del  problema. </p>
                    <p>El equipo Inocorp pretende dearrollar un software que  permita resolver problemas mediante el método simplex, para ello utilizara el  lenguaje de programación orientado a la web PHP, veamos ahora a que se refiere  y un poco de historia de PHP.</p>
                  </div>
                  <h3>PHP</h3>
                  <div class="text">
                    <p>PHP es un lenguaje de  programación interpretado usado normalmente para la creación de páginas web dinámicas. PHP es un acrónimo recursivo que significa &quot;PHP Hypertext Pre-processor&quot; (inicialmente PHP Tools, o, Personal Home Page  Tools). Actualmente también se puede utilizar para la creación de otros tipos  de programas incluyendo aplicaciones con interfaz  gráfica usando las bibliotecas Qt o GTK+.</p>
                  PHP fue originalmente diseñado en Perl,  seguidos por la escritura de un grupo de CGI binarios escritos en el lenguaje C por el programador danés-canadiense Rasmus Lerdorf en el año 1994 para mostrar su currículum vitae y guardar ciertos datos, como la cantidad de tráfico que su página web recibía.  El 8 de junio de 1995 fue publicado &quot;Personal Home Page Tools&quot; después de que Lerdorf lo combinara con su propio  Form Interpreter para crear PHP/FI.
                  <h3><strong>Los principales usos del PHP son los siguientes:</strong></h3>
                  
                    <p>Programación de páginas web dinámicas, habitualmente en combinación con el motor de base datos MySQL, aunque cuenta con  soporte nativo para otros motores, incluyendo el estándar ODBC, lo que amplía en  gran medida sus posibilidades de conexión. <br />
Programación en consola, al estilo de Perl o Shell scripting. <br />
Creación de aplicaciones gráficas independientes del  navegador, por medio de la combinación de PHP y Qt/GTK+, lo que  permite desarrollar aplicaciones de escritorio en los sistemas  operativos en los que está soportado</p>
                  
                  <h3><strong>Ventajas de PHP</strong></h3>
                    <ul>
                      <li>Es un lenguaje  multiplataforma. </li>
                      <li>Capacidad de  conexión con la mayoría de los manejadores de base de datos que se utilizan en  la actualidad, destaca su conectividad con MySQL </li>
                      <li>Capacidad de  expandir su potencial utilizando la enorme cantidad de módulos (llamados ext's  o extensiones). </li>
                      <li>Posee una  amplia documentación en su página oficial, entre la cual se destaca que todas  las funciones del sistema están explicadas y ejemplificadas en un único archivo  de ayuda. </li>
                      <li>Es libre,  por lo que se presenta como una alternativa de fácil acceso para todos. </li>
                      <li>Permite las  técnicas de Programación Orientada a Objetos. </li>
                      <li>Biblioteca  nativa de funciones sumamente amplia e incluida </li>
                      <li>No requiere  definición de tipos de variables. </li>
                      <li>Tiene manejo de excepciones. </li>
                    </ul>
                    <p><strong>Desventajas de PHP</strong></p>
					<ul>
                      <li>No posee una  abstracción de base de datos estándar, sino bibliotecas especializadas para  cada motor (a veces más de una para el mismo motor). </li>
                      <li>No posee  adecuado manejo de internacionalización, unicode, etc. </li>
                      <li>Por su  diseño dinámico no puede ser compilado y es muy difícil de optimizar. </li>
                      <li>Por sus  características promueve la creación de código desordenado y complejo de  mantener. </li>
                      <li>Está diseñado  especialmente para un modo de hacer aplicaciones web que es ampliamente  considerado problemático y obsoleto (mezclar el código con la creación de la  página web). </li>
                    </ul>
                    <p>Las dos últimas desventajas  aquí mencionadas no tienen por qué sufrirse si el programador es disciplinado y  se preocupa de elaborar un diseño previo de lo que quiere hacer antes de  ponerse a teclear código. Si bien el  PHP no obliga a quien lo usa a seguir una determinada metodología a la hora de  programar (muchos otros lenguajes tampoco lo hacen), el programador puede  aplicar en su trabajo cualquier técnica de programación y/o desarrollo que le  permita escribir código ordenado, estructurado y manejable. Un ejemplo de esto  son los desarrollos que en PHP se han hecho del patrón de diseño Modelo Vista Controlador (o MVC),  que permiten separar el tratamiento y acceso a los datos, la lógica de control y la interfaz de usuario en tres componentes  independientes.</p>
                  </div>
				  <h1>Metodo</h1>
                  <div class="text">
                    <h3>ALGORITMO DEL METODO SIMPLEX</h3>
					<p>El siguiente algoritmo hecho en java nos proporciona un panorama del ambiente y desarrollo del método simplex para ejercicios propuestos por dicho método, sustenta la base para la resolución de problemas.</p>
<p>No podemos de hablar de variables, restricciones o función objetivo de este algoritmo, ya que se enfoca a resolver problemas derivados de la programación lineal en simplex.</p>
<p>El algoritmo del método simplex quedaría de la siguiente forma:</p>
<p><img src="css/images/MET1.JPG" alt="Algoritmo" /></p>
<p>Una vez que hemos estandarizado nuestro modelo, puede ocurrir que necesitemos aplicar el método Simplex. </p>
<p>Explicaremos paso a paso los puntos de cada método, concretando los aspectos que hay que tener en cuenta.</p>
<h3>Método Simplex</h3>
<p>- Construcción de la primera tabla: En la primera columna de la tabla aparecerá lo que llamaremos base, en la segunda el coeficiente que tiene en la función objetivo cada variable que aparece en la base (llamaremos a esta columna Cb), en la tercera el término independiente de cada restricción (P0), y a partir de ésta columna aparecerán cada una de las variables de la función objetivo (Pi). Para tener una visión más clara de la tabla, incluiremos una fila en la que pondremos cada uno de los nombres de las columnas. Sobre ésta tabla que tenemos incluiremos dos nuevas filas: una que será la que liderará la tabla donde aparecerán las constantes de los coeficientes de la función objetivo, y otra que será la última fila, donde tomará valor la función objetivo. Nuestra tabla final tendrá tantas filas como restricciones.</p>
<table border="1" cellspacing="0" cellpadding="0" width="400">
  <tr>
    <td colspan="7"><p><strong>Tabla</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>&nbsp;</strong></p></td>
    <td><p><strong>&nbsp;</strong></p></td>
    <td><p><strong>&nbsp;</strong></p></td>
    <td><p><strong>C1</strong></p></td>
    <td><p><strong>C2</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>Cn</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Base</strong></p></td>
    <td><p><strong>Cb</strong></p></td>
    <td><p><strong>P0</strong></p></td>
    <td><p><strong>P1</strong></p></td>
    <td><p><strong>P2</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>Pn</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Pi1</strong></p></td>
    <td><p><strong>Ci1</strong></p></td>
    <td><p><strong>bi1</strong></p></td>
    <td><p><strong>a11</strong></p></td>
    <td><p><strong>a12</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>a1n</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Pi2</strong></p></td>
    <td><p><strong>Ci2</strong></p></td>
    <td><p><strong>bi2</strong></p></td>
    <td><p><strong>a21</strong></p></td>
    <td><p><strong>a22</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>a2n</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Pim</strong></p></td>
    <td><p><strong>Cim</strong></p></td>
    <td><p><strong>bim</strong></p></td>
    <td><p><strong>am1</strong></p></td>
    <td><p><strong>am2</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>amn</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Z</strong></p></td>
    <td><p><strong>&nbsp;</strong></p></td>
    <td><p><strong>Z0</strong></p></td>
    <td><p><strong>Z1-C1</strong></p></td>
    <td><p><strong>Z2-C2</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>Zn-Cn</strong></p></td>
  </tr>
</table>
<p>Los valores de la fila Z se obtienen de la siguiente forma: El valor Z0 será el de sustituir Cim en la función objetivo (y cero si no aparece en la base). El resto de columnas se obtiene restando a este valor el del coeficiente que aparece en la primera fila de la tabla.</p>
<p>Se observará al realizar el método Simplex, que en esta primera tabla, en la base estarán las variables de holgura.</p>
<p>- Condición de parada: Comprobaremos si debemos de dar una nueva iteración o no, que lo sabremos si en la fila Z aparece algún valor negativo. Si no aparece ninguno, es que hemos llegado a la solución óptima del problema.</p>
<p>- Elección de la variable que entra: Si no se ha dado la condición de parada, debemos seleccionar una variable para que entre en la base en la siguiente tabla. Para ello nos fijamos en los valores estrictamente negativos de la fila Z, y el menor de ellos será el que nos de la variable entrante.</p>
<p>- Elección de la variable que sale: Una vez obtenida la variable entrante, obtendremos la variable que sale, sin más que seleccionar aquella fila cuyo cociente P0/Pj sea el menor de los estrictamente positivos (teniendo en cuenta que sólo se hará cuando Pj sea mayor de 0). La intersección entre la columna entrante y la fila saliente nos determinará el elemento pivote.</p>
<p>- Actualización de la tabla: Las filas correspondientes a la función objetivo y a los títulos permanecerán inalterados en la nueva tabla. El resto deberá calcularse de dos formas diferentes:</p><ul>
<li>Si es la fila pivote cada nuevo elemento se calculará:

Nuevo Elemento Fila Pivote = Elemento Fila Pivote actual / Pivote.</li>
<li>Para el resto de elementos de filas se calculará:

Nuevo Elemento Fila = Elemento Fila Pivote actual - (Elemento Columna Pivote en la fila actual * Nuevo Elemento Fila).</li>
</ul><h3>Método de las Dos Fases</h3>
<p>Éste método difiere del Simplex en que primero hay que resolver un problema auxiliar que trata de minimizar la suma de las variables artificiales. Una vez resuelto este primer problema y reorganizar la tabla final, pasamos a la segunda fase, que consiste en realizar el método Simplex normal.</p>
<h4><b>FASE 1</b></h4>
<p>En esta primera fase, se realiza todo de igual manera que en el método Simplex normal, excepto la construcción de la primera tabla, la condición de parada y la preparación de la tabla que pasará a la fase 2.</p>
<p>- Construcción de la primera tabla: Se hace de la misma forma que la tabla inicial del método Simplex, pero con algunas diferencias. La fila de la función objetivo cambia para la primera fase, ya que cambia la función objetivo, por lo tanto aparecerán todos los términos a cero excepto aquellos que sean variables artificiales, que tendrán valor "-1" debido a que se está minimizando la suma de dichas variables (recuerde que minimizar F es igual que maximizar F•(-1)).</p>
<p>La otra diferencia para la primera tabla radica en la forma de calcular la fila Z. Ahora tendremos que hacer el cálculo de la siguiente forma: Se sumarán los productos Cb•Pj para todas las filas y al resultado se le restará el valor que aparezca (según la columna que se éste haciendo) en la fila de la función objetivo.</p>
<table border="1" cellspacing="0" cellpadding="0" width="400">
  <tr>
    <td colspan="9"><p><strong>Tabla</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>&nbsp;</strong></p></td>
    <td><p><strong>&nbsp;</strong></p></td>
    <td><p><strong>C0</strong></p></td>
    <td><p><strong>C1</strong></p></td>
    <td><p><strong>C2</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>Cn-k</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>Cn</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Base</strong></p></td>
    <td><p><strong>Cb</strong></p></td>
    <td><p><strong>P0</strong></p></td>
    <td><p><strong>P1</strong></p></td>
    <td><p><strong>P2</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>Pn-k</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>Pn</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Pi1</strong></p></td>
    <td><p><strong>Ci1</strong></p></td>
    <td><p><strong>bi1</strong></p></td>
    <td><p><strong>a11</strong></p></td>
    <td><p><strong>a12</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>a1n-k</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>a1n</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Pi2</strong></p></td>
    <td><p><strong>Ci2</strong></p></td>
    <td><p><strong>bi2</strong></p></td>
    <td><p><strong>a21</strong></p></td>
    <td><p><strong>a22</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>a2n-k</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>a2n</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>...</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Pim</strong></p></td>
    <td><p><strong>Cim</strong></p></td>
    <td><p><strong>bim</strong></p></td>
    <td><p><strong>am1</strong></p></td>
    <td><p><strong>am2</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>amn-k</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>amn</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Z</strong></p></td>
    <td><p><strong>&nbsp;</strong></p></td>
    <td><p><strong>Z0</strong></p></td>
    <td><p><strong>Z1</strong></p></td>
    <td><p><strong>Z2</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>Z2</strong></p></td>
    <td><p><strong>...</strong></p></td>
    <td><p><strong>Zn</strong></p></td>
  </tr>
</table>
<p>Siendo Zj = Σ(Cb•Pj) - Cj y los Cj = 0 para todo j comprendido entre 0 y n-k (variables de decisión, holgura y exceso), y Cj = -1 para todo j comprendido entre n-k y n (variables artificiales).</p>
 
<p>- Condición de parada: La condición de parada es la misma que en el método Simplex normal. La diferencia estriba en que pueden ocurrir dos casos cuando se produce la parada: la función toma un valor 0, que significa que el problema original tiene solución, o que tome un valor distinto, indicando que nuestro modelo no tiene solución.</p>
<p>- Eliminar Columna de variables artificiales: Si hemos llegado a la conclusión de que el problema original tiene solución, debemos preparar nuestra tabla para la segunda fase. Deberemos eliminar las columnas de las variables artificiales, modificar la fila de la función objetivo por la original, y calcular la fila Z de la misma forma que en la primera tabla de la fase 1.</p>

IDENTIFICANDO CASOS ANÓMALOS Y SOLUCIONES
<p>Obtención de la solución: Cuando se ha dado la condición de parada, obtenemos el valor de las variables básicas que están en la base y el valor óptimo que toma la función que están en la base mirando la columna P0. En el caso de que estemos minimizando, se multiplicará por "-1" el valor óptimo.</p>
<p>Infinitas soluciones: Cumplida la condición de parada, si se observa que alguna variable que no está en la base, tiene un 0 en la fila Z, quiere decir que existe otra solución que da el mismo valor óptimo para la función objetivo. Si estamos ante este caso, estamos ante un problema que admite infinitas soluciones, todas ellas comprendidas dentro del segmento (o porción del plano, o región del espacio, dependiendo del número de variables del problema) que define Ax+By=Z0. Si se desea se puede hacer otra iteración haciendo entrar en la base a la variable que tiene el 0 en la fila Z, y se obtendrá otra solución.</p>
<p>Solución ilimitada: Si al intentar buscar la variable que debe abandonar la base, nos encontramos que toda la columna de la variable entrante tiene todos sus elementos negativos o nulos, estamos ante un problema que tiene solución ilimitada. No hay valor óptimo concreto, ya que al aumentar el valor de las variables se aumenta el valor de la función objetivo, y no viola ninguna restricción.</p>
<p>No existe solución: En el caso de que no exista solución, seguro que tendremos que realizar las dos fases, por lo que al término de la primera sabremos si estamos en tal situación.</p>
<p>Empate de variable entrante: Se puede optar por cualquiera de ellas, sin que afecte a la solución final, el inconveniente que presenta es que según por cual se opte se harán más o menos iteraciones. Se aconseja que se opte a favor de las variables básicas, ya que son aquellas las que quedarán en la base cuando se alcance la solución con estos métodos.</p>
<p>Empate de variable saliente: Se puede nuevamente optar por cualquiera de ellas, aunque se puede dar el caso degenerado y entrar en ciclos perpetuos. Para evitarlos en la medida de lo posible, discriminaremos a favor de las variables básicas haciendo que se queden en la base. Ante el caso de estar en la primera fase (del método de las Dos Fases), se optará por sacar en caso de empate las variables artificiales.</p>
<p>Curiosidad Fase 1: Al finalizar la fase 1, si el problema original tiene solución, todas las variables artificiales, en la fila Z deben tener el valor "1".</p>
<p>¿Pivote puede ser 0?: No, ya que siempre se realizan los cocientes entre valores no negativos y mayores que cero.</p>
</div>
<div align="justify"></div>
<p>&nbsp;</p>

                </div>
				  <h3>&nbsp;</h3>
			  </div>
              <ul id="submenu">
                <li><span id="submenuselected">Español</span></li>
                <li><a href="">English</a></li>
              </ul>
              <div class="designinfo"> valid XHTML | valid CSS | Inocorp </div>
            </div>
          </div>
        </div>
        </body>
        
    </html>
    

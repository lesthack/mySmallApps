<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Busquedas :: Inteligencia Artificial</title>
		<meta content="es_MX" http-equiv="Content-Language" />
		<link media="all" href="css/style.css" type="text/css" rel="stylesheet" />
		<script src="javascript/functions.js" type="text/javascript"></script>
		<script src="javascript/reinas.js" type="text/javascript"></script>
		<script src="javascript/puzzle.js" type="text/javascript"></script>
		<script src="javascript/mootools.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="root">
			<div id="header">
				<div id="menu">
					<ul>
						<li class="active" id="mreinas" onclick="showTab(this)">
							<a href="#">8 Reinas</a>
						</li>
						<li id="mcaballos" onclick="showTab(this)" class="hide">
							<a href="#">Salto de caballo</a>
						</li>
						<li  id="mpuzzle" onclick="showTab(this)">
							<a href="#">Puzzle</a>
						</li>
						<li id="mlaberinto" onclick="showTab(this)" class="hide">
							<a href="#">Laberinto</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="bodier">
				<div id="reinas" class="tab">
					<h1>las 8 reinas</h1>
					<p>
						El problema consiste en poner dentro de un tablero de ajedrez (8x8) a 8 reinas
						siempre y cuando ninguna se ponga en jacke. La tecnica empleada para resolver
						este problema es una busqueda <b>BFS</b> con <b>Backtrack</b>.
					</p>
					<form>
						<label for="x">X:</label>
						<input type="input" id="x" name="x" size="10" maxlength="1" value="0">
						<label for="y">Y:</label>
						<input type="input" id="y" name="y" size="10" maxlength="1" value="4">
						<label for="time">time:</label>
						<input type="input" id="mytime" name="mytime" size="10" maxlength="2" value="10">
						<input type="button" value="Iniciar" onclick="readXMLReinas();">
					</form>
					<h2>:: Resultados</h2>
					<div class="operation">
						<table id="chess">
							<tr>
								<td class="nothing"></td>
								<td class="nothing">0</td>
								<td class="nothing">1</td>
								<td class="nothing">2</td>
								<td class="nothing">3</td>
								<td class="nothing">4</td>
								<td class="nothing">5</td>
								<td class="nothing">6</td>
								<td class="nothing">7</td>
							</tr>
						<?php
							for($i=0; $i<8; $i++){
								print "<tr>";
								print "	<td class=\"nothing\">$i</td>";
								for($j=0; $j<8; $j++){
									print "<td id=\"r$i$j\"></td>";
								}
								print "</tr>";
							}
						?>
						</table>
					</div>
					<div class="result">
						<h3>Estado: <span id="r_edo">Pasivo</span></h3>
						<h3>Nodos Generados: <span id="r_nodos">0</span></h3>
						<h3>Código: <span><a href="reinas.py">reinas.py</a></span id="r_tiempo"></h3>
					</div>
				</div>
				<div id="caballos" class="tab hide">
					<h1>caballos</h1>
				</div>
				<div id="puzzle" class="tab hide">
					<h1>el puzzle de 8</h1>
					<p>
						Consiste en resolver de manera automatica el puzzle pasando de un estado inicial a uno final. 
						El problema puede resolverse como una busqueda <b>ciega</b>, sin embargo, el numero de nodos generados
						en la busqueda puede ser exponencial y muy tardada. Por ello se ha optado por utilizar una busqueda
						heuristica como los <b>grafos O</b>.
					</p>
					<form>
						<table>
							<tr>
								<td>
									<div class="edo_puzzle">
										<h4>Estado Inicial</h4>
										<div>
											<input id="pi00" class="puzzle zero" type="input" readonly="readonly" maxlength="1" size="2" value="0" onclick="changePos(this,0);"/>
											<input id="pi01" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="1" onclick="changePos(this,0);"/>
											<input id="pi02" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="2" onclick="changePos(this,0);"/>
										</div>
										<div>
											<input id="pi10" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="3" onclick="changePos(this,0);"/>
											<input id="pi11" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="4" onclick="changePos(this,0);"/>
											<input id="pi12" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="5" onclick="changePos(this,0);"/>
										</div>
										<div>
											<input id="pi20" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="6" onclick="changePos(this,0);"/>
											<input id="pi21" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="7" onclick="changePos(this,0);"/>
											<input id="pi22" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="8" onclick="changePos(this,0);"/>
										</div>
									</div>
								</td>
								<td>
									<div class="edo_puzzle">
										<h4>Estado Final</h4>
										<div>
											<input id="pf00" class="puzzle zero" type="input" readonly="readonly" maxlength="1" size="2" value="0" onclick="changePos(this,1);"/>
											<input id="pf01" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="1" onclick="changePos(this,1);"/>
											<input id="pf02" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="2" onclick="changePos(this,1);"/>
										</div>
										<div>
											<input id="pf10" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="3" onclick="changePos(this,1);"/>
											<input id="pf11" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="4" onclick="changePos(this,1);"/>
											<input id="pf12" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="5" onclick="changePos(this,1);"/>
										</div>
										<div>
											<input id="pf20" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="6" onclick="changePos(this,1);"/>
											<input id="pf21" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="7" onclick="changePos(this,1);"/>
											<input id="pf22" class="puzzle" type="input" readonly="readonly" maxlength="1" size="2" value="8" onclick="changePos(this,1);"/>
										</div>
									</div>								
								</td>
							</tr>
							<tr>
								<td class="center" colspan="2">
									<input type="button" value="Resolver" onclick="readXMLPuzzle();"/>
								</td>
							<tr>
						</table>
						
					</form>
					<h2>:: Resultados</h2>
					<div class="operation">
						<table id="puzzle">
							<?php
							$n = 0;
							for($i=0; $i<3; $i++){
								print "<tr>";
								for($j=0; $j<3; $j++){
									print "<td id='p$i$j' ".($n==0?"class='zero'":"").">$n</td>";
									$n++;
								}
								print "</tr>";
							}
							?>
						</table>
					</div>
					<div class="result">
						<h3>Estado: <span id="p_edo">Pasivo</span></h3>
						<h3>Profundidad: <span id="p_nodos">0</span></h3>
						<h3>Codigo: <span><a href="puzzle.py">puzzle.py</a></span id="p_tiempo"></h3>
					</div>
				</div>
				<div id="laberinto" class="tab hide">
					<h1>Laberinto</h1>
				</div>
			</div>
			<div id="footer">
				<h4>Copyleft :: General Public Licence :: lesthack</h4>
			</div>
		</div>
	</body>
</html> 
 



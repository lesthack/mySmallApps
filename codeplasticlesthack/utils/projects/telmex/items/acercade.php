<style>
#kwicks_container { 
	height: 100px;
}
#kwicks {
	position: relative;
}
 
#kwicks .kwick {
	float: left;
	display: block;
	width: 130px;
	height: 300px;
}
 
#kwick_tab {
	background-color: #eee;
	border:1px solid #999;
	margin-right:5px;
	-moz-border-radius:3px;
}
#kwick_tab{
	text-align:center;
}
#kwick_tab h1{
	font-size:18px;
}
#kwick_tab h2{	
	color:#8FB300;
}
#kwick_tab p{
	color:#344006;
}
#kwick_tab .hide{
	display:none;
}

</style>
<div id="about">
	<h3>Equipo de Desarrollo</h3>
	<div id="kwicks_container">
		<ul id="kwicks">
			<li id="kwick_tab" class="kwick">
				<h1>diseño y programacion</h1>
				<h2 class="hide">Jorge Luis Hernandez Cantador</h2>
				<p class="hide">
					Diseño, programacion, estructuracion, implantacion
					y pruebas
				</p>
			</li>
			<li id="kwick_tab" class="kwick">
				<h1>diseño y programacion</h1>
				<h2 class="hide">Jose Antonio Ortiz Corona</h2>
				<p class="hide">
					Diseño, programacion, estructuracion, implantacion
					y pruebas
				</p>
			</li>
			<li id="kwick_tab" class="kwick">
				<h1>diseño y programacion</h1>
				<h2 class="hide">Luis Guitierres Tovar</h2>
				<p class="hide">
					Diseño, programacion, estructuracion, implantacion
					y pruebas
				</p>
			</li>
			<li id="kwick_tab" class="kwick">
				<h1>programacion y elaboracion de BD</h1>
				<h2 class="hide">Jose Cruz Olivares Tapia</h2>
				<p class="hide">
					Diseño, programacion, estructuracion, implantacion
					y pruebas
				</p>
			</li>
		</ul>
		<span class="clr"><!-- spanner --></span>
	</div>
</div>
<script language="javascript" type="text/javascript">
var szNormal = 130, szSmall  = 120, szFull   = 320;
 
var kwicks = $$("#kwicks .kwick");
var fx = new Fx.Elements(kwicks, {wait: false, duration: 300, transition: Fx.Transitions.Back.easeOut});
kwicks.each(function(kwick, i) {
	kwick.addEvent("mouseenter", function(event) {
		var o = {};
		o[i] = {width: [kwick.getStyle("width").toInt(), szFull]}
		kwicks.each(function(other, j) {
			if(i != j) {
				var w = other.getStyle("width").toInt();
				if(w != szSmall) o[j] = {width: [w, szSmall]};
			}
		});
		fx.start(o);
		this.getElementsByTagName("h2")[0].removeClass('hide');
		this.getElementsByTagName("p")[0].removeClass('hide');
	});
});
 
$("kwicks").addEvent("mouseleave", function(event) {
	var o = {};
	kwicks.each(function(kwick, i) {
		o[i] = {width: [kwick.getStyle("width").toInt(), szNormal]}
		kwick.getElementsByTagName("h2")[0].addClass('hide');
		kwick.getElementsByTagName("p")[0].addClass('hide');
	});
	fx.start(o);
	
})
</script>

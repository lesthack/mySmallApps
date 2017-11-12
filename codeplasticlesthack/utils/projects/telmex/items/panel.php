<div id="header">
	<div id="menu">
		<ul class="menu">
			<li id="contratos" class="active">
				<a href="#" id="m_contratos" class="si">Contratos</a>
				<ul id="sm_contratos" class="subMenu">
					<li><a href="#" class="si" id="bt_cc">Registros Contratos</a></li>
					<li><a href="#" class="no" id="bt_ac">Nuevo contrato</a></li>
				</ul>
			</li>
			<li id="planes">
				<a href="#" class="no" id="m_planes">Planes</a>
				<ul id="sm_planes" class="hide subMenu">
					<li><a href="#" class="no" id="bt_cp">Registros de Planes</a></li>
					<li><a href="#" class="no" id="bt_ap">Nuevo Plan</a></li>
				</ul>
			</li>
			<li id="ladas">
				<a href="#" class="no" id="m_ladas">Ladas</a>
				<ul id="sm_ladas" class="hide subMenu">
					<li><a href="#" class="no" id="bt_cl">Registros Ladas</a></li>
					<li><a href="#" class="no" id="bt_al">Nueva Ladas</a></li>
				</ul>
			</li>
			<li id="reportes">
				<a href="#" class="no" id="m_reportes">Reportes</a>
				<ul id="sm_reportes" class="hide subMenu">
					<li><a href="#" class="no" id="bt_cr">Reportes Llamadas</a></li>
					<li><a href="#" class="no" id="bt_rgu">Reporte Gastos Usuarios</a></li>
					<li><a href="#" class="no" id="bt_rgce" >Reporte Comparativa Estados</a></li>
				</ul>
			</li>
            <li id="llamadas">
            	<a href="#" class="no" id="m_llamadas">Llamadas</a>
            	<ul id="sm_llamadas" class="hide subMenu">
            	</ul>
            </li>
			<li id="admin">
				<a href="#" id="m_admin" class="no">Admin</a>
				<ul id="sm_admin" class="hide subMenu">
					<li><a href="#" class="no" id="bt_ca">Listar Usuarios</a></li>
					<li><a href="#" class="no" id="bt_aa">Nuevo usuario</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div id="bwin">
		<ul class="menu">
			<li><a href="#" class="no" id="bt_about">About</a></li>
			<li><a href="#" class="no" id="exit">salir</a></li>					
		</ul>
	</div>
</div>
<div id="bodier">
	<div id="content">
	
	</div>
	<div id="messages">
	</div>
</div>
<div id="footer">
	<span>Todos los derechos reservados Telmex 2008</span>
</div>
<script language="javascript" type="text/javascript">
	
		
		var active = "contratos";
		var bactive = "bt_cc";					
		
		function dfunction(id){
			$$(".active .si")[0].addClass("no");
			$$(".active .subMenu")[0].addClass("hide");
			$$(".active")[0].removeClass("active");
		};
		
		function btdefault(obj){
			if(obj.id==bactive)
				return false;
			obj.removeClass("no");
			obj.addClass("si");
			$(bactive).addClass("no");
			bactive=obj.id;
		};
		
		$('m_admin').addEvent('click', function(){
				dfunction(this);
				this.removeClass("no");
				this.addClass("si");
				$("admin").addClass("active");
				$("sm_admin").removeClass("hide");
			}
		);
		
		$('m_contratos').addEvent('click', function(){
				dfunction(this);
				this.removeClass("no");
				this.addClass("si");
				$("contratos").addClass("active");
				$("sm_contratos").removeClass("hide");
			}
		);
		
		$('m_reportes').addEvent('click', function(){
				dfunction(this);
				this.removeClass("no");
				this.addClass("si");
				$("reportes").addClass("active");
				$("sm_reportes").removeClass("hide");
			}
		);
		
		$('m_planes').addEvent('click', function(){
				dfunction(this);
				this.removeClass("no");
				this.addClass("si");
				$("planes").addClass("active");
				$("sm_planes").removeClass("hide");
			}
		);
		
		$('m_ladas').addEvent('click', function(){
				dfunction(this);
				this.removeClass("no");
				this.addClass("si");
				$("ladas").addClass("active");
				$("sm_ladas").removeClass("hide");
			}
		);
		
		$("m_llamadas").addEvent('click', function(){
				dfunction(this);
				this.removeClass("no");
				this.addClass("si");
				$("llamadas").addClass("active");
				$("sm_llamadas").removeClass("hide");
				
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=6",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Listo para subir archivo de llamadas");
					}
				}).request();
				
			}
		);	
		
		//Contratos
		$("bt_cc").addEvent('click', function(){
				btdefault(this);
				
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=1",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Todos los Contratos Consultados");
					}
				}).request();
			}
		);
		
		$("bt_ac").addEvent('click', function(){
				btdefault(this);
				
				var temp = new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=1&option=1",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Listo para insertar un nuevo Contrato");
					}
				}).request();
			}
		);
		
		//administrador
		$("bt_aa").addEvent('click', function(){
				btdefault(this);
				
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=5&option=1",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Listo para agregar nuevos usuarios");
					}
				}).request();
			}
		);

		$("bt_ca").addEvent('click', function(){
				btdefault(this);
				
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=5",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Registros de usuarios");
					}
				}).request();
			}
		);
		
		//reportes
		$("bt_cr").addEvent('click', function(){
				btdefault(this);
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=4&option=1",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Reporte para llamadas");
					}
				}).request();
			}
		);
		
		$('bt_rgu').addEvent('click', function(){
				btdefault(this);
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=4&option=2",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Reporte para Gastos de Usuario");
					}
				}).request();
			}
		);
		
		$('bt_rgce').addEvent('click', function(){
				btdefault(this);
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=4&option=3",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Reporte Comparativa de Estados");
					}
				}).request();
			}
		);
		
		
		//planes
		$("bt_cp").addEvent('click', function(){
				btdefault(this);
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=2",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Todos los Planes Consultados");
					}
				}).request();
			}
		);
		
		$("bt_ap").addEvent('click', function(){
				btdefault(this);
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=2&option=1",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Listo para agregar un nuevo plan");
					}
				}).request();
			}
		);
		
		//ladas
		$("bt_cl").addEvent('click', function(){
				btdefault(this);
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=3",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Todas las Ladas Consultadas");
					}
				}).request();
			}
		);

		$("bt_al").addEvent('click', function(){
				btdefault(this);
				new _Ajax({
					method: 'post',
					url: "items/validate.php",
					data: "page=3&option=1",
					update: $('content'),
					evalScripts: true,
					onComplete: function(){
						site.putMessage("Listo para agregar una nueva Lada");
					}
				}).request();
			}
		);	
		//otros
		$('bt_about').addEvent('click', function(){

			new _Ajax({
					method: 'post',
					url: "items/acercade.php",
					update: $('content'),
					evalScripts: true
				}).request();
		});
		
		$('exit').addEvent('click', function(){
			if(confirm("¿Esta seguro?"))
				site.logout();
		});
		
</script>


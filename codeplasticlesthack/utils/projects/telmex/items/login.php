<div class="shadow"></div>
<div id="login">
	<form id="dlogin" name="dlogin" method="post">
		<table>
			<tr>
				<td>
					<label for="user">
						Usuario:
					</label>
				</td>
				<td>
					<input type="text" name="user" id="user" value="966" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="password">
						Password:
					</label>
				</td>
				<td>
					<input type="password" name="pass" id="pass" value="root" />
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>		
					<input type="submit" value="entrar" />
				</td>	
			</tr>
	</form>
</div>
<script language="javascript" type="text/javascript">
	$('dlogin').addEvent('submit', function(e){
		new Event(e).stop();
		
		if($("user").value.length==0){
			alert("Ingrese un nombre de usuario por favor. Gracias");
			$("user").focus();
			return;
		}
		if($("pass").value.length==0){
			alert("Ingrese un password por favor. Gracias");
			$("pass").focus();
			return;
		}
		
		site.login({username: $("user").value, password: $("pass").value});
	});
	$('user').focus();
</script>

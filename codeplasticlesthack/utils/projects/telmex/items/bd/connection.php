<?

	class connection_telmex{
		var $bd_host;
		var $bd_usuario; 
		var $bd_password; 
		var $bd_base; 
		var $link;
		
		function connection_telmex(){
			$this->bd_host = "mysql.lesthack.com.mx";
			$this->bd_base = "telmex"; 
			$this->bd_usuario = "lesthack"; 
			$this->bd_password = "x80=angie"; 
			//$this->open();
		}
		
		function query($query){
			$this->open();
			$result = mysql_query($query);

			if(!$result) 
				require('errors.php');

			$this->close();
			return $result;
			
		}
		
		function open(){
			$this->link = mysql_connect($this->bd_host, $this->bd_usuario, $this->bd_password) or die ("no se logro la conexion");
			mysql_select_db($this->bd_base, $this->link); 
		}
		
		function close(){
			mysql_close($this->link);
		}
	}
?>

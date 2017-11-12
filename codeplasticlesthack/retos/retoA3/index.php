<?php
	$dimg = "images";
		
	$maya = array(1=>'uno.png',2=>'dos.png',3=>'tres.png',4=>'cuatro.png',5=>'cinco',0=>'zero.png');
	
	function dec2base($numero, $base){
		global $maya;
		$final=array();
		do{
			$residuo = $numero % $base;
			$numero = (int)($numero/$base);
			array_unshift($final,$residuo);
		}while($numero>0);

		return $final;
	}
	
	function path($numer){
		global $dimg;
		return $dimg.'/'.$numer;
	}
	
	function generateHTML($numer){
		global $maya;
		
		echo "\r\t<div id='$numer' class='numer'>";
		
		if($numer==0){
			echo "\r\t\t<img src='".path($maya[0])."'>";
		}
		else{
			$n = (int)($numer/5);
			if($numer-$n*5>0)
				echo "\r\t\t<img src='".path($maya[$numer-(5*$n)])."'>";
			for($i=0;$i<$n;$i++)
				echo "\r\t\t<img src='".path($maya[5])."'>";
		}
		echo "\r\t</div>";
	}
	
	function generateCompleteHTML($numers){
		$n = count($numers);
		echo "\r<div class='complete' style='width:".(67*$n)."px;'>";
		for($i=0;$i<$n;$i++)
			generateHTML($numers[$i]);
		echo "\r</div>";
	}
	
	function problem(){
		//generateCompleteHTML(dec2base(112,20));
		$text = "El tiempo del no tiempo alcanza su dicha voluntad, los astros actuan con pleno desconcierto, y la era del quinto sol muere. 13.0.0.0.0 4 ahau 3 kankin";
		for($i=0;$i<strlen($text);$i++){
			generateCompleteHTML(dec2base(ord($text[$i]),20));
		}
	}
	
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Reto A3 :: Codice Maya</title>	<meta http-equiv="text/html; charset=UTF-8" content="text/html;	charset=iso-8859-1">
	<style>
	body{
		width:900px;
		margin-left:auto;
		margin-right:auto;
	}
	.numer{
		width:51px;
		height:45px;
		border:1px solid #999;
		float:left;
		margin:5px;
		-moz-border-radius:5px;
		padding:2px;
		vertical-align:bottom;
	}
	.complete{
		border:1px solid red;
		height:61px;
		-moz-border-radius:5px;
		float:left;
		margin:5px;
	}
	img{
		display:block;
	}
	</style>	
</head>
	
<body>
	<?php
		problem();
	?>
</body>
</html>


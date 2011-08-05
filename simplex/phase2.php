<?php
	$nvar=$_REQUEST["nvar"]; 
	$nres=$_REQUEST["nres"];
	$obj=$_REQUEST["objetivo"];



	//comprobamos si es simplex
	for($i=1;$i<=$nres;$i++)
		if($_REQUEST["dir$i"]==2)
			require_once("phase2b.php");

	//iniciamos los resultados de las X's
	for($i=1;$i<=$nvar;$i++){
		$XT["$i"]=0;
	}
	
	if($obj==0)
		$pivote=$_REQUEST["z"][1];//un valor demaciado positivo
	else
		$pivote=-10E10;//un valor demaciado negativo

	$xpivote=1;
	for($i=1;$i<=$nvar;$i++){
		if($obj==0){
			if($_REQUEST["z"][$i]>0 && $_REQUEST["z"][$i]>$pivote){
				$pivote=$_REQUEST["z"][$i];
				$xpivote=$i;
			}
		}
		else{
			if($_REQUEST["z"][$i]<0 && $_REQUEST["z"][$i]<$pivote){
				$pivote=$_REQUEST["z"][$i];
				$xpivote=$i;
			}
		}
	}
	
	$ypivote=1;
	$temp=$_REQUEST["rhs"][1]/($_REQUEST["x"][1][$xpivote]==0?1:$_REQUEST["x"][1][$xpivote]);

	for($i=1;$i<=$nres;$i++){
		$_ratio=$_REQUEST["rhs"][$i]/($_REQUEST["x"][$i][$xpivote]==0?1:$_REQUEST["x"][$i][$xpivote]);
		if($_ratio>0 && $_ratio<$temp){
			$temp=$_ratio;
			$ypivote=$i;
		}
	}
	
	//para los valores de las X's
	$XT[$xpivote]=$ypivote;
?>
<h1>Fase 2</h1>
<div class="text">
	<h2>Iteración 0</h2>
	<form id="iteraciones" name="iteraciones" method="post" action="simplex.php">
		<input type="hidden" name="phase" value="3">
		<input type="hidden" name="nvar" value="<?php echo $nvar; ?>">
		<input type="hidden" name="nres" value="<?php echo $nres; ?>">
		<input type="hidden" name="objetivo" value="<?php echo $obj; ?>">
		<input type="hidden" name="iteracion" value="1">
		<input type="hidden" name="xpivote" value="<?php echo $xpivote; ?>">
<?php
	for($i=1;$i<=$nvar;$i++){
		echo "
			<input type='hidden' name='XT[$i]' value='$XT[$i]'>
		";
	}
?>
		<table>
			<thead>
				<tr>
					<th></th>
					<th></th>
<?php
			for($i=1;$i<=$nvar;$i++){
				echo "
					<th>X<sub>$i</sub></th>
				"; 
			}
?>
<?php
			for($i=1;$i<=$nres;$i++){
				echo "
					<th>C<sub>$i</sub></th>
				"; 
			}
?>					
					<th></th>
					<th></th>
				</tr>
				<tr>
					<th>Basis</th>
					<th>C(j)</th>
<?php
			for($i=1;$i<=($nvar+$nres);$i++){
				$temp = $_REQUEST["z"][$i];
				echo "
					<th>
						-
					</th>
				"; 
			}
?>
					<th>RHS</th>
					<th>Ratio</th>
				</tr>
			</thead>
			<tbody>
<?php
		for($r=1;$r<=$nres;$r++){
			echo "
				<tr>
					<td><b>C<sub>$r</sub></b></td>
					<td><b>0</b></td>";
			for($i=1;$i<=$nvar;$i++){
				$temp = $_REQUEST["x"][$r][$i];
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[$r][$i]' id='x[$r][$i]' value='$temp' readonly/>
					</td>
				";
			}
			for($i=$nvar+1;$i<=($nres+$nvar);$i++){
				echo "
					<td>";
					if($r==$i-$nvar){
						$dir=$_REQUEST["dir".$r];
						if($dir==0)
							$temp=1;
						else if($dir==2)
							$temp=-1;
						else
							$temp=0;
						echo "
						<input type='text' size='2' maxlength='10' name='x[$r][$i]' id='x[$r][$i]' value='$temp' readonly/>
						";
					}
					else
						echo "
						<input type='text' size='2' maxlength='10' name='x[$r][$i]' id='x[$r][$i]' value='0' readonly/>
						";
				echo "
					</td>
				";
			}
			$rhs = $_REQUEST["rhs"][$r];
			//$_ratio=$rhs/($_REQUEST["x"][$r][$xpivote]==0?1:$_REQUEST["x"][$r][$xpivote]);
			$_ratio=($_REQUEST["x"][$r][$xpivote]==0)?"M":$rhs/$_REQUEST["x"][$r][$xpivote];
			echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[$r][".($nvar+$nres+1)."]' id='x[$r][".($nvar+$nres+1)."]' value='$rhs' readonly/>
					</td>
					<td>
						<input type='text' size='2' maxlength='10' name='ratio[$r]' id='ratio[$r]' value='$_ratio' readonly/>
					</td>
				</tr>
			";
		}
?>
				<tr>
					<td></td>
					<td><b>C(j)-Z(i)</b></td>
<?php
			for($i=1;$i<=$nvar;$i++){
				$temp = $_REQUEST["z"][$i];
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+1)."][$i]' id='x[".($nres+1)."][$i]' value='$temp' readonly/>
					</td>
				";
			}
			for($i=$nvar+1;$i<=($nres+$nvar+1);$i++){
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+1)."][$i]' id='x[".($nres+1)."][$i]' value='0' readonly/>
					</td>
				";
			}
?>					
					<td></td>
				</tr>				
			</tbody>
		</table>
		<div class="part">
			<input type="button" value="Anterior" onclick="history.go(-1);"/>
			<input type="submit" value="Siguiente" />
		</div>
	</form>
</div>

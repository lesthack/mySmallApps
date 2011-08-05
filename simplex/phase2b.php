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
		$R[$i]=0; //esta tambien me la echo
	}
	//sacando xpivote
	$xpivote=1;
	$tempo=0;

	for($k=1;$k<=$nres;$k++){
		if($_REQUEST["dir1"]==2)
			$tempo+=$_REQUEST["x"][$k][1];
	}
	
	for($i=1;$i<=$nvar;$i++){
		$temp=0;
		for($k=1;$k<=$nres;$k++)
			if($_REQUEST["dir$i"]==2)
				$temp+=$_REQUEST["x"][$k][$i];
	
		if($obj!=0)
			$temp=-$temp;
		$R[$i]=$temp;
		if($obj==0){
			if($temp>$tempo){
				$tempo=$temp;
				$xpivote=$i;
			}
		}
		else{
			if($temp<$tempo){
				$tempo=$temp;
				$xpivote=$i;
			}
		}
	}
	
	//sacando ypivote
	$ypivote=1;
	$temp=$_REQUEST["rhs"][1]/($_REQUEST["x"][1][$xpivote]==0?1:$_REQUEST["x"][1][$xpivote]);

	for($i=1;$i<=$nres;$i++){
		$_ratio=$_REQUEST["rhs"][$i]/($_REQUEST["x"][$i][$xpivote]==0?1:$_REQUEST["x"][$i][$xpivote]);
		if($_ratio>0 && $_ratio<$temp){
			$temp=$_ratio;
			$ypivote=$i;
		}
	}
	
?>
<h1>Fase 2 :: Metodo de las Dos Fases</h1>
<div class="text">
	<h2>Iteración 0</h2>
	<form id="iteraciones" name="iteraciones" method="post" action="simplex.php">
		<input type="hidden" name="phase" value="4">
		<input type="hidden" name="nvar" value="<?php echo $nvar; ?>">
		<input type="hidden" name="nres" value="<?php echo $nres; ?>">
		<input type="hidden" name="objetivo" value="<?php echo $obj; ?>">
		<input type="hidden" name="iteracion" value="1">
		<input type="hidden" name="xpivote" value="<?php echo $xpivote; ?>">
<?php
	//para los valores de las X's
	$XT[$xpivote]=$ypivote;

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
			for($i=1;$i<=$nres;$i++){
				echo "
					<th>C<sub>$i</sub></th>
				"; 
			}
			for($i=1;$i<=$nres;$i++){
				echo "
					<th>
						R<sub>$i</sub>
					</th>
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
			for($i=1;$i<=($nvar+2*$nres);$i++){
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
			
			//Variables Artificiales
			for($i=1;$i<=$nres;$i++){
				$temp=0;
				if($r==$i && $_REQUEST["dir$i"]==2)
					$temp=1;
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[$r][".($nres+$nvar+$i)."]' id='x[$r][".($nres+$nvar+$i)."]' value='$temp' readonly/>
					</td>
				";
			}
			
			$rhs = $_REQUEST["rhs"][$r];
			//$_ratio=$rhs/($_REQUEST["x"][$r][$xpivote]==0?1:$_REQUEST["x"][$r][$xpivote]);
			$_ratio=($_REQUEST["x"][$r][$xpivote]==0)?"M":$rhs/$_REQUEST["x"][$r][$xpivote];
			echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[$r][".($nvar+(2*$nres)+1)."]' id='x[$r][".($nvar+(2*$nres)+1)."]' value='$rhs' readonly/>
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
			//variables
			for($i=1;$i<=$nvar;$i++){
				$temp = $_REQUEST["z"][$i];
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+1)."][$i]' id='x[".($nres+1)."][$i]' value='$temp' readonly/>
					</td>
				";
			}
			//restricciones
			for($i=1;$i<=$nres;$i++){
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+1)."][".($nvar+$i)."]' id='x[".($nres+1)."][".($nvar+$i)."]' value='0' readonly/>
					</td>
				";
			}
			//variables artificiales
			for($i=1;$i<=$nres;$i++){
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+1)."][".($nvar+$nres+$i)."]' id='x[".($nres+1)."][".($nvar+$nres+$i)."]' value='0' readonly/>
					</td>
				";
			}
			
			//rhs 
			echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+1)."][".($nvar+2*$nres+1)."]' id='x[".($nres+1)."][".($nvar+2*$nres+1)."]' value='0' readonly/>
					</td>
				";
?>		
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td><b>* Big M</b></td>
<?php
			for($i=1;$i<=$nvar;$i++){
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+2)."][$i]' id='x[".($nres+2)."][$i]' value='$R[$i]' readonly/>
					</td>
				";
			}
			//restricciones para big M
			for($i=1;$i<=$nres;$i++){
				if($_REQUEST["dir$i"]==2)
					if($obj!=0)
						$temp=1;
					else
						$temp=-1;	
				else	
					$temp=0;
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+2)."][".($nvar+$i)."]' id='x[".($nres+2)."][".($nvar+$i)."]' value='$temp' readonly/>
					</td>
				";
			}
			//variables artificiales para Big M
			for($i=1;$i<=$nres;$i++){
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+2)."][".($nvar+$nres+$i)."]' id='x[".($nres+2)."][".($nvar+$nres+$i)."]' value='0' readonly/>
					</td>
				";
			}
			
			$temp = 2*$nres+$nvar+1;
			echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+2)."][$temp]' id='x[".($nres+2)."][$temp]' value='0' readonly/>
					</td>
			";
?>					
					
				</tr>
			</tbody>
		</table>
		<div class="part">
			<input type="button" value="Anterior" onclick="history.go(-1);"/>
			<input type="submit" value="Siguiente" />
		</div>
	</form>
</div>

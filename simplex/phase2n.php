<?php
	$nvar=$_REQUEST["nvar"]; 
	$nres=$_REQUEST["nres"];
	$obj=$_REQUEST["objetivo"];
	$phase=$_REQUEST["phase"];
	$iteracion=$_REQUEST["iteracion"];
	$xpivote=$_REQUEST["xpivote"];
	$matrix = $_REQUEST["x"];
	$XT = $_REQUEST["XT"];
	
	//el pivote
	$ypivote=1;
	$temp=$_REQUEST["ratio"][1];
	for($i=1;$i<=$nres;$i++){
		if($_REQUEST["ratio"][$i]>0 && $_REQUEST["ratio"][$i]<$temp){
			$temp=$_REQUEST["ratio"][$i];
			$ypivote=$i;
		}
	}

	//Obteniendo pivote
		$divisor=$matrix[$ypivote][$xpivote];

		//para la matrix X
		for($i=1;$i<=($nvar+$nres+1);$i++){
			$matrix[$ypivote][$i]=$matrix[$ypivote][$i]/$divisor;
		}	
	//==
	
	//sacando nueva matrix
	for($k=1;$k<=$nres+2;$k++){
		for($i=1;$i<=($nvar+2*$nres+1);$i++){
			if($k!=$ypivote){
				$val=$matrix[$k][$i]-$matrix[$ypivote][$i]*$matrix[$k][$xpivote];
				$nmatrix[$k][$i]=$val;
			}
			else
				$nmatrix[$k][$i]=$matrix[$k][$i];
		}
	}
	//sacando Zeta
	//echo $nmatrix[$ypivote][$nvar+$nres+1]*$matrix[$nres+1][$xpivote];
	//$nmatrix[$nres+1][$nvar+$nres+1]=-$nmatrix[$nres+1][$nvar+$nres+1];
	
	//sacando de nuevo el xpivote
	
		if($obj==0)
			$pivote=$nmatrix[$nres+2][1]; //un numero demaciado positivo
		else
			$pivote=$nmatrix[$nres+2][1]; //un valor demaciado negativo

		$xpivote=1;
		$xvan=0;
		for($k=1;$k<=($nvar+2*$nres);$k++){
			if($obj==0){
				if($nmatrix[$nres+2][$k]>0 && $nmatrix[$nres+2][$k]>$pivote)
					$xpivote=$k;
				else
					$xvan++;
			}
			else{
				if($nmatrix[$nres+2][$k]<0 && $nmatrix[$nres+2][$k]<$pivote)
					$xpivote=$k;
				else
					$xvan++;
			}	
		}
	//para los valores de las X's
	$XT[$xpivote]=$ypivote;
?>
<h1>Fase <?php echo ($phase-1); ?> :: Metodo de las Dos Fases</h1>
<div class="text">
	<h2>Iteración <?php echo $iteracion; ?></h2>
	<form id="iteraciones" name="iteraciones" method="post" action="simplex.php">
		<input type="hidden" name="phase" value="4">
		<input type="hidden" name="nvar" value="<?php echo $nvar; ?>">
		<input type="hidden" name="nres" value="<?php echo $nres; ?>">
		<input type="hidden" name="objetivo" value="<?php echo $obj; ?>">
		<input type="hidden" name="iteracion" value="<?php echo $iteracion+1; ?>">
		<input type="hidden" name="xpivote" value="<?php echo $xpivote; ?>">
		<table>
			<thead>
				<tr>
					<th></th>
					<th></th>
<?php
			//variables
			for($i=1;$i<=$nvar;$i++){
				echo "
					<th>X<sub>$i</sub></th>
				"; 
			}
			//restricciones
			for($i=1;$i<=$nres;$i++){
				echo "
					<th>C<sub>$i</sub></th>
				"; 
			}
			//artificiales
			for($i=1;$i<=$nres;$i++){
				echo "
					<th>R<sub>$i</sub></th>
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
				$temp = $nmatrix[$nres+1][$i];
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
			for($i=1;$i<=($nvar+2*$nres+1);$i++){
				$temp = $nmatrix[$r][$i];
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[$r][$i]' id='x[$r][$i]' value='$temp' readonly/>
					</td>
				";
			}
			$_rhs=$nmatrix[$r][$nres+$nvar+1];
			
			$_ratio=($nmatrix[$r][$ypivote])==0?"M":($_rhs/$nmatrix[$r][$ypivote]);
			//$_ratio=($_rhs/$nmatrix[$r][$ypivote]):0;
			echo "
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
			for($i=1;$i<=($nvar+2*$nres);$i++){
				$temp = $nmatrix[$nres+1][$i];
				echo "
					<td>
						<input type='text' size='2' maxlength='10' name='x[".($nres+1)."][$i]' id='x[".($nres+1)."][$i]' value='$temp' readonly/>
					</td>
				";
			}
			//imprimiendo la Z
			echo "
					<td>
						<input type='hidden' size='2' maxlength='10' name='x[".($nres+1)."][".($nvar+$nres+1)."]' id='x[".($nres+1)."][".($nvar+$nres+1)."]' value='".$nmatrix[$nres+1][$nvar+$nres+1]."' readonly/>
						<input type='text' size='2' maxlength='10'  value='".(-$nmatrix[$nres+1][$nvar+$nres+1])."' readonly/>
					</td>
				";
?>
					
					<td></td>
				</tr>	
				<tr>
					<td></td>
					<td><b>* Big M</b></td>
<?php
			//imprimiendo la Big M
		for($i=1;$i<=($nvar+2*$nres+1);$i++){
			$temp=$nmatrix[$nres+2][$i];
			echo "
					<td>
						<input type='text' size='2' maxlength='10'  name='x[".($nres+2)."][$i]' id='x[".($nres+2)."][$i]' value='$temp' readonly/>
					</td>
				";
		}
?>				
				</tr>			
			</tbody>
		</table>
		<div class="part">
			<input type="button" value="Anterior" onclick="history.go(-1);"/>
<?php
	if($xvan!=$nvar)
		echo "
			<input type='submit' value='Siguiente' />
		";
?>
		</div>
	</form>
<?php
	if($xvan>=$nvar){
		echo "<p>Punto Óptimo Alcanzado. Resultados:</p>";
		for($i=1;$i<=$nvar;$i++){
			$xn=round($nmatrix[$XT[$i]][$nvar+$nres+1]==""?"0":$nmatrix[$XT[$i]][$nvar+$nres+1],2);
			echo "<p>X<sub>$i</sub>=$xn</p>";
		}
		$Zf=round(-$nmatrix[$nres+1][$nvar+$nres+1],2);
		echo "<p>Z = $Zf</p>";
	}
?>	
</div>

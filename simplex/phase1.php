<?php
	$nvar=$_REQUEST["nvar"]; 
	$nres=$_REQUEST["nres"];
	$obj=$_REQUEST["objetivo"];
?>
<h1>Fase 1</h1>
<div class="text">
	<p>
		Introduce los datos requeridos.
	</p>
	<p>
		<form id="fsimplex" name="fsimplex" method="post" action="simplex.php">
			<input type="hidden" name="phase" value="2">
			<input type="hidden" name="nvar" value="<?php echo $nvar; ?>">
			<input type="hidden" name="nres" value="<?php echo $nres; ?>">
			<input type="hidden" name="objetivo" value="<?php echo $obj; ?>">
	 		<div id="fo" name="fo" class="part">
		 		<label for="fo">
					F.O. <?php echo $obj==0?"Max":"Min"; ?> Z =
				</label>
		 		<?php
		 			for($i=1;$i<=$nvar;$i++){ 
		 				echo "
			 				<input type='text' id='z[$i]' name='z[$i]' value='0' size='2' maxlength='4'>
			 				<label for='z[$i]'>
			 					X<sub>$i</sub>
			 				</label>
	 					";
	 				} 
	 			?>
	 		</div>
	 		<div id="restrictions" name="restrictions" class="part">
	 			<label for="restrictions">
	 				Sujeto a:
	 			</label>
<?php
	 				for($i=1;$i<=$nres;$i++){
	 					echo "
	 					<div id='Cs'>
	 						<label for='R$i'>
	 							Restricción $i: 
	 						</label>
	 						<span id='R$i'>";
	 						for($k=1;$k<=$nvar;$k++){
	 							echo "
	 								<input type='text' id='x[$i][$k]' name='x[$i][$k]' value='0' size='2' maxlength='4'>
					 				<label for='x[$i][$k]'>
					 					X<sub>$i$k</sub>
					 				</label>
	 							";
	 						}
	 					echo "
	 								<select id='dir$i' name='dir$i'>
	 									<option value='0'>&lt;=</option>
										<option value='1'>=</option>
										<option value='2'>&gt;=</option>
	 								</select>
	 								<input type='text' id='rhs[$i]' name='rhs[$i]' value='0' size='2' maxlength='4'>
	 						</span>
	 					</div>
						";
	 				}
?>
	 		</div>
	 		<div class="part">
	 			<input type="submit" value="Siguiente" class="submit"/>
	 		</div>
	 	</form>
	 </p>
</div>
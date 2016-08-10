<?php

		$query = "SELECT * FROM Pridelek P,Ponudba Po,Kmet K where Po.Kmet_idKmet=K.idKmet and K.username='".$_SESSION['username']."' and P.idPridelek=Po.Pridelek_idPridelek";
		
		$result=$con->query($query) or die(mysqli_error($con));
	
		
	

		if ($result->num_rows > 0){

		?>
		<html>
		<head>
						<meta charset="UTF-8">
		</head>
		<body>


		<table name="Ponudba" class="Ponudba">
		 <tr>
		 <td class="first-child">Ime Ponudbe</td>
		<td>Datum Ponudbe</td>
		<td>Opis</td>
		<td>Cena</td>
		<td>Status</td>
		<td class="last-child"></td>
		</tr>
		<?php while($row = mysqli_fetch_array($result)){ ?>
		 <tr>
		<td name="Naziv_Pridelek"><?php echo $row['Naziv_Pridelek']; ?></td>
		<td name="Datum_Ponudba"><?php echo $row['Datum_Ponudba']; ?></td>
		<td name="Opis"><?php echo $row['Opis']; ?></td>
		<td name="Cena_Izdelka"><?php echo $row['Cena_Izdelka']; ?></td>
		<td name="Status"><?php echo $row['Status']; ?></td>
		<td>
			<form method="get" id="ajaxQuerry">
				<input id="<?php echo $row['idPonudba']; ?>" type="submit"  class="button" name="set" value="Uredi">
				<input value="<?php echo $row['idPonudba']; ?>" name="fun" type="hidden" >
			</form>

			<form method="get" id="ajaxQuerry" >
				<input id="<?php echo $row['idPonudba']; ?>" meta http-equiv="refresh" type="submit" class="button" name="delete" value="Zbrisi">
				<input value="<?php echo $row['idPonudba']; ?>" name="fun1" type="hidden">
				
			</form>

		</td>
		 </tr>
		<?php 
		} ?>
		</table>


	<?php }else{ echo "Ni podatkov za prikaz";}?>





	</body>
</html>
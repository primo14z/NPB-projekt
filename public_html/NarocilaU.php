<?php


		$query = "SELECT * FROM Narocilo N,Pridelek Pr, Uporabnik U,Ponudba P, Kmet K  where Pr.idPridelek=P.Pridelek_idPridelek and N.Uporabnik_idUporabnik=U.idUporabnik and U.username='".$_SESSION['username']."' and N.Kmet_idKmet =K.idKmet and P.Kmet_idKmet= K.idKmet";
		$result=$con->query($query) or die(mysqli_error($con));
	
		if ($result->num_rows > 0){
			
			?>
			<html>
		<head>
		<meta charset="UTF-8">
		</head>
		<body>


		<table id="Prikaz" name="Prikaz" class="Ponudba">
		<tr>
		  	<td class="first-child">Naziv Pridelka</td>
		 	<td>Ime Kmeta</td>
			<td>Naslov Kmeta</td>
			<td>Datum Naročila</td>
			<td class="last-child">Količina</td>
		</tr>
		<?php while($row = mysqli_fetch_array($result)){ ?>
		<tr>
		 	<td name="Pridelek"><?php echo $row['Naziv_Pridelek']; ?></td>
		 	<td name="Ime Kmeta"><?php echo $row['Ime']; ?></td>
		 	<td name="Naslov"><?php echo $row['Naslov']; ?></td>		
			<td name="Datum_Narocila"><?php echo $row['datum']; ?></td>
			<td name="Kolicina"><?php echo $row['Kolicina']; ?></td>
	
		</tr>
		<?php 
		} ?>
		</table>


	<?php }else{ echo "Ni podatkov za prikaz";}?>


	</body>
</html>

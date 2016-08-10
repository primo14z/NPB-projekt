<?php


		$query = "SELECT Pr.Naziv_Pridelek,U.Ime,U.Naslov,N.datum,N.Kolicina FROM Kmet K,Narocilo N,Pridelek Pr,Dostava D, Uporabnik U,Ponudba P  where K.idKmet=N.Kmet_idKmet and Pr.idPridelek=P.Pridelek_idPridelek and P.Kmet_idKmet=K.idKmet and N.Uporabnik_idUporabnik=U.idUporabnik and D.idDostava=N.Dostava_idDostava and K.username='".$_SESSION['username']."' ";
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
		 	<td>Ime Uporabnika</td>
			<td>Naslov Uporabnika</td>
			<td>Datum Naročila</td>
			<td class="last-child">Količina</td>
		</tr>
		<?php while($row = mysqli_fetch_array($result)){ ?>
		<tr>
		 	<td name="Pridelek"><?php echo $row['Naziv_Pridelek']; ?></td>
		 	<td name="Ime Uporabnika"><?php echo $row['Ime']; ?></td>
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

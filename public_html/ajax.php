<?php

$con=db_conn();


	if(isset($_GET["fun"])){
			$id = $_GET["fun"];
			$que = "SELECT * FROM Ponudba P, Pridelek PR WHERE P.idPonudba=".$id." and PR.idPridelek = P.Pridelek_idPridelek";
			$resu=$con->query($que) or die(mysqli_error($con));
			
			$row = mysqli_fetch_array($resu);

		echo '<form action="kmet.php" method = "POST" id="ure">
								<br>
								<input type="text" name="naziv1" value="'.$row['Naziv_Pridelek'].'" disabled>
								<br>
								<input type="date" name="datum1" value="'.$row['Datum_Ponudba'].'">
								<br>
								<input type="text" name ="opis1" value="'.$row['Opis'].'">
								<br>
								<input type="number" step="0.01" name="cena1" value="'.$row['Cena_Izdelka'].'">
								<br>
								<input type="number" name="status1" value="'.$row['Status'].'">
								<br>
									<button type="submit" name="submit123" value="Submit">Submit</button>

								</form>';
		
if(isset($_POST['submit123'])){
	$que = "SELECT idPonudba FROM Ponudba P, Pridelek PR WHERE PR.idPridelek = P.Pridelek_idPridelek and PR.Naziv_Pridelek='".$_POST['naziv1']."' and P.Datum_Ponudba='".$_POST['datum1']."'";
	$resu=$con->query($que) or die(mysqli_error($con));
	$row = mysqli_fetch_array($resu);
	$que = "UPDATE Ponudba SET Datum_Ponudba='".$_POST['datum1']."',Opis='".$_POST['opis1']."', Cena_Izdelka='".$_POST['cena1']."', Status='".$_POST['status1']."'  WHERE idPonudba='".$id."'";
	$resu=$con->query($que) or die(mysqli_error($con));
	echo $que;
	unset($_GET);
}
	

}





	if(isset($_GET["fun1"])){
			$id = $_GET["fun1"];
			$que = " DELETE FROM Ponudba WHERE idPonudba=".$id;
			$resu=$con->query($que) or die(mysqli_error($con));
			unset($_GET);
	
	}


	
	
			
	if(isset($_GET["fun2"])){
			$id = $_GET["fun2"];
			
			$que1 = "SELECT * FROM Uporabnik WHERE username='".$_SESSION['username']."'";
			$que2 = "SELECT * FROM Ponudba WHERE idPonudba=".$id;
			$resu1=$con->query($que1) or die(mysqli_error($con));
			$resu2=$con->query($que2) or die(mysqli_error($con));
			$row = mysqli_fetch_array($resu1);
			$row2 = mysqli_fetch_array($resu2);
			$_SESSION['idPon']=$row2['idPonudba'];
				$que = "INSERT INTO Subscription(Kmet_idKmet,Uporabnik_idUporabnik) VALUES (".$row2['Kmet_idKmet'].",".$row['idUporabnik'].")";
			$resu=$con->query($que);
			//if(!$resu){echo "Na tega kmeta ste ze naroceni.";}
			unset($_GET);

	}
	

		

?>

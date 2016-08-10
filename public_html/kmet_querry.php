<?php
	require 'conn.php';
	$con=db_conn();
	
	include 'slika.php';
	displayimage();

							

		
	if((isset($_POST['Naziv'])) && (isset($_POST['Kategorija'])) && (isset($_POST['SezonaStart'])) && (isset($_POST['SezonaEnd'])) && (isset($_POST['Kolicina_pridelka']))&& (isset($_POST['opis']))){

		$query1 = "INSERT into Pridelek (Naziv_Pridelek, Opis_Pridelek,Kategorija,SezonaStart, SezonaEnd, Kolicina_Pridelka,Kmet_idKmet) Values ('".$_POST['Naziv']."','".$_POST['opis']."','".$_POST['Kategorija']."','".$_POST['SezonaStart']."','".$_POST['SezonaEnd']."','".$_POST['Kolicina_pridelka']."',(SELECT idKmet FROM Kmet WHERE username  ='".$_SESSION['username']."'))";
		$result=$con->query($query1) or die(mysqli_error($con));

	}
	$query1 = "SELECT Naziv_Pridelek FROM Pridelek WHERE Kmet_idKmet =(SELECT idKmet FROM Kmet WHERE username  ='".$_SESSION['username']."')";
	$result=$con->query($query1) or die(mysqli_error($con));

	if(isset($_POST['Opis']) && isset($_POST['Cena']) && isset($_POST['Status']) && isset($_POST['Datum']) && isset($_POST['pridelek'])){
		$query3 = "SELECT idPridelek FROM Pridelek WHERE Naziv_Pridelek ='".$_POST['pridelek']."'";
		$result1 = $con-> query($query3) or die(mysqli_error($con));
		$row = mysqli_fetch_array($result1);
		$query2 = "INSERT into Ponudba (Datum_Ponudba, Kmet_idKmet, Opis,Cena_Izdelka, Status, Pridelek_idPridelek) VALUES('".$_POST['Datum']."' ,(SELECT idKmet FROM Kmet K  WHERE K.username ='".$_SESSION['username']."'),'".$_POST['Opis']."', '".$_POST['Cena']."','".$_POST['Status']."','".$row['idPridelek']."')";
		$result=$con->query($query2) or die(mysqli_error($con));


	}
?>

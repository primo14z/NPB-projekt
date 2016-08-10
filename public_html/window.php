<?php 

require 'conn.php';
$con=db_conn();
session_start();
if(($_POST)){
$up="SELECT idUporabnik FROM Uporabnik WHERE username='".$_SESSION['username']."'";
$resu1=$con->query($up) or die(mysqli_error($con));
$row1 = mysqli_fetch_array($resu1);

$up2="SELECT * FROM Ponudba WHERE idPonudba='".$_SESSION['idPon']."'";
$resu2=$con->query($up2) or die(mysqli_error($con));
$row2 = mysqli_fetch_array($resu2);

$que = "INSERT INTO Narocilo(Kolicina, Ponudba_idPonudba, Dostava_idDostava, Uporabnik_idUporabnik, Kmet_idKmet, datum) VALUES ( '".$_POST['Kolicina']."','".$_SESSION['idPon']."',1,'".$row1['idUporabnik']."','".$row2['Kmet_idKmet']."','".$_POST['datum']."')";
$resu=$con->query($que) or die(mysqli_error($con));

$up="Update Ponudba SET Status=Status-".$_POST['Kolicina']." WHERE idPonudba='".$_SESSION['idPon']."'";
$resu1=$con->query($up) or die(mysqli_error($con));

echo "<script>window.close();</script>";
}

?>

<html>
		<link rel="stylesheet" type="text/css" href="reg.css">
<head>
<title> Narocilnica</title>

<body>




			<div class="testbox" id="testbox">
				<h1>Narocilnica</h1>

				<form method="POST" >
					<div class="form-group">
						<?php 			
							$que = "SELECT * FROM Ponudba P, Pridelek PR WHERE P.idPonudba=".$_SESSION['idPon']." and PR.idPridelek = P.Pridelek_idPridelek";
							$resu=$con->query($que) or die(mysqli_error($con));
							$row = mysqli_fetch_array($resu);
						?>
						<label>Naziv pridelka</label>
						<input type="text" name="Pridelek" value=<?php echo $row['Naziv_Pridelek'];?> disabled>
					</div>
					<div class="form-group">
						 <label>Kolièina</label>
						<input type="number" name="Kolicina" placeholder="max=<?php echo $row['Status'];?>" min="0" max=<?php echo $row['Status'];?>>
						
					</div>	
					<div class="form-group">
						<label>Datum</label>
						<input type="date" name="datum" value=<?php echo date("Y-m-d");?>>
					</div>
<br>
<br>

					
					<button id="" type="submit" value="Submit" >Submit</button>
					<button type="button" onclick="self.close()">Preklici</button>

				</form>
			<div>






</body>
</html>

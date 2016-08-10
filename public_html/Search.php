<?php
	
	//$con=db_conn();

if((!empty($_POST["username"])) || (!empty($_POST["SezonaStart"])) || (!empty($_POST["Naziv_Pridelek"]))) {
	$query="SELECT * FROM Kmet K, Pridelek P, Ponudba Po where Po.Pridelek_idPridelek=P.idPridelek and K.idKmet=Po.Kmet_idKmet";
	if(!empty($_POST['username'])){
		$query.=" and K.username ='".$_POST['username']."'";
	}
	if(!empty($_POST["Naziv_Pridelek"])){
		$query.=" and P.Naziv_Pridelek = '".$_POST['Naziv_Pridelek']."'";
	}
	if(!empty($_POST["SezonaStart"])){
		$query.=" and P.SezonaStart<='".$_POST["SezonaStart"]."' and P.SezonaEnd>='".$_POST["SezonaStart"]."'";
	}
	$result= $con->query($query) or die(mysqli_error($con));
	

}

?>

<html>
	<head>
		<title>Search</title>
		<meta charset="utf-8">

	</head>
	<body>

		<div class="testbox1" id="testbox1">
			<form action="" method = "POST">
			<br>
			<div class="form-group">
				<input type="text" name="Naziv_Pridelek" placeholder="Pridelek">
			</div><br>
			<div class="form-group">
				<input type="text" name="username" placeholder="Kmet">
			</div><br>
			<div class="form-group">
				<input type="date"  name="SezonaStart" placeholder="Datum" value="<?php echo date('Y-m-d');?>">
			</div><br>
								
			<button id="" type="submit" value="Search">Isci</button>
			

			</form>
		</div>
	<?php if (!$result->num_rows > 0){echo "Ni zadetkov";}else{?>

		<table id="Prikaz" name="Prikaz" class="Ponudba">
		 <tr>
		 <td class="first-child">naziv Pridelka</td>
		<td>Datum ponudbe</td>
		<td>Kmet</td>
		<td>Opis</td>
		<td>Cena</td>
		<td>Status</td>
		<td class="last-child"></td>
		</tr>
		<?php while($row = mysqli_fetch_array($result)){ ?>
		 <tr>
		<td name="Naziv_Pridelek"><?php echo $row['Naziv_Pridelek']; ?></td>
		<td name="Datum_Ponudba"><?php echo $row['Datum_Ponudba']; ?></td>
		<td name="Kmet"><?php echo $row['username']; ?></td>
		<td name="Opis"><?php echo $row['Opis']; ?></td>
		<td name="Cena_Izdelka"><?php echo $row['Cena_Izdelka']; ?></td>
		<td name="Status"><?php echo $row['Status']; ?></td>
		<td>
			<form method="get" id="ajaxQuerry">
				<input id="<?php echo $row['idKmet']; ?>" type="submit"  class="button" name="set" value="Naroci">
				<input value="<?php echo $row['idKmet']; ?>" name="fun2" type="hidden" >
			</form>

		</td>
		</tr>
		<?php } ?>
		</table>
	<?php }unset($_POST)?>
		
		</body>
</html>


<script>

	document.getElementById('gumb').onclick = function() {
	document.getElementById("forma").style.display = "none";
	document.getElementById("prikaz").style.display= "block";
	};




</script>
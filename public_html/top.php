<html>
<body>
	<?php 
	$datum=date("Y-m-d");
	$query="SELECT * FROM Kmet K, Pridelek P, Ponudba Po where Po.Pridelek_idPridelek=P.idPridelek and K.idKmet=Po.Kmet_idKmet and P.SezonaStart<='".$datum."' and P.SezonaEnd>='".$datum."'";
	$res=$con->query($query) or die(mysqli_error($con));
	

	
		if ($res->num_rows > 0){?>
		
		<table id="Prikaz" name="Prikaz" class="Ponudba">
		 <tr>
		 <td class="first-child">naziv Pridelka</td>
		<td>Datum</td>
		<td>Kmet</td>
		<td>Opis</td>
		<td>Cena</td>
		<td>Status</td>
		<td class="last-child"></td>
		</tr>
		<?php while($row = mysqli_fetch_array($res)){ ?>
		 <tr>
		<td name="Naziv_Pridelek"><?php echo $row['Naziv_Pridelek']; ?></td>
		<td name="Datum_Ponudba"><?php echo $row['Datum_Ponudba']; ?></td>
		<td name="Kmet"><?php echo $row['username']; ?></td>
		<td name="Opis"><?php echo $row['Opis']; ?></td>
		<td name="Cena_Izdelka"><?php echo $row['Cena_Izdelka']; ?></td>
		<td name="Status"><?php echo $row['Status']; ?></td>
		<td>
			<form method="get" id="ajaxQuerry" onSubmit="openWin()">
				<input id="<?php echo $row['idPonudba']; ?>" type="submit" class="button" name="set" value="Naroci">
				<input value="<?php echo $row['idPonudba']; ?>" name="fun2" type="hidden" >
			</form>
		</td>
		</tr>
		<?php } ?>
		</table>
	<?php }
		else{ echo "ni sezonskih ponudb";
			
		}


	
	
	?>
<script>
	var myWindow;
	function openWin() {
 	   myWindow = window.open("window.php", "myWindow","toolbar=no, scrollbars=no, resizable=0, top=200, left=500,width=500, height=600");
 	   
	}

</script>


</body>
</html>
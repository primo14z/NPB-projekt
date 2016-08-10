<html>
<body>

<?php

	if($_SESSION['kdo']=="Kmet"){
			$result = mysqli_query($con,"SELECT U.username,U.Slika FROM Uporabnik U,Kmet K,Subscription S WHERE K.idKmet=S.Kmet_idKmet  and K.username='".$_SESSION['username']."' and S.Uporabnik_idUporabnik=U.idUporabnik");
		if ($result->num_rows > 0){


			echo "<table >";

			while($row = mysqli_fetch_array($result))
			{
				echo "<td><table border='1'>";
				echo "<tr>";
				echo "<td>" .'<img height="50" width="50" src="data:image;base64,'.$row{'Slika'}.' ">'  . "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>" . $row['username'] . "</td>";
				echo "</tr>";
				echo "</table></td>";

			}echo "</table>";
		}

	}else{
	
		$result = mysqli_query($con,"SELECT K.username,K.Slika FROM Uporabnik U,Kmet K,Subscription S WHERE K.idKmet=S.Kmet_idKmet  and U.username='".$_SESSION['username']."' and S.Uporabnik_idUporabnik=U.idUporabnik");
		if ($result->num_rows > 0){


			echo "<table >";

			while($row = mysqli_fetch_array($result))
			{
				echo "<td><a onclick=''><table border='1'>";
				echo "<tr>";
				echo "<td>" .  '<img height="50" width="50" src="data:image;base64,'.$row{'Slika'}.' ">'  . "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>" . $row['username'] . "</td>";
				echo "</tr>";
				echo "</table></a></td>";

			}echo "</table>";

		}
	
	}
	



	
?>

</body>
</html>
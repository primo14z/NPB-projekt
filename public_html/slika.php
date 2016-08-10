<?php
	//require 'conn.php';
	
	
	if(isset($_POST['sumit']))
	{
		if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
		{
			echo "Please select an image.";
		}
		else
		{
			$image= addslashes($_FILES['image']['tmp_name']);
			$name= addslashes($_FILES['image']['name']);
 			$image= file_get_contents($image);
			$image= base64_encode($image);
			saveimage($name,$image);
		}
	}
           
	function saveimage($name,$image)
	{	
 		$con=db_conn();
		$qry="update ".$_SESSION['kdo']." set Slika='$image' where username='".$_SESSION['username']."'";
		$result=$con->query($qry) or die(mysqli_error($con));
		if($result)
 		{
			//echo "<br/>Image uploaded.";
		}
		else
		{
 			//echo "<br/>Image not uploaded.";
		}
	}
	//displayimage();
	function displayimage()
	{		
			
		$con=db_conn();
		$qry="select * from ".$_SESSION['kdo']." where username='".$_SESSION['username']."'";
		$result=$con->query($qry) or die(mysqli_error($con));

		$row = $result->fetch_assoc();
		if($row['Slika']){
			echo '<img height="100" width="100" src="data:image;base64,'.$row{'Slika'}.' "> ';
		}else{?>
			<img src="./slike/NoImage.jpg" alt="slika" style="width:100px; height:100px">
			<?php
		}
		$_SESSION['ime']=$row['Ime'];
		$_SESSION['priimek']=$row['Priimek'];
		$_SESSION['naslov']=$row['Naslov'];


		   
	}
	
		
	
?>

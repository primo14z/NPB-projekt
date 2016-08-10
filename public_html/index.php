<?php
	require 'conn.php';


	session_start();
	
	if(isset($_POST['username'])&& isset($_POST['password'])){
		
	
		$mysqli=db_conn();
		$query = "SELECT username , password FROM Kmet WHERE username='".$_POST['username']."'  AND password='".$_POST['password']."'";
		$res=$mysqli->query($query) or die(mysqli_error());
	
		
		if ($res->num_rows > 0){
			$_SESSION['username'] = $_POST['username'];
			
			header('Location: kmet.php');
		}else{
			$query="SELECT username , password FROM Uporabnik WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'  " ;
			$res=$mysqli->query($query) or die(mysqli_error());
			if ($res->num_rows > 0){
				$_SESSION['username'] = $_POST['username'];
				
				header('Location: uporabnik.php');
			}else{
				$message = "Napačen username in password";
echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		db_close($mysqli);	
	}
?>

<html>
	<head>
	<div id="header">
	<link rel="stylesheet" type="text/css" href="Layout.css">
		<title>LogIN</title>
		<meta charset="utf-8">
	</div>
	</head>
	<body>


		<div class="header">
    				<div>Dober<span>Sosed</span></div>		</div>
		<div class="login-form">
		<form action="" method = "POST">
			
			<div class="form-group">
				<label id="label-username" >Username</label>
				<br>
				<input type="text" name="username" placeholder="Username">
			</div>
			<br>
			<div class="form-group">
				<label id="label-password" >Password</label>
				<br>
				<input type="password" name="password" placeholder="Password">
			</div>
			<div>
    				<button type="submit">Prijava</button>
			</div>
		</form>
		<form action="registracija.php">
				<button>Registracija</button>
 			
		</form>
		
			
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="jquery.backstretch.min.js"></script>
<script>
    $.backstretch([
      "s1.jpg",
      "s2.jpg"
      ], {
        fade: 1300,
        duration: 6000
    });
</script>			

</div>				
	</body>
</html>



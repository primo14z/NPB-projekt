<?php

	require_once('conn.php');

	$mysqli=db_conn();
	session_start();

	
		if((isset($_POST['radio'])) && ($_POST['radio']== "kmet") && isset($_POST["submit"])){ 
			if((isset($_POST['username'])) && (isset($_POST['password'])) && (isset($_POST['passwordCheck'])) && (($_POST['passwordCheck']== $_POST['password'])) && (isset($_POST['ime'])) && (isset($_POST['priimek'])) && (isset($_POST['naslov']))	&& (isset($_POST['longGPS'])) && (isset($_POST['latGPS']))){
	
				$queryK = "SELECT username from Kmet WHERE username= '".$_POST['username']."' ";
				$queryU = "SELECT username from Kmet WHERE username= '".$_POST['username']."' ";

				$resK= $mysqli -> query($queryK) or die(mysqli_error()	);
				$resU= $mysqli -> query($queryU) or die(mysqli_error()	);
					
				$rowK = mysqli_fetch_array($resK);

				$rowU = mysqli_fetch_array($resU);
				if($resK->num_rows == 0 && $resU->num_rows == 0){
						
					$query = "INSERT INTO Kmet(Ime,Priimek, Naslov, Long_GPS_K, LAT_GPS_K, username, password) VALUES ('".$_POST['ime']."', '".$_POST['priimek']."','".$_POST['naslov']."',".$_POST['longGPS'].",".$_POST['latGPS'].", '".$_POST['username']."','".$_POST['password']."')";
					$res=$mysqli->query($query) or die(mysqli_error());
							
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['kdo']="Kmet";
					header('Location: kmet.php');
					
				}else{
					echo "Username already in use";
				}
				
			}
		}
		
		if((isset($_POST['radio'] ))&& ($_POST['radio']== "uporabnik")){
			if((isset($_POST['username']))&& (isset($_POST['password'])) && (isset($_POST['passwordCheck'])) && ($_POST['passwordCheck']== $_POST['password']) && (isset($_POST['ime'])) && (isset($_POST['priimek'])) && (isset($_POST['naslov']))){
							
				$queryK = "SELECT username from Kmet WHERE username= '".$_POST['username']."' ";
				$queryU = "SELECT username from Kmet WHERE username= '".$_POST['username']."' ";

				$resK= $mysqli -> query($queryK) or die(mysqli_error()	);
				$resU= $mysqli -> query($queryU) or die(mysqli_error()	);
					
				$rowK = mysqli_fetch_array($resK);
				$rowU = mysqli_fetch_array($resU);

				if($resK->num_rows == 0 && $resU->num_rows == 0){
				
				
					$query1= "INSERT INTO Uporabnik(Ime, Priimek, Naslov, Username, Password) VALUES('".$_POST['ime']."', '".$_POST['priimek']."','".$_POST['naslov']."' ,'".$_POST['username']."','".$_POST['password']."')";
			
					$res1=$mysqli->query($query1) or die(mysqli_error());
					db_close($mysqli);
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['kdo']="Uporabnik";
					
					header('Location: uporabnik.php');
				}else{
					echo "Username already in use";

				}
	
			}
		}		
	
?>


<html>
	<head>
		<link rel="stylesheet" type="text/css" href="reg.css">
		<title>Registracija</title>

		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script>


		function toggle(a)
		{
   			if(a==1){
				document.getElementById("txtLng").style.display="none";
				document.getElementById("txtLat").style.display="none";
    				document.getElementById("googleMap").style.display="none";
				document.getElementById("testbox").style.heigth="500px";

    			}else{
    				document.getElementById("googleMap").style.display="block";
				document.getElementById("txtLat").style.display="block";
				document.getElementById("txtLng").style.display="block";
				document.getElementById("testbox").style.heigth="500px";


			}
		}








			var map;
			var myCenter=new google.maps.LatLng(46.155,15);
			var marker;
			function initialize()
			{
				var mapProp = {
					center:myCenter,
  					zoom:7,
  					mapTypeId:google.maps.MapTypeId.ROADMAP
  				};

  				map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

  				google.maps.event.addListener(map, 'click', function(event) {
    					placeMarker(event.latLng);
  				});
			}


			function placeMarker(location) {
				if (marker) {
					marker.setMap(null); 
					marker = null;
					marker = new google.maps.Marker({position: location,map: map});
				}else{
					marker = new google.maps.Marker({position: location,map: map});
				}
				document.getElementById("txtLat").value=location.lat();
				document.getElementById("txtLng").value=location.lng();
			} 
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>

	</head>
	<body>
		<div class="body"></div>
		<div class="grad"></div>
<div class="testbox" id="testbox">
	<h1>Registracija</h1>
		<form action="" method = "POST">
			<hr>
			<div class="tip_acc">
			<input type="radio" id="radio_uporabnik" onclick="toggle(1)" name="radio" value="uporabnik" >
			<label for="radio_uporabnik" class="radio" chec>Uporabnik</label>
			
			<input type="radio" id="radio_kmet" onclick="toggle(2)" name="radio" value="kmet" checked>
			<label for="radio_kmet" class="radio">Kmet</label>
			</div>
			<hr>
			<div class="form-group">
				<input type="text" name="username" placeholder="Username">
			</div>
			<div class="form-group">
				<input type="password" name="password" placeholder="Password">
			</div>
			<div class="form-group">
				<input type="password" name="passwordCheck" placeholder="Re-enter password">
			</div>
			<div class="form-group">
				<input type="text" name="ime" placeholder="Ime">
			</div>
			<div class="form-group">
				<input type="text" name="priimek" placeholder="Priimek">
			</div>
			<div class="form-group">
				<input type="text" name="naslov" placeholder="Naslov">
			</div>
			<div class="form-group">
				<input type="hidden" id="txtLng" name="longGPS" placeholder="Long GPS - kmet only" readonly="readonly">
			</div>
			<div class="form-group">
				<input type="hidden" id="txtLat" name="latGPS" placeholder="Latitude GPS - kmet only" readonly="readonly">
			</div>

			
			<div class="googleMap" id="googleMap" style="width:400;height:300px;"></div>
			<br>
			<button type="submit">Register</button>
			<br>
			<button onclick="history.go(-1);return true;">Cancel</button>

		</form>
</div>

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

	</body>

</html>
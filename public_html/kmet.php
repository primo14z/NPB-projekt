<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Kmet</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    		<link href="tabs.css" rel="stylesheet" type="text/css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="page.css">

  </script>

<script>
$("document").ready(function(){
  $("#ajaxQuerry").live("submit" , function(){
    // Intercept the form submission
    contentType: "text/plain; charset=UTF-8"
    var formdata = $(this).serialize(); // Serialize all form data
    // Post data to your PHP processing script
    $.get("ajax.php",formdata,function(data){
			$("#ajaxContent").html(data);
		}

    });

    return false; // Prevent the form from actually submitting
});
}
</script>

	</head>
	<body>
		<?php 
			session_start();
			
			if(!isset($_SESSION['username'])){header('Location: index.php');}
			$_SESSION['kdo']="Kmet";
			
			
			// koda za Spremembo podatka
			
			if(isset($_POST["submit"])){
				if( (isset($_POST['password'])) && (isset($_POST['passwordCheck'])) && (($_POST['passwordCheck']== $_POST['password'])) && (isset($_POST['ime'])) && (isset($_POST['priimek'])) && (isset($_POST['naslov']))){
				$query = "update Kmet SET ( password='".$_POST['password']."' , Ime='".$_POST['ime']."' ,Priimek='".$_POST['priimek']."' , Naslov= '".$_POST['naslov']."') where username= '".$_SESSION['username']."' ";
				$res=$mysqli->query($query) or die(mysqli_error($mysqli));
				echo "Podatki so bili uspešno posodobljeni";
				}else{
					Echo "Prosimo ponovno vpišite podatke";
				}
			}

		?>
			<div class="page">
				<div class="vr">
					<div class="slika">
						<?php include 'kmet_querry.php';?>

					</div>
					<div class="podatki">
						Ime: <?php echo $_SESSION['ime']; ?><br/>
						Priimek: <?php echo $_SESSION['priimek']; ?><br/>
						Naslov: <?php echo $_SESSION['naslov']; ?><br/>
					</div>
				</div>
				<div>
						<div style = "float:right;margin-right:20px">
							<?php include 'logout_button.php';?>
						</div>

					
				</div>


				<div class="container">
					<ol id="toc" class="tabs">
						<li><a href="#home"><span class="glyphicon glyphicon-home">Moje ponudbe</span> </a></li>
						<li><a href="#pridelek" ><span>Dodaj pridelek</span> </a></li>
						<li><a href="#ponudba" ><span>Dodaj ponudbo</span> </a></li>
						<li><a href="#subscribers" ><span class="glyphicon glyphicon-heart">Narocniki</span> </a></li>
						<li><a href="#narocila" ><span class="glyphicon glyphicon-naroc">Naročila</span> </a></li>
						<li><a href="#settings" ><span class="glyphicon glyphicon-cog">Nastavitve</span> </a></li>
					
					</ol>

					<div class="content" id="home">

							<h3>Moje ponudbe</h3>

							<div><?php require 'Ponudba.php';?></div>


							<div id="ajaxContent" class="bla">
								<?php
									include_once 'ajax.php';
								?>
							</div>

					</div>
						<div id="subscribers" class="content">
							<h3>Narocniki</h3>
							<?php require 'subscribers.php';?>

						</div>
						<div id="pridelek" class="content">
							<h3>Vnos Pridelka</h3>
							<div class="testbox" id="testbox">
							<form action="" method = "POST">
								<br>							
								<div class="form-group">
								<label>Naziv</label>
								<input type="text" name="Naziv" placeholder="Naziv">
								</div>
								<div class="form-group">
								<label>Kategorija</label>
								<input type="text" name="Kategorija" placeholder="Kategorija">
								</div>
								<div class="form-group">
								<label>Zacetek sezone</label>
								<input type="date" name="SezonaStart" value=<?php echo date("Y-m-d");?>>
								</div>
								<div class="form-group">
								<label>Konec sezone</label>
								<input type="date" name="SezonaEnd" value=<?php echo date("Y-m-d");?>>
								</div>
								<div class="form-group">
								<label>Kolicina</label>
								<input type="text" name="Kolicina_pridelka" placeholder="Kolicina_Pridelka">
								</div>
								<div class="form-group">
								<label>Opis pridelka</label>
								<input type="textarea" name ="opis" placeholder="opis" rows= "4" cols="50">
								</div><br>
								<br>
								
									<button id="" type="submit" value="Submit">Submit</button>
									
							</form>
						</div>

						</div>
						<div id="ponudba" class="content">
							<h3>Vnos Pounudbe</h3>
							  <div class="testbox" id="testbox">
							<?php
								$query1 = "SELECT Naziv_Pridelek FROM Pridelek WHERE Kmet_idKmet =(SELECT idKmet FROM Kmet WHERE username  ='".$_SESSION['username']."')";
								$result=$con->query($query1) or die(mysqli_error($con));
								

							?>
							<form action="" meta http-equiv="refresh" content="5" method = "POST">
								
								<div class="form-group">
								<br>
								<label>Pridelek</label>
									<select name="pridelek" >
										<option value="" selected disabled >Izberi Pridelek</option>
										<?php while($option = mysqli_fetch_array($result)){ ?>
											<option value =<?php echo $option['Naziv_Pridelek']; ?> >
												<?php echo $option['Naziv_Pridelek']; ?>
											</option>

										<?php } ?>
									</select>

								</div>
								<div class="form-group">
								<label>Opis ponudbe</label>
								<input type="text" name="Opis"  placeholder="Opis">
								</div>
								<div class="form-group">
								<label>Cena</label>
								<input type="number" step="0.01" name="Cena"  placeholder="Cena">
								</div>
								<div class="form-group">
								<label>Kolicina</label>
								<input type="number" name="Status"  placeholder="Kolicina">
								</div>
								<div class="form-group">
								<label>Datum</label>
								<input type="date"  name="Datum"  value=<?php echo date("Y-m-d");?>>
								</div>
								
								<br>								<br>
								<button id="exit" type="Submit" meta http-equiv="refresh" content="0; url=kmet.php" value="Submit">Submit</button>
									
							</form>
						</div>
						</div>
						
						<div id="narocila" class="content">
						<h3>Naročila</h3>
						
						<?php
						include 'NarocilaK.php';					
						
						?>
						
					</div>
					
						<div id="settings" class="content">
							<h3>Nastavitve</h3>
								<form method="post" enctype="multipart/form-data">
									<br/>
									<input type="file" name="image"/>
									<br/>
									<input type="submit" name="sumit" value="Upload" />
								</form>
								<br>
						</div>
						
			
					</div>
				</div>
			</div>




<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['home', ['pridelek', 'ponudba'], 'subscribers', 'settings','narocila']);
</script>
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

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Uporabnik</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    		<link href="tabs.css" rel="stylesheet" type="text/css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="page.css">
<script>
$("document").ready(function(){
  $("#ajaxQuerry").submit("submit" , function(){
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
	$_SESSION['kdo']="Uporabnik";
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
						<li><a href="#home"><span>Sezonske Ponudbe</span> </a></li>
						<li><a href="#search"><span>Iskanje</span></a></li>   
						<li><a href="#subscription"><span>Narocnine</span></a></li>
						<li><a href="#settings"><span>Nastavitve</span></a></li>
						<li><a href="#narocila" ><span class="glyphicon glyphicon-naroc">Naročila</span> </a></li>
					</ol>

					
					<div id="home" class="content">
						<h3>Sezonske ponudbe</h3>
						<?php include 'top.php';?>

					</div>
					<div id="search" class="content">
						<h3><span class="glyphicon glyphicon-search"></span>Iskanje</h3>
              				
						<?php include 'Search.php';?>
						<div id="ajaxContent" class="bla">
							<?php
								include_once 'ajax.php';
							?>
						</div>
					</div>		
					<div id="subscription" class="content">
						<h3>Narocnine</h3>
						
						<?php include 'subscribers.php';?>
     
					</div>

					<div id="settings" class="content">
						<h3>Nastavitve</h3>
						<form method="post" enctype="multipart/form-data">
							<br/>
							<input type="file" name="image" />
							<br/>
							<input type="submit" name="sumit" value="Upload" />
						</form>
					</div>
					
					<div id="narocila" class="content">
						<h3>Naročila</h3>
								<?php include 'NarocilaU.php';?>
						</form>
					</div>
				
				</div>
			</div>

		

<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
activatables('page', ['home', 'search', 'subscription', 'settings','narocila']);
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

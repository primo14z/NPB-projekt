<?php
	if(isset($_SESSION['username']) && !empty($_SESSION['username']))
		echo 'Prijavljen kot: '.$_SESSION['username'];
	
	
	echo '<a href="logout.php" style = "margin-left:10px">Logout</a>';
?>
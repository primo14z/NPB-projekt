<?php
$host="localhost";
$username="89121003";
$password="3333";
$db="npb2015_Babic_Primoz";


function db_conn()
{
	// default non persistant connection should close automatically
	// if we want to close beforehand, call mysqli_close();
	$mysqli = new mysqli("localhost", "89121003", "3333", "npb2015_Babic_Primoz");
	$mysqli->set_charset('utf8mb4');
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	return $mysqli;
}
function db_close($mysqli)
{
	mysqli_close($mysqli);
} //db_close
?>
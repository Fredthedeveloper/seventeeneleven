<?php
//connect to the database

$servername="localhost";
$username="root";
$password="";
$dbname="seventeeneleven";



$conn= mysqli_connect($servername,$username,$password,$dbname);

if($conn -> connect_error){
	echo "Not connected to the database";
}else{
	
}





?>
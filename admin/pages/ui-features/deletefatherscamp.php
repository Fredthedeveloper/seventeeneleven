<?php
include "..\..\config.php"; //Using database connection file here

$id=$_GET['id']; //get id through query string

$del=mysqli_query($conn,"DELETE FROM fatherscamptext WHERE id='$id'"); //delete query


if ($del) 
{
	mysqli_close($conn);
	header("location:fatherscamp.php");
	exit;
}
else{

	echo "Error deleting record";
}





?>
<?php
$link = mysqli_connect("localhost", "root", "", "appo"); 

if($link === false){ 
	die("ERROR: Could not connect. " . mysqli_connect_error()); 
} 

$id = $_REQUEST["id"];

$sql = "DELETE FROM appo WHERE id='$id'"; 
if(mysqli_query($link, $sql)){ 

	echo "<script type='text/javascript'>";
	echo "window.location = 'detail.php'; ";
	echo "alert('Update Successfully');";
	echo "</script>";
} 
else{ 
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($link); 
} 
mysqli_close($link); 
?> 

<?php

if(isset($_POST['event_id'],$_POST['date']))
{
	$mysqli= mysqli_connect("localhost","root","","appo");
	$sql =  "UPDATE `appo` SET `date`= '" . $_POST['date'] . "' WHERE `id` = '" . $_POST['event_id'] . "' ";
	$data = mysqli_query($mysqli, $sql) or die ("Error in query: $sql " . mysqli_error());

	
	mysqli_close($mysqli); 

	
}

?>
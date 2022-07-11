<?php
	$connect = mysqli_connect("localhost", "root", "", "appo");
	$query = "UPDATE `appo` SET `starttime` = '" . $_POST['starttime'] . "', `date` = '" . $_POST['date'] . "' WHERE `id` = '" . $_POST['event'] . "'";
	if (mysqli_query($connect, $query)) {
		echo true;
	}
	else {
		echo false;
	}
?>
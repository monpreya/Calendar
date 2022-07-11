<!DOCTYPE html>

<html>
<head>
<title>update</title>
</head>
<body>
<?php
	include_once 'excode/includes/db_connect.php';
include_once 'excode/includes/functions.php';
   ini_set('display_errors', 1);
   error_reporting(~0);


	   $serverName = "localhost";
	   $userName = "root";
	   $userPassword = "";
	   $dbName = "appo";

	   $conn = mysqli_connect("localhost","root","","appo");

	    $id = $_POST['id'];
	    $detail = $_POST['detail'];
	    echo $id.$detail.$_POST['title'];;
	   $sql = "UPDATE `appo` SET tilte= '".$_POST["title"]."', date='".$_POST["date"]."', starttime='".$_POST["time"]."',endtime='".$_POST["endtime"]."', detail='".$_POST["detail"]."', color='".$_POST["color"]."' WHERE id = '". $_POST['id'] ."' ";

		$query = mysqli_query($conn,$sql);


	if($query) {
		 	echo "<script type='text/javascript'>";
		 	echo "window.location = 'detail.php'; ";
			echo "alert('Update Successfully');";
			echo "</script>";
		}

	mysqli_close($conn);
?>
</body>
</html>
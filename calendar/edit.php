<!DOCTYPE html>

<html>
<head>
<title>edit</title>
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

   $id = null;

   if(isset($_GET["id"]))
   {
     $id = $_GET["id"];
   }
  
   

   $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

   $sql = "SELECT * FROM appo WHERE id = '".$id."' ";

   $query = mysqli_query($conn,$sql);

   $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

?>
<form action="update.php" name="frmAdd" method="post">
<table width="284" border="1">
  <tr>
    <th width="120">id</th>
    <td width="238"><input type="hidden" name="id" value="<?php echo $result["id"];?>"><?php echo $result["id"];?></td>
    </tr>
  <tr>
    <th width="120">Name</th>
    <td><input type="text" name="name" size="20" value="<?php echo $result["username"];?>"></td>
    </tr>
  <tr>
    <th width="120">detail</th>
    <td><input type="text" name="detail" size="20" value="<?php echo $result["detail"];?>"></td>
    </tr>
  <tr>
    <th width="120">title</th>
    <td><input type="text" name="title" size="2" value="<?php echo $result["tilte"];?>"></td>
    </tr>
  <tr>
    <th width="120">color</th>
    <td><input type="text" name="color" size="5" value="<?php echo $result["color"];?>"></td>
    </tr>
  <tr>
    <th width="120">date</th>
    <td><input type="date" name="date" size="5" value="<?php echo $result["date"];?>"></td>
    </tr>
    <tr>
    <th width="120">starttime</th>
    <td><input type="time" name="time" size="5" value="<?php echo $result["starttime"];?>"></td>
    </tr>
    <tr>
    <th width="120">endtime</th>
    <td><input type="time" name="endtime" size="5" value="<?php echo $result["endtime"];?>"></td>
    </tr>
  </table>
  <input type="submit" name="submit" value="submit">
</form>
<?php
mysqli_close($conn);
?>
</body>
</html>
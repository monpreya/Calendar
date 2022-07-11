<!DOCTYPE html>
<html>
<head>
<title>ThaiCreate.Com PHP & MySQL (mysqli)</title>
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

   $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

   $sql = "SELECT * FROM appo";

   $query = mysqli_query($conn,$sql);

?>
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">\ID </div></th>
    <th width="98"> <div align="center">Detail </div></th>
    <th width="198"> <div align="center">Title </div></th>
    <th width="97"> <div align="center">starttime </div></th>
    <th width="59"> <div align="center">endtime </div></th>
    <th width="71"> <div align="center">color </div></th>
  <th width="71"> <div align="center">date </div></th>
  <th width="71"> <div align="center">username </div></th>
  <th width="71"> <div align="center">Delete </div></th>
  <th width="71"> <div align="center">Edit </div></th>


  </tr>
<?php
while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
?>
  <tr>
    <td><div align="center"><?php echo $result["id"];?></div></td>
    <td><?php echo $result["detail"];?></td>
    <td><?php echo $result["tilte"];?></td>
    <td><div align="center"><?php echo $result["starttime"];?></div></td>
    <td align="right"><?php echo $result["endtime"];?></td>
    <td align="right"><?php echo $result["color"];?></td>
    <td align="right"><?php echo $result["date"];?></td>
    <td align="right"><?php echo $result["username"];?></td>
  <td align="right"><a href="delete.php?id=<?php echo $result["id"];?>">delete</a></td>
  <td align="right"><a href="edit.php?id=<?php echo $result["id"];?>">edit</a></td>

  </tr>
<?php
}
?>
</table>
<?php
mysqli_close($conn);
?>
</body>
</html>
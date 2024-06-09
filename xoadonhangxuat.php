<?php
$id = $_GET['id'];
require 'connect.php';
$sql = "delete from donxuatchitiet where id_donxuat = '$id'";
mysqli_query($connect,$sql);
$sql = "delete from donxuat where id = '$id'";
mysqli_query($connect,$sql);
header('location:danhsachdonhangxuat.php');
?>
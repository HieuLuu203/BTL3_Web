<?php
$id = $_POST['id'];
$trangthai = $_POST['trangthai'];
echo $id;
echo $trangthai;
require 'connect.php';
$sql = "update donnhap set trangthai = '$trangthai' where id = '$id'";
mysqli_query($connect,$sql);
header('location:danhsachdonhangnhap.php');
?>
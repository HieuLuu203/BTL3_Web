<?php

$id = $_GET['id'];
require 'connect.php';
$sql = "delete from donnhapchitiet where id_donnhap = '$id'";
mysqli_query($connect,$sql);
$sql = "delete from donnhap where id = '$id'";
mysqli_query($connect,$sql);
header('location:danhsachdonhangnhap.php');
?>
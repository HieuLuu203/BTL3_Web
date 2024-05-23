<?php 
	$id = $_POST['id'];
	if(empty($_POST['ten'])){
		header("location:sualoaisanpham.php?id=$id&error=Hãy điền đầy đủ thông tin cần sửa&dvt=&ten=");
		exit;
	}
	if(empty($_POST['donvi'])){
		header("location:sualoaisanpham.php?id=$id&error=Hãy điền đầy đủ thông tin cần sửa&dvt=&ten=");
		exit;
	}
	$ten = $_POST['ten'];
	$donvi = $_POST['donvi'];
	require 'connect.php';
	$sql = "update loaisanpham set ten = '$ten', donvitinh = '$donvi' where id = '$id'";


	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header('location:danhsachloaisanpham.php?suathanhcong=Sửa đơn vị thành công');
 ?>
<?php 
	
	if(empty($_GET['id'])){
		header("location:danhsachsanpham.php");
		exit;
	}
	$id = $_GET['id'];
	require 'connect.php';
	$sql = "delete from sanpham where id = '$id'";


	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header("location:danhsachsanpham.php?xoathanhcong=Xóa sản phẩm thành công");

 ?>
<?php 
	
	if(empty($_GET['id'])){
		header("location:danhsachdonvi.php");
		exit;
	}
	$id = $_GET['id'];
	require 'connect.php';
	$sql = "delete from loaisanpham where id = '$id'";


	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header("location:danhsachloaisanpham.php?xoathanhcong=Xóa loại sản phẩm thành công");

 ?>
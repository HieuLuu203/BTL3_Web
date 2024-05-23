<?php 
	
	if(empty($_GET['id'])){
		header("location:danhsachnhacungcap.php");
		exit;
	}
	$id = $_GET['id'];
	require 'connect.php';
	$sql = "delete from nhacungcap where id = '$id'";


	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header("location:danhsachnhacungcap.php?xoathanhcong=Xóa nhà cung cấp thành công");

 ?>
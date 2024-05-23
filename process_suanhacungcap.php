<?php 
	if(empty($_POST['id']) || empty($_POST['ten']) || empty($_POST['sodienthoai']) || empty($_POST['email'])
	|| empty($_POST['diachi'])){
		header('location:suanhacungcap.php?error=Hãy điền đầy đủ thông tin của nhà cung cấp');
		exit;
	}
	$id = $_POST['id'];
	$ten = $_POST['ten'];
	$sodienthoai = $_POST['sodienthoai'];
	$email = $_POST['email'];
	$diachi = $_POST['diachi'];
	require 'connect.php';
	$sql = "update nhacungcap set 
	ten = '$ten',
	sodienthoai = '$sodienthoai',
	email = '$email',
	diachi = '$diachi'
	where id = '$id'
	";

	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header('location:danhsachnhacungcap.php?suathanhcong=Sửa nhà cung cấp thành công');
 ?>
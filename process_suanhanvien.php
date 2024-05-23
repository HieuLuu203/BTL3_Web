<?php 
	if(empty($_POST['id']) || empty($_POST['ten']) || empty($_POST['sodienthoai']) || empty($_POST['diachi'])
	|| empty($_POST['email'])){
		header("location: " . $_SERVER['HTTP_REFERER'] . "&error=Hãy điền đầy đủ thông tin của nhân viên");
			exit;
	}
	$id = $_POST['id'];
	$ten = $_POST['ten'];
	$sodienthoai = $_POST['sodienthoai'];
	$email = $_POST['email'];
	$diachi = $_POST['diachi'];
	$quyen = $_POST['quyen'];
	require 'connect.php';
	$sql = "update nhanvien set 
	ten = '$ten',
	sodienthoai = '$sodienthoai',
	email = '$email',
	diachi = '$diachi',
	quyen = '$quyen'
	where id = '$id'
	";

	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header('location:danhsachnhanvien.php?suathanhcong=Sửa nhân viên thành công');
 ?>
<?php 
	if(empty($_POST['id']) || empty($_POST['ten']) || empty($_POST['gianhap'])
	|| empty($_POST['giaban'])){
		header('location:suasanpham.php?error=Hãy điền đầy đủ thông tin của sản phẩm');
		exit;
	}
	$id = $_POST['id'];
	$ten = $_POST['ten'];
	$gianhap = $_POST['gianhap'];
	$giaban = $_POST['giaban'];
	require 'connect.php';
	$sql = "update sanpham set 
	ten = '$ten',
	gianhap = '$gianhap',
	giaban = '$giaban'
	where id = '$id'
	";

	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header('location:danhsachsanpham.php?suathanhcong=Sửa sản phẩm thành công');
 ?>
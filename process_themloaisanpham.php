<?php 

	if(empty($_POST['ten']) || empty($_POST['donvitinh'])){
		header('location:themloaisanpham.php?error=Hãy điền đầy đủ thông tin của loại sản phẩm');
		exit;
	}
	$ten = $_POST['ten'];
	$donvitinh = $_POST['donvitinh'];

	require 'connect.php';
	$sql = "insert into loaisanpham(ten,donvitinh) 
	values('$ten','$donvitinh')";


	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header('location:danhsachloaisanpham.php?themthanhcong=Thêm loại sản phẩm thành công');
 ?>
<?php 
	if(empty($_POST['ten']) || empty($_POST['sodienthoai']) || empty($_POST['email'])
	|| empty($_POST['diachi']) || empty($_POST['taikhoan'])
	|| empty($_POST['matkhau'])
	){
		header('location:themnhanvien.php?error=Hãy điền đầy đủ thông tin của nhân viên');
		exit;
	}
	$ten = $_POST['ten'];
	$sodienthoai = $_POST['sodienthoai'];
	$email = $_POST['email'];
	$diachi = $_POST['diachi'];
	$taikhoan = $_POST['taikhoan'];
	$matkhau = $_POST['matkhau'];
	$quyen = $_POST['quyen'];
	require 'connect.php';
	$sql = "insert into nhanvien(ten,sodienthoai,diachi,email,taikhoan,matkhau,quyen) 
	values('$ten','$sodienthoai','$diachi','$email', '$taikhoan', '$matkhau', '$quyen')";

	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header('location:danhsachnhanvien.php?themthanhcong=Thêm nhân viên thành công');
 ?>
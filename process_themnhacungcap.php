<?php 
	if(empty($_POST['ten']) || empty($_POST['sodienthoai']) || empty($_POST['email'])
	|| empty($_POST['diachi'])){
		header('location:themnhacungcap.php?error=Hãy điền đầy đủ thông tin của nhà cung cấp');
		exit;
	}
	$ten = $_POST['ten'];
	$sodienthoai = $_POST['sodienthoai'];
	$email = $_POST['email'];
	$diachi = $_POST['diachi'];
	require 'connect.php';
	$sql = "insert into nhacungcap(ten,sodienthoai,email,diachi) 
	values('$ten','$sodienthoai','$email','$diachi')";

	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header('location:danhsachnhacungcap.php?themthanhcong=Thêm nhà cung cấp thành công');
 ?>
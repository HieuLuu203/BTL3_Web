<?php 
	if(empty($_POST['ten']) ||
	 empty($_POST['gianhap'])
	|| empty($_POST['giaban']) || !isset($_POST['soluong'])){
		header('location:themsanpham.php?error=Hãy điền đầy đủ thông tin của sản phẩm');
		exit;
	}
	$ten = $_POST['ten'];
	$loaisanpham = $_POST['loaisanpham'];
	$nhacungcap = $_POST['nhacungcap'];
	$gianhap = $_POST['gianhap'];
	$giaban = $_POST['giaban'];
	$soluong = $_POST['soluong'];
	require 'connect.php';
	$sql = "insert into sanpham(ten,id_loaisanpham,id_ncc,gianhap,giaban,soluong) 
	values('$ten','$loaisanpham', '$nhacungcap','$gianhap','$giaban', '$soluong')";

	mysqli_query($connect,$sql);
	mysqli_close($connect);

	header('location:danhsachsanpham.php?themthanhcong=Thêm sản phẩm thành công');
 ?>
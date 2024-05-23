<?php 
    require 'connect.php';
    session_start();
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header('Location: themdonhangnhap.php?error=Chưa có sản phẩm');
    exit;
    }
    if(empty($_POST['ngaynhap']))
    {
        header('Location: themdonhangnhap.php?error=Ngày đang bỏ trống');
        exit;
    }
	$nhanvien = $_POST['nhanviennhap'];
	$ngaynhap = $_POST['ngaynhap'];
	$trangthai = $_POST['trangthai'];
    echo $nhanvien;
    echo $trangthai;
	$tongtien = 0;
	if (isset($_SESSION['cart'])) {
    $sql = "select * from sanpham";
    $sanpham = mysqli_query($connect,$sql);

    foreach ($_SESSION['cart'] as $each) {
        foreach ($sanpham as $sp) {
            if ($sp['id'] == $each['product_id']) {
                $thanhtien = $sp['gianhap'] * $each['quantity'];
                $tongtien += $thanhtien;
                break;
            }
        }
    }
    $sql = "insert into donnhap(trangthai, id_nhanvien, ngaynhap,tongtien)
    values('$trangthai','$nhanvien', '$ngaynhap','$tongtien')";
    mysqli_query($connect,$sql);

    $donnhap_id = mysqli_insert_id($connect);

    if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $each) {
        foreach ($sanpham as $sp) {
            if ($sp['id'] == $each['product_id']) {
                $product_id = $each['product_id'];
                $quantity = $each['quantity'];
                $sql = "INSERT INTO donnhapchitiet (id_donnhap, id_sanpham, soluongnhap)
                    VALUES ('$donnhap_id', '$product_id', '$quantity')";
            	mysqli_query($connect, $sql);
                $sql = "update sanpham set soluong = soluong + '$quantity' where id = '$product_id'";
                mysqli_query($connect, $sql);
                break;
            }
        }
    }
    unset($_SESSION['cart']);
    header('location:danhsachdonhangnhap.php');
}

}

 ?>
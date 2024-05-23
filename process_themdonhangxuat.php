<?php 
    require 'connect.php';
    session_start();
    if (!isset($_SESSION['cart_xuat']) || count($_SESSION['cart_xuat']) == 0) {
    header('Location: themdonhangxuat.php?error=Chưa có sản phẩm');
    exit;
    }
    if(empty($_POST['ngayxuat']))
    {
        header('Location: themdonhangxuat.php?error=Ngày đang bỏ trống');
        exit;
    }
	$nhanvien = $_POST['nhanvienxuat'];
	$ngayxuat = $_POST['ngayxuat'];
	$trangthai = $_POST['trangthai'];
    echo $nhanvien;
	$tongtien = 0;
	if (isset($_SESSION['cart_xuat'])) {
    $sql = "select * from sanpham";
    $sanpham = mysqli_query($connect,$sql);

    foreach ($_SESSION['cart_xuat'] as $each) {
        foreach ($sanpham as $sp) {
            if ($sp['id'] == $each['product_id']) {
                $thanhtien = $sp['giaban'] * $each['quantity'];
                $tongtien += $thanhtien;
                break;
            }
        }
    }
    $sql = "insert into donxuat(trangthai, id_nhanvien, ngayxuat,tongtien)
    values('$trangthai','$nhanvien', '$ngayxuat','$tongtien')";
    mysqli_query($connect,$sql);

    $donxuat_id = mysqli_insert_id($connect);

    if (isset($_SESSION['cart_xuat'])) {
    foreach ($_SESSION['cart_xuat'] as $each) {
        foreach ($sanpham as $sp) {
            if ($sp['id'] == $each['product_id']) {
                $product_id = $each['product_id'];
                $quantity = $each['quantity'];
                $sql = "INSERT INTO donxuatchitiet(id_donxuat, id_sanpham, soluongxuat)
                    VALUES ('$donxuat_id', '$product_id', '$quantity')";
            	mysqli_query($connect, $sql);

                 $sql = "update sanpham set soluong = soluong - '$quantity' where id = '$product_id'";
                mysqli_query($connect, $sql);
                break;
            }
        }
    }
    unset($_SESSION['cart_xuat']);
    header('location:danhsachdonhangxuat.php');
}

}

 ?>
<?php 

session_start();

$response = [];
$totalAmount = 0;  // Biến tổng tiền

if (isset($_SESSION['cart_xuat'])) {
    // Giả sử biến `$sanpham` chứa thông tin sản phẩm như bạn đã dùng trước đó
    require 'connect.php';
    $sql = "select * from sanpham";
    $sanpham = mysqli_query($connect,$sql);

    foreach ($_SESSION['cart_xuat'] as $each) {
        foreach ($sanpham as $sp) {
            if ($sp['id'] == $each['product_id']) {
                $thanhtien = $sp['giaban'] * $each['quantity'];
                $response[] = [
                    'product_id' => $sp['id'],
                    'ten' => $sp['ten'],
                    'quantity' => $each['quantity'],
                    'giaxuat' => $sp['giaban'],
                    'thanhtien' => $sp['giaban'] * $each['quantity']
                ];
                $totalAmount += $thanhtien;
                break;
            }
        }
    }
}

header('Content-Type: application/json');
echo json_encode([
    'cart' => $response,
    'totalAmount' => $totalAmount
]);
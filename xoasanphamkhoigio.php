<?php 

// xoasanphamkhoigio.php
session_start();

if (isset($_POST['product_id'])) {
    $productID = $_POST['product_id'];

    // Tìm và xóa sản phẩm trong giỏ hàng
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $each) {
            if ($each['product_id'] == $productID) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }

        // Sắp xếp lại các chỉ số mảng sau khi xóa
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Phản hồi thành công
header('Content-Type: application/json');
echo json_encode(['success' => true]);
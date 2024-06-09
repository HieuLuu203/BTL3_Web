<?php 
	session_start();
// Kiểm tra nếu giỏ hàng tồn tại, xóa giỏ hàng
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

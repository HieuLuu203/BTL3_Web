<?php 
session_start();

//Kiểm tra nếu không có giỏ hàng trong session, khởi tạo giỏ hàng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
// Đọc dữ liệu từ form
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['product_id'] == $product_id) {
        // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
        $item['quantity'] += $quantity;
        $found = true;
        break;
    }
}

// Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới
if (!$found) {
    $new_item = array(
        'product_id' => $product_id,
        'quantity' => $quantity,
    );
    $_SESSION['cart'][] = $new_item;
}

// Chuyển hướng về trang giỏ hàng hoặc trang thông báo
header('location:themdonhangnhap.php');
exit;
?>
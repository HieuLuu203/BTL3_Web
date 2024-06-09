<?php 
    session_start();
    if(!isset($_SESSION['user_id']))
    {
        header('location:login.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Thêm đơn hàng nhập</title>
</head>

<body id="page-top">
    <?php 
        if (!isset($_SESSION['cart'])) {
         $_SESSION['cart'] = array();
        }
        require 'connect.php';
        $sql = "select * from nhanvien";
        $nhanvien = mysqli_query($connect,$sql);

        $sql = "select * from sanpham";
        $sanpham = mysqli_query($connect,$sql);

     ?>
    <div id="wrapper">

        <?php include "sidebar.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <?php include "header.php" ?>
                <div>
                    <form method="post" action="process_themdonhangnhap.php" style="width: 70%;" class = "ml-auto mr-auto">
                    <h2 class="text-dark mt-3">Thêm đơn hàng nhập</h2>
                    <label>Nhân viên</label>
                    <br/>
                    <select name="nhanviennhap" class="input-group form-control form-select form-select-lg mb-3">
                        <?php foreach ($nhanvien as $each):?>
                                    <option value="<?php echo $each['id'];?>"><?php echo $each['ten'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="d-flex justify-content-between mt-3">
                        <div style="width: 40%;">
                            <label>Ngày nhập</label>
                            <br/>
                            <input name = "ngaynhap"  type="datetime-local" class="form-control mb-2" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div style="width: 40%;">
                            <label>Trạng thái</label>
                            <br/>
                            <select class="form-control" name="trangthai">
                                <option selected value="Đã thanh toán">Đã thanh toán</option>
                                <option value="Chưa thanh toán">Chưa thanh toán</option>
                            </select>
                        </div>
                    </div>

                    <hr>
                    <h2 class="text-dark mt-3">Chi tiết đơn</h2>
                    <div class="d-flex align-items-center mb-5">
                        <div class="mr-3" style="width: 30%;">
                            <label>Tên sản phẩm</label>
                            <br/>
                            <select id="productSelect" name="nhanvien" class="input-group form-control form-select form-select-lg" aria-label="Large select example">
                                <?php foreach ($sanpham as $each):?>
                                    <option value="<?php echo $each['id']; ?>"><?php echo $each['ten'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div style="width: 30%;">
                            <label>Số lượng</label>
                            <br/>
                            <input id="quantityInput" name = "soluong"  type="number" class="form-control" placeholder="Nhập số lượng" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <a id="addToCartButton" class="btn btn-primary ml-5" style="display: block; margin-top: 32px;">Thêm sản phẩm</a>
                    </div>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá nhập</th>
                                            <th>Thành tiền</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTabletbody">
                                        <?php if (isset($_SESSION['cart'])): ?>
                                            <?php foreach ($_SESSION['cart'] as $each): ?>
                                                <tr>
                                                    <th>
                                                    <?php foreach ($sanpham as $sp): ?>
                                                        <?php if ($sp['id'] == $each['product_id']): ?>
                                                            <?php echo $sp['ten']; break; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    </th>
                                                    <th><?php echo htmlspecialchars($each['quantity']); ?>
                                                    </th>
                                                    <th>
                                                    <?php foreach ($sanpham as $sp): ?>
                                                        <?php if ($sp['id'] == $each['product_id']): ?>
                                                            <?php echo ceil($sp['gianhap']); break; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    </th>
                                                    <th>0
                                                    <?php foreach ($sanpham as $sp): ?>
                                                        <?php if ($sp['id'] == $each['product_id']): ?>
                                                            <?php echo $sp['gianhap']*$each['quantity']; break; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    </th>
                                                    <th>1</th>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                                <h2 style="color: #86469C; font-weight: 700;" class="mt-4" id="totalAmount"><b>Tổng đơn: </b> 0 đ</h2>
                                <?php 
                        if(isset($_GET['error'])){?>
                            <span class = "mt-1" style="color:red"><?php echo $_GET['error'] ?></span>
                            <br/>
                    <?php } ?>
                    <button style="background: #FA7070; border: none;" class="btn btn-warning btn-block mt-3">Thêm đơn hàng</button>

                </form>
                </div>

            </div>
            <?php include "footer.php" ?>

        </div>
    </div>
    <?php include "script.php" ?>

    <script>
        // Thêm sản phẩm vào giỏ hàng
        $(document).ready(function () {
            $('#addToCartButton').on('click', function (e) {
                e.preventDefault();
                
                // Lấy giá trị từ các input
                var productID = $('#productSelect').val();
                var quantity = $('#quantityInput').val();
                var quantityNum = Number(quantity);
                console.log(productID);
                if(!Number.isInteger(quantityNum))
                {
                    alert("Hãy nhập số nguyên cho số lượng!");
                    return;
                }
                if(!quantityNum)
                {
                    alert("Hãy nhập đúng số lượng!");
                    return;
                }
                if(quantityNum < 1)
                {
                    alert("Hãy nhập số lượng lớn hơn 0!");
                    return;
                }
                // Gửi yêu cầu AJAX tới server
                $.ajax({
                    url: 'themsanphamvaogio.php',
                    type: 'POST',
                    data: {
                        product_id: productID,
                        quantity: quantity
                    },
                    success: function (response) {
                        // Xử lý thành công (Hiển thị thông báo hoặc cập nhật giỏ hàng)
                        alert('Sản phẩm đã được thêm vào giỏ hàng!');
                        updateCartTable();
                    },
                    error: function (xhr, status, error) {
                        // Xử lý lỗi nếu xảy ra
                        console.error('Đã xảy ra lỗi:', error);
                    }
                });
            });
        // Cập nhật bảng giỏ hàng sau khi thêm sản phẩm
        function updateCartTable() {
        $.ajax({
            url: 'get_cart_data.php',  // Tệp PHP trả về dữ liệu giỏ hàng
            type: 'GET',
            success: function (response) {
                var tableBody = $('#dataTabletbody');
                $('#quantityInput').val("");
                tableBody.empty();  // Xóa nội dung bảng cũ
                response.cart.forEach(function (item) {
                    var formattedGianhap = parseFloat(item.gianhap).toLocaleString('en-US');
                    var formattedTT = parseFloat(item.thanhtien).toLocaleString('en-US');
                    var row = '<tr>'
                        + '<th>' + item.ten + '</th>'
                        + '<th>' + item.quantity + '</th>'
                        + '<th>' + formattedGianhap +" đ" + '</th>'
                        + '<th>' + formattedTT + " đ" + '</th>'
                        + '<th><a class="btn btn-danger btn-delete-item-cart" data-product-id="' + item.product_id + '">Xóa</a></th>'
                        + '</tr>';
                    tableBody.append(row);
                });
                $('#totalAmount').text('Tổng đơn: ' + parseFloat(response.totalAmount).toLocaleString('en-US')  + ' đ');
            },
            error: function (xhr, status, error) {
                console.error('Đã xảy ra lỗi khi tải dữ liệu giỏ hàng:', error);
            }
        });
    }
    // Lắng nghe sự kiện click trên các nút xóa sau khi bảng được cập nhật
    $(document).on('click', '.btn-delete-item-cart', function (e) {
        e.preventDefault();

        var productID = $(this).data('product-id');

        // Gửi yêu cầu Ajax tới máy chủ để xóa sản phẩm khỏi giỏ hàng
        $.ajax({
            url: 'xoasanphamkhoigio.php', // Tệp PHP xóa sản phẩm
            type: 'POST',
            data: {
                product_id: productID
            },
            success: function (response) {
                alert('Sản phẩm đã được xóa khỏi giỏ hàng!');
                updateCartTable(); // Cập nhật lại bảng sau khi xóa
            },
            error: function (xhr, status, error) {
                console.error('Đã xảy ra lỗi:', error);
            }
        });
    });
    // Tải dữ liệu giỏ hàng ngay khi trang được tải
    updateCartTable();
        });

    </script>
</body>

</html>
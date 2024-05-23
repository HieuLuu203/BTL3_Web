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

    <title>Danh sách đơn hàng bán</title>
</head>

<body id="page-top">
    <?php 
        require 'connect.php';
        $sql = "select * from nhanvien";
        $nhanvien = mysqli_query($connect,$sql);

        $sql = "select * from donxuat";
        $donxuat = mysqli_query($connect,$sql);
     ?>
    <div id="wrapper">
        <?php include "sidebar.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "header.php" ?>
                <div style="color: #000;" class="container-fluid">
                    <h1 style="text-align:center;" class="h3 mb-2 text-gray-800">Danh sách đơn hàng bán</h1>
                    <div class="">
                        <div class="">
                            <div class="table-responsive">
                                <button type="button" class="btn btn-success mb-3">
                                    <a class = "text-white text-decoration-none" href="themdonhangxuat.php">Thêm đơn hàng bán</a>
                                </button>
                                <table style="color: #000; border: 1px solid #000;" class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ngày xuất</th>
                                            <th>Nhân viên bán</th>
                                            <th>Trạng thái</th>
                                            <th>Tổng tiền</th>
                                            <th>Chi tiết</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($donxuat as $each):?>
                                            <tr>
                                                <th><?php echo $each['id'] ?></th>
                                                <th><?php echo $each['ngayxuat'] ?></th>
                                                <th>
                                                    <?php foreach ($nhanvien as $nv): ?>
                                                        <?php if ($nv['id'] == $each['id_nhanvien']): ?>
                                                            <?php echo $nv['ten']; break; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </th>
                                                <th><?php echo $each['trangthai'] ?></th>
                                                <th><?php echo number_format(ceil($each['tongtien']), 0, '.', ',') . ' đ'; ?></th>
                                                <th>
                                                    <button type="button" class="btn btn-primary"><a class = "text-white text-decoration-none" href="chitietdonxuat.php?id=<?php echo $each['id'] ?>">Chi tiết</a></button>
                                                </th>
                                                <th>
                                                    <button type="button" class="btn btn-warning"><a class = "text-white text-decoration-none" href="suadonhangxuat.php?id=<?php echo $each['id'] ?>">Sửa</a></button>
                                                </th>
                                                <th>
                                                    <button type="button" class="btn btn-danger"><a class = "text-white text-decoration-none" href="xoadonhangxuat.php?id=<?php echo $each['id'] ?>">Xóa</a></button>
                                                </th>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "footer.php" ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="xoadonhangnhap-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Bạn có muốn xóa sản phẩm này không?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <button id="confirm-xoa-sanpham" class="btn btn-primary">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    <?php include "script.php" ?>
    <script src="js/jsquery.js"></script>

</body>

</html>
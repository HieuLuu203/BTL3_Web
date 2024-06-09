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
    <title>Danh sách đơn hàng nhập</title>
</head>

<body id="page-top">
    <?php 
        require 'connect.php';
        $sql = "select * from nhanvien";
        $nhanvien = mysqli_query($connect,$sql);

        $sql = "select * from donnhap";
        $donnhap = mysqli_query($connect,$sql);
     ?>
    <div style="height: 100vh;" id="wrapper">
        <?php include "sidebar.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "header.php" ?>
                <div style="color: #000;" class="container-fluid">
                    <h1 style="text-align:center; color:#000;" class="h3 mb-2">Đơn hàng nhập</h1>
                    <div class="mb-4">
                        <div class="">
                            <div class="table-responsive">
                                <button type="button" class="btn btn-success mb-3">
                                    <a class = "text-white text-decoration-none" href="themdonhangnhap.php">Thêm đơn hàng nhập</a>
                                </button>
                                <!-- Bảng đơn nhập -->
                                <table style="color: #000; border: 1px solid #000;" class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ngày nhập</th>
                                            <th>Nhân viên nhập</th>
                                            <th>Trạng thái</th>
                                            <th>Tổng tiền</th>
                                            <th>Chi tiết</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($donnhap as $each):?>
                                            <tr>
                                                <th><?php echo $each['id'] ?></th>
                                                <th><?php echo $each['ngaynhap'] ?></th>
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
                                                    <button type="button" class="btn btn-primary"><a class = "text-white text-decoration-none" href="chitietdonhap.php?id=<?php echo $each['id'] ?>">Chi tiết</a></button>
                                                </th>
                                                <th>
                                                    <button type="button" class="btn btn-warning"><a class = "text-white text-decoration-none" href="suadonhangnhap.php?id=<?php echo $each['id'] ?>">Sửa</a></button>
                                                </th>
                                                <th>
                                                    <a class="btn btn-danger mb-3" href="#" data-toggle="modal" data-target="#xoadonhangnhap-modal" data-productid="<?php echo $each['id']; ?>">
                                                        Xóa
                                                    </a>
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
            <!-- Footer -->
            <?php include "footer.php" ?>
            <!-- End of Footer -->

        </div>
    </div>
    <div class="modal fade" id="xoadonhangnhap-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa đơn hàng nhập</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Bạn có muốn xóa đơn hàng nhập này không?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <button id="confirm-xoa-donhangnhap" class="btn btn-primary">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "script.php" ?>
    <script src="js/jsquery.js"></script>

</body>

</html>
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

    <title>Chi tiết đơn nhập</title>
</head>

<body id="page-top">
    <?php 
        if(empty($_GET['id']))
        {
            header('location:danhsachdonhangnhap.php');
        }
        $id = $_GET['id'];
        require 'connect.php';

        $sql = "select * from nhanvien";
        $nhanvien = mysqli_query($connect,$sql);

        $sql = "select * from sanpham";
        $sanpham = mysqli_query($connect,$sql);

        $sql = "select * from donnhap where id = '$id'";
        $donnhap = mysqli_query($connect,$sql);
        $row = mysqli_fetch_array($donnhap);
        $sql = "select * from donnhapchitiet where id_donnhap = '$id'";
        $danhsach = mysqli_query($connect,$sql);
     ?>
    <div id="wrapper">
        <?php include "sidebar.php" ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "header.php" ?>
                <div class="container-fluid">
                    <h1 style="text-align: center; color: #000;" class="h3 mb-2">Chi tiết đơn hàng nhập</h1>

                    <!-- DataTales Example -->
                    <div class="mb-4">
                        <div class="">
                            <div class="table-responsive">
                                <button style="background-color: #AD88C6; border: none;" type="button" class="btn btn-success mb-3">
                                    <a class = "text-white text-decoration-none" href="danhsachdonhangnhap.php">Danh sách đơn hàng nhập</a>
                                </button>
                                <div style="color: #000;" class="d-flex align-items-center">
                                    <h3 style="width: 30%; margin-right: 100px; font-size: 16px;"  > 
                                        <b style="display: block; margin-bottom: 5px;">Nhân viên nhập:</b> 
                                    <input class="form-control" disabled type="text" name="" value="<?php foreach ($nhanvien as $nv): ?>
<?php if ($nv['id'] == $row['id_nhanvien']): ?><?php echo $nv['ten']; break; ?><?php endif; ?><?php endforeach; ?>">   
                                    </h3>
                                
                                    <h3 style="width: 30%; font-size: 16px; margin-right: 100px;"> <b style="display: block; margin-bottom: 5px;">Ngày nhập:</b> 
                                    <input class="form-control" disabled type="date" name="" value="<?php echo $row['ngaynhap']; ?>">        
                                    </h3>
                                    <h3  style="width: 30%; font-size: 16px;"> <b style="display: block; margin-bottom: 5px;">Trạng thái:</b> 
                                    <input disabled class="form-control" type="text" name="" value="<?php echo $row['trangthai']; ?>">
                                </h3>
                                </div>
                                
                                <h3  style="color: #D20062; font-size: 20px;" class="mt-3 mb-3"> <b>Tổng tiền:</b> 
                                    <?php echo number_format(ceil($row['tongtien']), 0, '.', ',') . ' đ'; ?>
                                </h3>
                                                <th>
                                <table style="color: #000;" class="table" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá nhập</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($danhsach as $each):?>
                                            <tr>
                                                <th><?php echo $each['id_sanpham'] ?></th>
                                                <th>
                                                    <?php foreach ($sanpham as $sp): ?>
                                                        <?php if ($sp['id'] == $each['id_sanpham']): ?>
                                                            <?php echo $sp['ten']; break; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </th>
                                                <th>
                                                    <?php foreach ($sanpham as $sp): ?>
                                                        <?php if ($sp['id'] == $each['id_sanpham']): ?>
                                                            <?php echo number_format(ceil($sp['gianhap']), 0, '.', ',') . ' đ'; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </th>
                                                <th><?php echo $each['soluongnhap'] ?></th>
                                                <th>
                                                    <?php foreach ($sanpham as $sp): ?>
                                                        <?php if ($sp['id'] == $each['id_sanpham']): ?>
                                                            <?php echo number_format(ceil($sp['gianhap']*$each['soluongnhap']), 0, '.', ',') . ' đ'; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
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
            <?php include "footer.php" ?>
        </div>
    </div>

    <?php include "script.php" ?>
    <script src="js/jsquery.js"></script>

</body>

</html>
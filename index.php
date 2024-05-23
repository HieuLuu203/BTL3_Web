<?php 
    session_start();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang tổng quan</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body id="page-top">
    <?php 
        require 'connect.php';
        // Tổng tiền nhập
        $sql = "SELECT SUM(tongtien) AS TongTienThangNay FROM donnhap WHERE MONTH(ngaynhap) = MONTH(CURRENT_DATE()) AND YEAR(ngaynhap) = YEAR(CURRENT_DATE());";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);
        $tongtiennhap = $row['TongTienThangNay'];
        // Tổng tiền bán
        $sql = "SELECT SUM(tongtien) AS TongTienThangNay FROM donxuat WHERE MONTH(ngayxuat) = MONTH(CURRENT_DATE()) AND YEAR(ngayxuat) = YEAR(CURRENT_DATE());";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);
        $tongtienxuat = $row['TongTienThangNay'];
        // Số đơn nhập
        $sql = "SELECT COUNT(*) AS SoDonNhapThangNay FROM donnhap WHERE MONTH(ngaynhap) = MONTH(CURRENT_DATE())
            AND YEAR(ngaynhap) = YEAR(CURRENT_DATE());";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);
        $sodonnhap = $row['SoDonNhapThangNay'];
        // Số đơn bán
        $sql = "SELECT COUNT(*) AS SoDonBanThangNay FROM donxuat WHERE MONTH(ngayxuat) = MONTH(CURRENT_DATE())
            AND YEAR(ngayxuat) = YEAR(CURRENT_DATE());";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_assoc($result);
        $sodonban = $row['SoDonBanThangNay'];

        // Doanh thu theo nhà sản xuất
        // $sql = "SELECT 
        //    ncc.ten AS TenNhaCungCap,
        //    SUM(dxc.soluongxuat * sp.giaban) AS DoanhThu
        // FROM nhacungcap ncc
        // INNER JOIN sanpham sp ON ncc.id = sp.id_ncc
        // INNER JOIN loaisanpham lsp ON sp.id_loaisanpham = lsp.id
        // INNER JOIN donxuatchitiet dxc ON sp.id = dxc.id_sanpham
        // WHERE lsp.ten = 'Sữa'
        // GROUP BY ncc.id
        // ORDER BY DoanhThu DESC;";
        // $doanhthutheoncc = mysqli_query($connect,$sql);

        // Doanh thu các sản phẩm của mỗi loại sản phẩm
        $sql = "SELECT 
                    sp.ten AS TenSanPham,
                    COALESCE(SUM(dxc.soluongxuat * sp.giaban), 0) AS DoanhThu
                FROM sanpham sp
                LEFT JOIN donxuatchitiet dxc ON sp.id = dxc.id_sanpham
                JOIN donxuat dx ON dx.id = dxc.id_donxuat
                JOIN loaisanpham lsp ON sp.id_loaisanpham = lsp.id
                WHERE lsp.ten = 'Gạo' AND MONTH(dx.ngayxuat) = MONTH(CURRENT_DATE())
                AND YEAR(dx.ngayxuat) = YEAR(CURRENT_DATE())
                GROUP BY sp.id, sp.ten
                ORDER BY DoanhThu DESC;";
        $doanhthutheosp = mysqli_query($connect,$sql);


        // Select tất cả loại sản phẩm
        $sql = "SELECT * from loaisanpham";
        $loaisanpham = mysqli_query($connect,$sql);
        // Tim 5 san pham ban chay nhat ve so luong
        $sql = "SELECT 
                    sp.ten AS TenSanPham,
                    SUM(dxc.soluongxuat) AS SoLuong
                FROM sanpham sp
                JOIN donxuatchitiet dxc ON sp.id = dxc.id_sanpham
                JOIN donxuat dx ON dx.id = dxc.id_donxuat
                WHERE MONTH(dx.ngayxuat) = MONTH(CURRENT_DATE())
                AND YEAR(dx.ngayxuat) = YEAR(CURRENT_DATE())
                GROUP BY sp.id, sp.ten
                ORDER BY SoLuong DESC
                LIMIT 5;";
        $top5sanpham = mysqli_query($connect,$sql);
     ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php" ?>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                
                <?php include "header.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Trang tổng quan</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Tiền nhập hàng -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tiền nhập hàng (Tháng này)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($tongtiennhap, 0, '.', ','); ?> đ</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tiền bán hàng -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Tiền bán hàng (Tháng này)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($tongtienxuat, 0, '.', ','); ?> đ</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Số đơn nhập -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-infor text-uppercase mb-1">
                                                Số đơn nhập</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sodonnhap ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Số đơn bán -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Số đơn bán</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sodonban ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <h3 class="mt-5 mb-3" style="font-weight: 700;color: #D2649A; ">Thống kê doanh thu các sản phẩm theo từng loại sản phẩm theo tháng</h3>
                    <form class="d-flex align-items-center mb-3" method="GET">
                        <select style="width: 50%;" name="loaisanpham" class="input-group form-control form-select form-select-lg mr-3">
                        <?php foreach ($loaisanpham as $each):?>
                                    <option value="<?php echo htmlspecialchars($each['ten']); ?>"
                                    <?php 
                                    if (isset($_GET['loaisanpham']) && $_GET['loaisanpham'] === $each['ten']) {
                                        echo 'selected';
                                    }
                                    ?>>
                                    <?php echo htmlspecialchars($each['ten']); ?>
                                    </option>
                        <?php endforeach ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Xem Doanh Thu</button>
                    </form>

                    <?php 

                        if (isset($_GET['loaisanpham'])) {
                        $loaiSanPham = $_GET['loaisanpham'];

                        // Câu truy vấn SQL, sử dụng biến $loaiSanPham trong điều kiện WHERE
                        $sql = "SELECT 
                                    sp.ten AS TenSanPham,
                                    COALESCE(SUM(dxc.soluongxuat * sp.giaban), 0) AS DoanhThu
                                FROM sanpham sp
                                LEFT JOIN donxuatchitiet dxc ON sp.id = dxc.id_sanpham
                                JOIN donxuat dx ON dx.id = dxc.id_donxuat
                                JOIN loaisanpham lsp ON sp.id_loaisanpham = lsp.id
                                WHERE lsp.ten = ? AND MONTH(dx.ngayxuat) = MONTH(CURRENT_DATE())
                                AND YEAR(dx.ngayxuat) = YEAR(CURRENT_DATE())
                                GROUP BY sp.id, sp.ten
                                ORDER BY DoanhThu DESC;";

                        // Chuẩn bị và thực thi truy vấn
                        $stmt = mysqli_prepare($connect, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $loaiSanPham);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $doanhthutheosp = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    }

                     ?>


                    <table class="table table-bordered table-info" id="dataTable" width="80%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Doanh thu bán ra</th>
                                        </tr>
                                    </thead>
                                    <?php $stt = 1;
                                    foreach ($doanhthutheosp as $each):?>
                                            <tr>
                                                <th><?php echo $stt ?></th>
                                                <th><?php echo $each['TenSanPham'] ?></th>
                                                <th><?php echo number_format($each['DoanhThu'], 0, '.', ',')  ?> đ</th>
                                            </tr>
                                        <?php $stt++; endforeach ?>
                                    </tbody>
                                </table>


                    <h3 class="mt-5 mb-3" style="font-weight: 700;color: #41B06E; ">Top 5 sản phẩm bán chạy nhất tháng theo số lượng</h3>
                    <table class="table table-bordered table-warning" id="dataTable" width="80%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng bán ra</th>
                                        </tr>
                                    </thead>
                                    <?php $stt = 1;
                                    foreach ($top5sanpham as $each):?>
                                            <tr>
                                                <th><?php echo $stt ?></th>
                                                <th><?php echo $each['TenSanPham'] ?></th>
                                                <th><?php echo number_format($each['SoLuong'], 0, '.', ',')  ?></th>
                                            </tr>
                                        <?php $stt++; endforeach ?>
                                    </tbody>
                                </table>

                    <h3 class="mt-5 mb-3" style="font-weight: 700;color: #008DDA; ">Biểu đồ phần trăm doanh thu của từng loại sản phẩm</h3>
                    <div class="row">
                        <?php 
                            $sql = "SELECT 
                                    lsp.ten AS LoaiSanPham,
                                    COALESCE(SUM(dxc.soluongxuat * sp.giaban), 0) AS Revenue,
                                    (COALESCE(SUM(dxc.soluongxuat * sp.giaban), 0) / 
                                        (SELECT SUM(dxc.soluongxuat * sp.giaban)
                                         FROM sanpham sp
                                         INNER JOIN donxuatchitiet dxc ON sp.id = dxc.id_sanpham
                                         INNER JOIN donxuat dx ON dxc.id_donxuat = dx.id
                                         WHERE MONTH(dx.ngayxuat) = MONTH(CURRENT_DATE())
                                         AND YEAR(dx.ngayxuat) = YEAR(CURRENT_DATE())
                                        )
                                    ) * 100 AS Percentage
                                FROM loaisanpham lsp
                                LEFT JOIN sanpham sp ON lsp.id = sp.id_loaisanpham
                                LEFT JOIN donxuatchitiet dxc ON sp.id = dxc.id_sanpham
                                LEFT JOIN donxuat dx ON dxc.id_donxuat = dx.id
                                WHERE MONTH(dx.ngayxuat) = MONTH(CURRENT_DATE())
                                AND YEAR(dx.ngayxuat) = YEAR(CURRENT_DATE())
                                GROUP BY lsp.id, lsp.ten
                                ORDER BY Revenue DESC;";
                            $result = mysqli_query($connect,$sql);
                            if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                $ten[] = $row['LoaiSanPham'];
                                $phantram[] = $row['Percentage'];
                              }
                            }
                            $backgroundColors = ['#4e73df', '#1cc88a', '#36b9cc', '#FF9F66','#FF5580']; // Màu nền
                            $hoverBackgroundColors = ['#2e59d9', '#17a673', '#2c9faf','#FF5F00', '#FF0080']; // Màu khi hover

                         ?>

                        <!-- Pie Chart -->
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Biểu đồ</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        var ctx = document.getElementById("myPieChart");
                        var myPieChart = new Chart(ctx, {
                          type: 'doughnut',
                          data: {
                            labels: <?php echo json_encode($ten); ?>,
                            datasets: [{
                              data: <?php echo json_encode($phantram); ?>,
                              backgroundColor: <?php echo json_encode($backgroundColors); ?>,
                              hoverBackgroundColor: <?php echo json_encode($hoverBackgroundColors); ?>,
                              hoverBorderColor: "rgba(234, 236, 244, 1)",
                            }],
                          },
                          options: {
                            maintainAspectRatio: false,
                            tooltips: {
                              backgroundColor: "rgb(255,255,255)",
                              bodyFontColor: "#858796",
                              borderColor: '#dddfeb',
                              borderWidth: 1,
                              xPadding: 15,
                              yPadding: 15,
                              displayColors: false,
                              caretPadding: 10,
                            },
                            legend: {
                              display: false
                            },
                            cutoutPercentage: 80,
                          },
                        });

                    </script>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2024</span>
                    </div>
                </div>
            </footer>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include "script.php" ?>

</body>

</html>
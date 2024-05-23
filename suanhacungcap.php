<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Thêm đơn vị</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <?php 
        if(!isset($_GET['id']) || !isset($_GET['ten']) 
            || !isset($_GET['sodienthoai']) || !isset($_GET['email'])
            || !isset($_GET['diachi'])
        )
        {
            header('location:danhsachnhacungcap.php');
        }
        $id = $_GET['id'];
        $ten = $_GET['ten'];
        $sodienthoai = $_GET['sodienthoai'];
        $email = $_GET['email'];
        $diachi = $_GET['diachi'];
     ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php" ?>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "header.php" ?>

                </nav>
                <!-- End of Topbar -->

                <!-- Content chính -->
                <!-- Form thêm đơn vị -->
                <h2 class="text-center text-dark mt-5">Sửa nhà cung cấp</h2>
                <div class="d-flex justify-content-center">
                    <form method="post" action="process_suanhacungcap.php" style="width: 500px;" class = "ml-5">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label>Nhà cung cấp</label>
                    <br/>
                    <input name = "ten" value="<?php echo $ten ?>"  type="text" class="form-control mb-2" placeholder="Tên nhà cung cấp" aria-label="Username" aria-describedby="basic-addon1">

                    <label>Điện thoại</label>
                    <br/>
                    <input name = "sodienthoai" value="<?php echo $sodienthoai ?>"  type="text" class="form-control mb-2" placeholder="Số điện thoại" aria-label="Username" aria-describedby="basic-addon1">

                    <label>Email</label>
                    <br/>
                    <input name = "email" value="<?php echo $email ?>"  type="email" class="form-control mb-2" placeholder="Nhập email" aria-label="Username" aria-describedby="basic-addon1">

                    <label>Địa chỉ</label>
                    <br/>
                    <input name = "diachi" value="<?php echo $diachi ?>"  type="text" class="form-control mb-2" placeholder="Nhập địa chỉ.." aria-label="Username" aria-describedby="basic-addon1">
                    <?php 
                        if(isset($_GET['error'])){?>
                            <span class = "mt-1" style="color:red"><?php echo $_GET['error'] ?></span>
                            <br/>
                    <?php } ?>
                    <button class="btn btn-warning">Sửa</button>
                </form>
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
    <!-- JS -->
    <?php include "script.php" ?>

</body>

</html>
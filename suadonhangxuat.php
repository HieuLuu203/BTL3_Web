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
    <title>Sửa đơn hàng xuất</title>
</head>

<body id="page-top">
    
    <div id="wrapper">
        <?php include "sidebar.php" ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "header.php" ?>
                <div>
                    <h3 class="mb-5" style="text-align: center;color: black;">Sửa đơn hàng xuất</h3>
                    <form method="post" action="process_suadonhangxuat.php" style="width: 70%;" class = "ml-auto mr-auto">
                            <label>ID đơn hàng xuất</label>
                            <input type="text" class="form-control" name="id" value="<?php echo $_GET['id']; ?>" readonly>
                            <br/>
                            <label>Trạng thái</label>
                            <br/>
                            <select class="form-control" name="trangthai">
                                <option selected value="Đã thanh toán">Đã thanh toán</option>
                                <option value="Chưa thanh toán">Chưa thanh toán</option>
                            </select>
                    <button style="background: #FA7070; border: none;" class="btn btn-warning btn-block mt-3">Sửa đơn hàng xuất</button>
                </form>
                </div>

            </div>
            <!-- Footer -->
            <?php include "footer.php" ?>
            <!-- End of Footer -->
        </div>
    </div>
    <?php include "script.php" ?>
</body>

</html>
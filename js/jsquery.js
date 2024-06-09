$(document).ready(function(){
  // Xoa loai san pham
  $('#xoadonvi-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Nút kích hoạt modal
    var productId = button.data('productid'); // Lấy ID sản phẩm từ thuộc tính data-productid

    // Đặt ID sản phẩm vào thuộc tính data-productid của nút Xóa trong modal
    var deleteButton = $(this).find('#confirm-delete');
    deleteButton.data('productid', productId);
  });

  // Xử lý khi nhấp vào nút Xóa trong modal
  $('#confirm-delete').click(function() {
    var productId = $(this).data('productid'); // Lấy ID sản phẩm
    // Chuyển hướng đến delete.php với ID sản phẩm
    console.log(productId);
    window.location.href = 'process_xoaloaisanpham.php?id=' + productId;
  });
  
});
$(document).ready(function(){
  // Xoa Nha cung cap
  $('#xoanhacungcap-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Nút kích hoạt modal
    var productId = button.data('productid'); // Lấy ID sản phẩm từ thuộc tính data-productid

    // Đặt ID sản phẩm vào thuộc tính data-productid của nút Xóa trong modal
    var deleteButton = $(this).find('#confirm-xoa-ncc');
    deleteButton.data('productid', productId);
  });

  // Xử lý khi nhấp vào nút Xóa trong modal
  $('#confirm-xoa-ncc').click(function() {
    console.log("jeje");
    var productId = $(this).data('productid'); // Lấy ID sản phẩm
    // Chuyển hướng đến delete.php với ID sản phẩm
    console.log(productId);
    window.location.href = 'process_xoanhacungcap.php?id=' + productId;
  });
  
});
$(document).ready(function(){
  // Xoa san pham
  $('#xoasanpham-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Nút kích hoạt modal
    var productId = button.data('productid'); // Lấy ID sản phẩm từ thuộc tính data-productid

    // Đặt ID sản phẩm vào thuộc tính data-productid của nút Xóa trong modal
    var deleteButton = $(this).find('#confirm-xoa-sanpham');
    deleteButton.data('productid', productId);
  });

  // Xử lý khi nhấp vào nút Xóa trong modal
  $('#confirm-xoa-sanpham').click(function() {
    console.log("jeje");
    var productId = $(this).data('productid'); // Lấy ID sản phẩm
    // Chuyển hướng đến delete.php với ID sản phẩm
    console.log(productId);
    window.location.href = 'process_xoasanpham.php?id=' + productId;
  });
  
});

// Xoa don hang nhap
$(document).ready(function(){
  $('#xoadonhangnhap-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Nút kích hoạt modal
    var productId = button.data('productid'); // Lấy ID sản phẩm từ thuộc tính data-productid

    var deleteButton = $(this).find('#confirm-xoa-donhangnhap');
    deleteButton.data('productid', productId);
  });
  // Xử lý khi nhấp vào nút Xóa trong modal
  $('#confirm-xoa-donhangnhap').click(function() {
    console.log("jeje");
    var productId = $(this).data('productid');
    console.log(productId);
    window.location.href = 'xoadonhangnhap.php?id=' + productId;
  });
  
});

// Xoa don hang xuat
$(document).ready(function(){
  $('#xoadonhangxuat-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Nút kích hoạt modal
    var productId = button.data('productid'); // Lấy ID sản phẩm từ thuộc tính data-productid

    var deleteButton = $(this).find('#confirm-xoa-donhangxuat');
    deleteButton.data('productid', productId);
  });
  // Xử lý khi nhấp vào nút Xóa trong modal
  $('#confirm-xoa-donhangxuat').click(function() {
    console.log("jeje");
    var productId = $(this).data('productid');
    console.log(productId);
    window.location.href = 'xoadonhangxuat.php?id=' + productId;
  });
  
});





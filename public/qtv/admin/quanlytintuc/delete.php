<?php  
 include __DIR__."/../../../../bootstrap.php";
use ct466\Nhakhoa\Tintuc;
$errors = [];
$tt = new Tintuc($PDO);
if ((isset($_GET['id'])) && ($tt->find($_GET['id'])) !== NULL) {
	// $delete = $product->delete();
    $id =$_GET['id'];
	if ($tt->delete() == null) {
		// echo '<script>alert("Xóa sản phẩm không thành công, sảm phẩm đã tồn tại trong giỏ hàng của khách.");</script>';
		echo '<script>window.location.href= "index.php";</script>';
	} else {
	// echo '<script>alert("Xóa sản phẩm thành công.");</script>';
	echo "<script>window.location.href= 'index.php?id=$id';</script>";}
}
?>
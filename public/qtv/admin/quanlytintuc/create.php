<?php
include __DIR__."/../../../../bootstrap.php";
use ct466\Nhakhoa\TinTuc;

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$newtt = new Tintuc($PDO);
	$newtt->fill($_POST,$_FILES);
	if ($newtt->validate()) {
		$newtt->save(); 
		echo '<script>alert("Thêm tin tức thành công.");</script>';
		echo '<script>window.location.href= "index.php";</script>';
	} $errors = $newtt->getValidationErrors();
	if (isset($errors['txtTieuDe'])) {
        $hinhanh = $_POST['fileToUpload'];
        $noidung = $_POST['txtNoiDung'];
		echo '<script>alert("Tiêu đề không hợp lệ.");</script>';
		echo "<script>window.location.href= 'index.php?fileToUpload=$hinhanh&txtNoiDung=$noidung';</script>";
	}
    if (isset($errors['fileToUpload'])) {
        $tieude = $_POST['txtTieuDe'];
       $noidung = $_POST['txtNoiDung'];
		echo '<script>alert("Ảnh không hợp lệ.");</script>';
		echo "<script>window.location.href= 'index.php?txtTieuDe=$tieude&txtNoiDung=$noidung';</script>";
	}
    if (isset($errors['txtNoiDung'])) {
        $hinhanh = $_POST['fileToUpload'];
        $tieude = $_POST['txtTieuDe'];
		echo '<script>alert("Nội dung không hợp lệ.");</script>';
		echo "<script>window.location.href= 'index.phpfileToUpload=$hinhanh&txtTieuDe=$tieude';</script>";
	}
	
}
?>
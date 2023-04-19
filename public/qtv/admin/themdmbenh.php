<?php
  include __DIR__."/../../../bootstrap.php";
    use ct466\Nhakhoa\Benh;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$newbenh = new Benh($PDO);
	$newbenh->fill($_POST);
	if ($newbenh->validate()) {
		$newbenh->save(); 
		echo '<script>alert("Thêm danh mục bệnh thành công.");</script>';
		echo '<script>window.location.href= "ql_benh.php";</script>';
	} $errors = $newbenh->getValidationErrors();
	if (isset($errors['tenbenh'])) {
        $mota = $_POST['mota'];
        $dongia = $_POST['dongia'];
        $thuocdinhkem = $_POST['thuocdinhkem'];
		echo '<script>alert("Tên danh mục bệnh không hợp lệ.");</script>';
		echo "<script>window.location.href= 'ql_benh.php?mota=$mota&dongia=$dongia&thuocdinhkem=$thuocdinhkem';</script>";
	}
    if (isset($errors['mota'])) {
        $tenbenh = $_POST['tenbenh'];
        $dongia = $_POST['dongia'];
        $thuocdinhkem = $_POST['thuocdinhkem'];
		echo '<script>alert("Mô tả không hợp lệ.");</script>';
		echo "<script>window.location.href= 'ql_benh.php?tenbenh=$tenbenh&dongia=$dongia&thuocdinhkem=$thuocdinhkem';</script>";
	}
    if (isset($errors['dongia'])) {
        $mota = $_POST['mota'];
        $tenbenh = $_POST['tenbenh'];
        $thuocdinhkem = $_POST['thuocdinhkem'];
		echo '<script>alert("Đơn giá không hợp lệ.");</script>';
		echo "<script>window.location.href= 'ql_benh.php?mota=$mota&tenbenh=$tenbenh&thuocdinhkem=$thuocdinhkem';</script>";
	}
    if (isset($errors['thuocdinhkem'])) {
        $mota = $_POST['mota'];
        $tenbenh = $_POST['tenbenh'];
        $dongia = $_POST['dongia'];
		echo '<script>alert("Thuốc đính kèm không hợp lệ.");</script>';
		echo "<script>window.location.href= 'ql_benh.php?mota=$mota&tenbenh=$tenbenh&dongia=$dongia';</script>";
	}
	
}
?>
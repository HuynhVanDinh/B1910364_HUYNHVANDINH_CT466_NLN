<?php  
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\Phieukham;
$phieukham = new Phieukham($PDO);
$errors = [];
if ((isset($_GET['id'])) && ($phieukham->find($_GET['id'])) !== NULL) {
    $phieukham->delete();
    echo '<script>alert("Xoá phiếu khám thành công.");</script>';
    echo "<script>window.location.href= 'lapphieukham.php';</script>";
}
?>
<?php  
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\Lichhen;
$lichhen = new Lichhen($PDO);
$errors = [];
if ((isset($_GET['id'])) && ($lichhen->find($_GET['id'])) !== NULL) {
    $lichhen->delete();
    echo '<script>alert("Xoá lịch hẹn thành công.");</script>';
    echo "<script>window.location.href= 'ql_lichhen.php';</script>";
}
?>
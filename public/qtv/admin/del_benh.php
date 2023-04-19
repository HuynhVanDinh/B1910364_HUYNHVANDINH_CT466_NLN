<?php  
include __DIR__."/../../../bootstrap.php";


use ct466\Nhakhoa\Benh;

$benh = new Benh($PDO);
$errors = [];
if ((isset($_GET['id'])) && ($benh->find($_GET['id'])) !== NULL) {
    if($benh->validateToDelete() == true){
        $benh->delete();
        echo '<script>alert("Xóa danh mục thành công.");</script>';
        echo "<script>window.location.href= 'ql_benh.php';</script>";
    } else {
        echo '<script>alert("Danh mục tồn tại trong phiếu khám! Không thể xóa");</script>';
        echo "<script>window.location.href= 'ql_benh.php';</script>";
    }
}
?>
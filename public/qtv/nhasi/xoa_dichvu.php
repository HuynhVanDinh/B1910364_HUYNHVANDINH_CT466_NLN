<?php
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Phieukham;

$phieukham = new Phieukham($PDO);
$id_phieukham = $_GET['id_phieukham'];
$id_benhnhan = $_GET['id_benhnhan'];
if ($phieukham->find_id($_GET['id_phieukham'],$_GET['id_benh']) != null) {
    $xoa_dichvu = $phieukham->delete_detail();
    echo "<script>alert('Đã xóa dịch vụ.');</script>";
    echo "<script>window.location.href = 'dieutri.php?id=$id_benhnhan&id_pk=$id_phieukham'</script>";
} else {
    echo "<script>alert('Không thể xoá dịch vụ.');</script>";
    echo "<script>window.location.href = 'dieutri.php?id=$id_benhnhan&id_pk=$id_phieukham'</script>";
}

?>
<?php  
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Bienlai;
use ct466\Nhakhoa\Phieukham;

$bienlai = new Bienlai($PDO);
$phieukham = new Phieukham($PDO);
$tim_phieukham = $phieukham->find_pk_mapk($_GET['ma_pk']);
$id_phieukham = $_GET['ma_pk'];
$id_benhnhan = $tim_phieukham->id_benhnhan;
$tim_bienlai_ctt = $bienlai->find_bienlai_ctt($id_benhnhan);
$array = [];
$array['id_benhnhan'] = $tim_phieukham->id_benhnhan;
$array['ma_pk'] = $tim_phieukham->getMaPK();
$array['tinhtrang'] = 0;
$array['tongtien'] = 0;
// var_dump($tim_bienlai_ctt);
if ($tim_bienlai_ctt == null){
	if ($tim_phieukham != null) {
		$taobienlai = $bienlai->them_bienlai($array);
	}
	if ($taobienlai) {
		echo '<script>alert("Tạo biên lai thành công.");</script>';
		echo '<script>window.location.href= "ls_kham.php";</script>';
	}
} else {
	echo '<script>alert("Cảnh báo!!! Tồn lại hoá đơn chưa thanh toán. Vui lòng thanh toán trước khi lập biên lai");</script>';
	echo "<script>window.location.href= 'dieutri.php?id=$id_benhnhan&id_pk=$id_phieukham';</script>";
}
?>
<?php
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Benh;
use ct466\Nhakhoa\Nhasi;
use ct466\Nhakhoa\Lichhen;
use ct466\Nhakhoa\Nhanvien;
use ct466\Nhakhoa\Phieukham;

$phieukham = new Phieukham($PDO);
$lichhen = new Lichhen($PDO);
$nhasi = new Nhasi($PDO);
$benhnhan = new Benhnhan($PDO);
$benh = new Benh($PDO);
$nhanvien = new Nhanvien($PDO);

$ct_benh = $benh->find($_POST['dichvu']);
$id_benhnhan = $_POST['id_benhnhan'];
$id_phieukham = $_POST['id_phieukham'];
$kt_phieukham = $phieukham->kt_phieukham($id_benhnhan,$ct_benh->getId(),$id_phieukham);

// var_dump($kt_phieukham);
if (isset($kt_phieukham) && $kt_phieukham != null) {
	if ($kt_phieukham->id_benh == $_POST['dichvu']) {
		$newVal = ($_POST['soluong']+$kt_phieukham->soluong);
		$array1 = [];
		$array1['id_phieukham'] = $_POST['id_phieukham'];
		$array1['soluong'] = $newVal;
		$array1['id_benh'] = $_POST['dichvu'];
		$update_phieukham = $phieukham->update_phieukham($array1);
    	echo "<script>alert('Dịch vụ đã có trong hoá đơn,đã cập nhật số lượng.');</script>";
    	echo "<script>window.location.href = 'dieutri.php?id=$id_benhnhan&id_pk=$id_phieukham'</script>";
	} else {
		$array2 = [];
		$array2['id_phieukham'] = $_POST['id_phieukham'];
		$array2['soluong'] = $_POST['soluong'];
		$array2['id_benh'] = $_POST['dichvu'];
		$kq=$phieukham->fill2($array2);
		$them_phieukham = $kq->them_dv();
    	echo "<script>alert('Đã thêm dịch vụ vào hoá đơn!!!');</script>";
    	echo "<script>window.location.href = 'dieutri.php?id=$id_benhnhan&id_pk=$id_phieukham'</script>";
	}
}else {
		$array3 = [];
		$array3['id_phieukham'] = $_POST['id_phieukham'];
		$array3['soluong'] = $_POST['soluong'];
		$array3['id_benh'] = $_POST['dichvu'];
        $kq=$phieukham->fill2($array3);
		$them_phieukham = $kq->them_dv();
        // var_dump($them_phieukham);
        if($them_phieukham){
            echo "<script>alert('Đã thêm dịch vụ vào hoá đơn!');</script>";
    	    echo "<script>window.location.href = 'dieutri.php?id=$id_benhnhan&id_pk=$id_phieukham'</script>";
        }
    
	}

?>
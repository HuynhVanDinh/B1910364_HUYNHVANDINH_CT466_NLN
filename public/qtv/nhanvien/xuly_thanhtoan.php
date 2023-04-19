<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\Bienlai;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Nhanvien;
use ct466\Nhakhoa\Phieukham;

$bienlai = new Bienlai($PDO);
$biennhan = new Benhnhan($PDO);
$nhanvien = new Nhanvien($PDO);
$phieukham = new Phieukham($PDO);

$id_benhnhan = $_GET['id_benhnhan'];
$nhanvien->findUser($_SESSION['id_user']);
$id_nhanvien = $nhanvien->getMaNV();
$array = [];
$array['ma_bl'] = $_GET['ma_bl'];
$array['id_nhanvien'] = $id_nhanvien;
$bienlai->fill($array);
$phieukham->update_phieukham_dtt($array);
$bienlai->save();
echo '<script>alert("Thanh toán thành công.");</script>';
echo "<script>window.location.href= 'thanhtoan.php';</script>";
?>
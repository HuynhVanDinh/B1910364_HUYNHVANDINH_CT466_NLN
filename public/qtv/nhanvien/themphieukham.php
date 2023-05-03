<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Nhasi;
use ct466\Nhakhoa\Lichhen;
use ct466\Nhakhoa\Nhanvien;
use ct466\Nhakhoa\Phieukham;

$phieukham = new Phieukham($PDO);
$lichhen = new Lichhen($PDO);
$nhasi = new Nhasi($PDO);
$benhnhan = new Benhnhan($PDO);
$nhanvien = new Nhanvien($PDO);

$nha_si = $nhasi->all($PDO);
$benh_nhan = $benhnhan->all();
$ID_lichhen = isset($_REQUEST['id_lh']) ? filter_var($_REQUEST['id_lh'], FILTER_SANITIZE_NUMBER_INT) : -1;
$lichhen = $lichhen->find($ID_lichhen);
$id_benhnhan = $lichhen->id_benhnhan;
$bn = $benhnhan->find($id_benhnhan);
$nhanvien->findUser($_SESSION['id_user']);
$id_nhanvien = $nhanvien->getMaNV();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include __DIR__."/../partials/header.php";
    ?>
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    <style>
    .logo {
        border-radius: 50%;
    }
    </style>
</head>

<body>
    <div class="">
        <div class="navigation">
            <ul>
                <li>
                    <a href="../index.php">
                        <span class="icon">
                            <div>
                                <img class="crounded-circle logo" src="../../../img/winsmile.jpg" alt="" height="50">
                            </div>
                        </span>
                        <span class="title">Win smile</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="ql_lichhen.php">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý lịch hẹn</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Lập phiếu khám</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Thanh toán</span>
                    </a>
                </li>

                <li>
                    <a href="thongke.php">
                        <span class="icon">
                            <ion-icon name="bar-chart-outline"></ion-icon>
                        </span>
                        <span class="title">Thống kê</span>
                    </a>
                </li>
                <?php if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {unset($_SESSION['id_user']); } ?>
                <li>
                    <a href="../../index.php?dangxuat=1">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="alert alert-primary topbar" role="alert">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <img src="../../img/nure.png" alt="">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php if (isset($_POST['submit'])): ?>
                    <?php
                        $noidung = $_POST['noidung'];
                        $id_benhnhan = $_POST['id_benhnhan'];
                        $id_nhasi = $_POST['id_nhasi'];
                        $id_nhanvien = $_POST['id_nhanvien'];
                        $ngayhen = $_POST['ngayhen'];
                        if($phieukham->tim_benhnhan($_POST['id_benhnhan']) == NULL){
                            $lichhen->nhankham();
                            $phieukham->tao_phieukham($_POST,$id_nhanvien);
                            echo '<script>alert("Tạo phiếu khám thành công !!!.");</script>';
                            echo '<script>window.location.href= "lapphieukham.php";</script>';
                            
                        }else{
                            $lichhen->nhankham();
                            $phieukham->lay_phieukham($_POST,$id_nhanvien);
                            echo '<script>alert("Cập nhật phiếu khám mới nhất!!!.");</script>';
                            echo '<script>window.location.href= "lapphieukham.php";</script>';
                        }
                    ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-center mt-3">Lập phiếu khám cho bệnh nhân</h1>
                        </div>
                    </div>
                    <table class="table table-bordered bg-while shadow ">
                        <form method="POST" class="mt-3">
                            <div class="form-group">
                                <label for="hoten">Tên bệnh nhân</label>
                                <?php if(isset($_REQUEST['id_lh'])):?>
                                <input hidden type="text" name="id_nhanvien"
                                    value="<?=htmlspecialchars($id_nhanvien) ?>">
                                <input hidden type="text" name="id_benhnhan"
                                    value="<?=htmlspecialchars($id_benhnhan) ?>">
                                <input type="text" name="hoten" id="hoten" class="form-control"
                                    value="<?=htmlspecialchars($bn->hoten)?>" disabled>
                                <?php endif;?>
                                <?php if(!isset($_REQUEST['id_lh'])):?>
                                <input hidden type="text" name="id_benhnhan"
                                    value="<?=htmlspecialchars($benhnhan->getMaBN())?>">
                                <select name="id_benhnhan" id="id_benhnhan" class=" form-control w-100">
                                    <option value="" hidden> -- ; --</option>
                                    <?php foreach($benh_nhan as $benhnhan): ?>
                                    <option value="<?=htmlspecialchars($benhnhan->getMaBN())?>">
                                        <?=htmlspecialchars($benhnhan->hoten)?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php endif;?>
                            </div>
                            <div class="form-group">
                                <label for="nhasi">Tên nha sĩ</label>
                                <input hidden type="text" name="id_nhasi"
                                    value="<?=htmlspecialchars($lichhen->id_nhasi)?>">
                                <select disabled name="id_nhasi" id="id_nhasi" class=" form-control w-100">
                                    <option value="" hidden> -- ; --</option>
                                    <?php foreach($nha_si as $nhasi): ?>
                                    <option value="<?=htmlspecialchars($nhasi->getMaNS())?>"
                                        <?= ($nhasi->getMaNS() == $lichhen->id_nhasi) ? 'selected' : '' ?>>
                                        <?=htmlspecialchars($nhasi->tenns)?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ngayhen">Ngày hẹn khám</label>
                                <input hidden class="form-control" type="text" name="ngayhen" id="ngayhen"
                                    value="<?=htmlspecialchars($lichhen->ngayhen)?>">
                                <input disabled class="form-control" type="text" name="ngayhen" id="ngayhen"
                                    value="<?=htmlspecialchars($lichhen->ngayhen)?>">
                            </div>
                            <div class="form-group">
                                <label for="noidung">Nội dung</label>
                                <textarea name="noidung" id="noidung" rows="5" class="form-control"
                                    required><?= htmlspecialchars($lichhen->ghichu) ?></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary ml-2 float-right active">Lập
                                phiếu
                                khám</button>
                            <a href="lapphieukham.php" class="btn btn-secondary float-right">Hủy</a>
                        </form>
                    </table>
                </div>
            </div>
        </div>
        <script src="../admin/assets/js/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
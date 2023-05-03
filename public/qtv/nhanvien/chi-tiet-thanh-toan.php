<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\Phieukham;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Benh;
use ct466\Nhakhoa\Bienlai;

$phieukham = new Phieukham($PDO);
$biennhan = new Benhnhan($PDO);
$benh = new Benh($PDO);
$bienlai = new Bienlai($PDO);

$id_benhnhan = $_GET['id'];
$dm_phieukham = $phieukham->all_dtt($_GET['ma_bl']);
$dm_phieukham_ctt = $phieukham->bl_ctt();
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
                    <a href="lapphieukham.php">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Lập phiếu khám</span>
                    </a>
                </li>

                <li>
                    <a href="thanhtoan.php">
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
            <div class="recentCustomers">
                <div id="table">
                    <div class="cardHeader">
                        <h2>Hoá đơn của bệnh nhân (
                            <?php 
                        echo htmlspecialchars($biennhan->find($_GET['id'])->hoten)
                        ?> )
                        </h2>
                    </div>
                    <?php
                    // var_dump($dm_phieukham);
                    if($phieukham->tim_mabl($_GET['ma_bl'])){
                    ?>
                    <table id="thanhtoan" class="table table-bordered table-striped text-center mt-2">
                        <thead class="text-center">
                            <tr>
                                <th>STT</th>
                                <th>Dịch vụ</th>
                                <th>Thuốc</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                $n = 1;
                                foreach ($dm_phieukham as $phieukham) :
                                    if ($phieukham->id_benhnhan == $id_benhnhan) {
                                        // var_dump($phieukham->id_benhnhan == $id_benhnhan);
                                ?>
                            <tr>
                                <td><?php echo $n;
									$n++; ?></td>
                                <td>
                                    <?php $dichvu = $benh->find($phieukham->id_benh);echo $dichvu->tenbenh; ?>
                                </td>
                                <td>
                                    <?php echo $dichvu->thuocdinhkem; ?>
                                </td>
                                <td>
                                    <?php echo $phieukham->soluong; ?>
                                </td>
                                <td>
                                    <?php echo $dichvu->dongia;?>
                                    <sup> vnđ</sup>
                                </td>
                                <td>
                                    <?php echo $dichvu->dongia * $phieukham->soluong; ?>
                                    <sup> vnđ</sup>
                                </td>
                                <td>
                                    <?php
                                    $bl = $bienlai->find($_GET['ma_bl']);
                                    ?>
                                    <?php if($bl->tinhtrang == 0){ ?>
                                    <p class="text-danger">Chưa thanh toán</p>
                                    <?php }
                                    else{?>
                                    <p class="text-success">Đã thanh toán</p>
                                    <?php }?>
                                </td>
                            </tr>

                            <?php }endforeach ?>
                    </table>
                    <?php
                    }else {?>
                    <table id="thanhtoan" class="table table-bordered table-striped text-center mt-2">
                        <thead class="text-center">
                            <tr>
                                <th>STT</th>
                                <th>Dịch vụ</th>
                                <th>Thuốc</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                $n = 1;
                                foreach ($dm_phieukham_ctt as $phieukham) :
                                    if ($phieukham->id_benhnhan == $id_benhnhan) {
                                        // var_dump($phieukham->id_benhnhan == $id_benhnhan);
                                ?>
                            <tr>
                                <td><?php echo $n;
									$n++; ?></td>
                                <td>
                                    <?php $dichvu = $benh->find($phieukham->id_benh);echo $dichvu->tenbenh; ?>
                                </td>
                                <td>
                                    <?php echo $dichvu->thuocdinhkem; ?>
                                </td>
                                <td>
                                    <?php echo $phieukham->soluong; ?>
                                </td>
                                <td>
                                    <?php echo $dichvu->dongia;?>
                                    <sup> vnđ</sup>
                                </td>
                                <td>
                                    <?php echo $dichvu->dongia * $phieukham->soluong; ?>
                                    <sup> vnđ</sup>
                                </td>
                                <td>
                                    <?php
                                    $bl = $bienlai->find($_GET['ma_bl']);
                                    ?>
                                    <?php if($bl->tinhtrang == 0){ ?>
                                    <p class="text-danger">Chưa thanh toán</p>
                                    <?php }
                                    else{?>
                                    <p class="text-success">Đã thanh toán</p>
                                    <?php }?>
                                </td>
                            </tr>

                            <?php }endforeach ?>
                    </table>
                    <?php }
                    ?>
                    <div class="float-right mt-3">
                        <form action="xuly_thanhtoan.php" method="GET">
                            <input hidden type="text" name="id_benhnhan" id="id_benhnhan"
                                value="<?php echo $id_benhnhan?>">
                            <input hidden type="text" name="ma_bl" id="ma_bl" value="<?php echo $_GET['ma_bl']?>">
                            <?php
                                $bl = $bienlai->find($_GET['ma_bl']);
                            ?>
                            <?php if($bl->tinhtrang == 0){ ?>
                            <button type="submit" name="submit" class="btn btn-primary ml-2 float-right active">Xác nhận
                                thanh toán</button>
                            <?php }
                            else{?>
                            <button disabled type="submit" name="submit"
                                class="btn btn-primary ml-2 float-right active">Đã
                                thanh toán</button>
                            <?php }?>
                        </form>
                    </div>

                </div>
            </div>
            <script src="assets/js/main.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
            <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>
            <script>
            $(document).ready(function() {
                $('#thanhtoan').DataTable({
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
                    },
                });
            });
            </script>

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
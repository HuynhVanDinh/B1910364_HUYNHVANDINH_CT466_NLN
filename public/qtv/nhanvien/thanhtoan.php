<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\Bienlai;
use ct466\Nhakhoa\Benhnhan;

$bienlai = new Bienlai($PDO);
$biennhan = new Benhnhan($PDO);

$dm_bienlai = $bienlai->bienlai_dtt();

$dm_bienlai_ctt = $bienlai->bienlai_ctt();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include __DIR__."/../partials/header.php";
    ?>
    <link rel="stylesheet" href="../admin/assets/css/style.css">
</head>

<body>
    <div class="">
        <div class="navigation">
            <ul>
                <li>
                    <a href="../index.php">
                        <span class="icon">
                            <div>
                                <img class="crounded-circle" src="../../../img/winsmile.jpg" alt="" height="50">
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
                            <ion-icon name="lock-closed-outline"></ion-icon>
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
                        <h2>Danh sách các hoá đơn chưa thanh toán</h2>
                    </div>
                    <table id="thanhtoan" class="table table-bordered table-striped text-center">
                        <thead class="text-center">
                            <tr>
                                <th>Mã hoá đơn</th>
                                <th>Mã bệnh nhân</th>
                                <th>Tên bệnh nhân</th>
                                <th>Tuổi</th>
                                <th>Ngày khám</th>
                                <th>Chi phí</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dm_bienlai as $bienlai) :
                            $ID_bienlai = $bienlai->getMaBl();
                            $bn = $biennhan->find($bienlai->id_benhnhan);
                            $nam_hien_tai = date('Y');
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($ID_bienlai) ?></td>
                                <td><?= htmlspecialchars($bienlai->id_benhnhan) ?></td>
                                <td><?= htmlspecialchars($bn->hoten) ?></td>
                                <td><?= htmlspecialchars($nam_hien_tai-$bn->namsinh) ?></td>
                                <td><?= htmlspecialchars($bienlai->ngaythu) ?></td>
                                <td><?= htmlspecialchars($bienlai->tongtien) ?></td>
                                <td>
                                    <a
                                        href="chi-tiet-thanh-toan.php?id=<?php echo htmlspecialchars($bienlai->id_benhnhan);?>&ma_bl=<?php echo htmlspecialchars($bienlai->getMaBl());?>">Xem
                                        chi tiết</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                    </table>
                </div>
            </div>
            <div class="recentCustomers">
                <div id="table">
                    <div class="cardHeader">
                        <h2>Danh sách các hoá đơn đã thanh toán</h2>
                    </div>
                    <table id="bienlai" class="table table-bordered table-striped text-center">
                        <thead class="text-center">
                            <tr>
                                <th>Mã hoá đơn</th>
                                <th>Mã bệnh nhân</th>
                                <th>Tên bệnh nhân</th>
                                <th>Tuổi</th>
                                <th>Ngày khám</th>
                                <th>Chi phí</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dm_bienlai_ctt as $bienlai) :
                            $ID_bienlai = $bienlai->getMaBl();
                            $bn = $biennhan->find($bienlai->id_benhnhan);
                            $nam_hien_tai = date('Y');
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($ID_bienlai) ?></td>
                                <td><?= htmlspecialchars($bienlai->id_benhnhan) ?></td>
                                <td><?= htmlspecialchars($bn->hoten) ?></td>
                                <td><?= htmlspecialchars($nam_hien_tai-$bn->namsinh) ?></td>
                                <td><?= htmlspecialchars($bienlai->ngaythu) ?></td>
                                <td><?= htmlspecialchars($bienlai->tongtien) ?></td>
                                <td>
                                    <a
                                        href="chi-tiet-thanh-toan.php?id=<?php echo htmlspecialchars($bienlai->id_benhnhan);?>&ma_bl=<?php echo htmlspecialchars($bienlai->getMaBl());?>">Xem
                                        chi tiết</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>

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
        <script>
        $(document).ready(function() {
            $('#thanhtoan').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
                },
            });
            $('#bienlai').DataTable({
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
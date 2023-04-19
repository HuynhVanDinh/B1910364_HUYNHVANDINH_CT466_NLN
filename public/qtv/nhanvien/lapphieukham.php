<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Nhanvien;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Lichhen;
use ct466\Nhakhoa\Phieukham;

$phieukham = new Phieukham($PDO);
$lichhen = new Lichhen($PDO);
$nhanvien = new Nhanvien($PDO);
$benhnhan = new Benhnhan($PDO);
$user = new User($PDO);

$ds_phieukham = $phieukham->phieukham_dl($PDO);
$ds_lichhen_dxn = $lichhen->lichhen_dxn($PDO);
$benh_nhan = $benhnhan->all();
$ID_nhanvien = $nhanvien->getMaNV();
$user->find($nhanvien->user_id);
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
                        <h2>Danh sách các lịch hẹn đã xác nhận</h2>
                    </div>
                    <table id="benhnhan_dxn" class="table table-bordered table-striped text-center">
                        <thead class="text-center">
                            <tr>
                                <th>Mã hẹn</th>
                                <th>Tên bệnh nhân</th>
                                <th>Địa chỉ</th>
                                <th>Điện thoại</th>
                                <th>CCCD/CMND</th>
                                <th>Ngày hẹn</th>
                                <th>Giờ hẹn</th>
                                <th>Ghi chú</th>
                                <th>Mã nha sĩ</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ds_lichhen_dxn as $lichhen) :
                            $ID_lichhen = $lichhen->getMaLH();
                            $benhnhan->find($lichhen->id_benhnhan);?>
                            <tr>
                                <td><?= htmlspecialchars($ID_lichhen) ?></td>
                                <td><?= htmlspecialchars($benhnhan->hoten) ?></td>
                                <td><?= htmlspecialchars($benhnhan->diachi) ?></td>
                                <td><?= htmlspecialchars($benhnhan->sdt) ?></td>
                                <td><?= htmlspecialchars($benhnhan->cmnd) ?></td>
                                <td><?= htmlspecialchars($lichhen->ngayhen) ?></td>
                                <td><?= htmlspecialchars($lichhen->giohen) ?></td>
                                <td><?= htmlspecialchars($lichhen->ghichu) ?></td>
                                <td><?= htmlspecialchars($lichhen->id_nhasi) ?></td>
                                <td>
                                    <a id="lapphieukham" class="btn btn-sm btn-warning"
                                        href="themphieukham.php?id_lh=<?php echo $ID_lichhen?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true">Lập phiếu khám</i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <hr>
            <div class="recentCustomers">
                <div id="table">
                    <div class="cardHeader">
                        <h2>Danh sách các phiếu khám đã lập</h2>
                    </div>
                    <table id="phieukham" class="table table-bordered table-striped text-center">
                        <thead class="text-center">
                            <tr>
                                <th>Mã phiếu khám</th>
                                <th>Mã bệnh nhân</th>
                                <th>Mã nha sĩ</th>
                                <th>Mã nhân viên</th>
                                <th>Ngày khám</th>
                                <th>Nội dung khám</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ds_phieukham as $phieukham) :
                            $ID_phieukham = $phieukham->getMaPK();
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($ID_phieukham) ?></td>
                                <td><?= htmlspecialchars($phieukham->id_benhnhan) ?></td>
                                <td><?= htmlspecialchars($phieukham->id_nhasi) ?></td>
                                <td><?= htmlspecialchars($phieukham->id_nhanvien) ?></td>
                                <td><?= htmlspecialchars($phieukham->ngaykham) ?></td>
                                <td><?= htmlspecialchars($phieukham->noidung) ?></td>
                                <td>
                                    <a id="xoaphieukham" class="btn btn-sm btn-danger"
                                        href="xoaphieukham.php?id=<?php echo $ID_phieukham?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true">Xoá phiếu khám</i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </table>
                </div>
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
        $('#benhnhan_dxn').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
            },
        });
        $('#phieukham').DataTable({
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
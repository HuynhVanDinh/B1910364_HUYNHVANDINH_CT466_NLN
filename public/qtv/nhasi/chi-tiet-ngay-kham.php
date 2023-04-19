<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Nhasi;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Phieukham;

$phieukham = new Phieukham($PDO);
$nhasi = new Nhasi($PDO);
$benhnhan = new Benhnhan($PDO);
$user = new User($PDO);

$user_nhasi=$nhasi->findUser($_SESSION["id_user"]);
$id_nhasi=$user_nhasi->getMaNS();
$day = isset($_REQUEST['ngaykham']) ? filter_var($_REQUEST['ngaykham'], FILTER_SANITIZE_NUMBER_INT) : -1;
$ngaykham = $phieukham->LichKhamTrongNgay($id_nhasi,$day);
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
                    <a href="ls_kham.php">
                        <span class="icon">
                            <ion-icon name="time-outline"></ion-icon>
                        </span>
                        <span class="title">Lịch sử khám</span>
                    </a>
                </li>

                <li>
                    <a href="timbenhnhan.php">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                        </span>
                        <span class="title">Tìm bệnh nhân</span>
                    </a>
                </li>

                <li>
                    <a href="tt_canhan.php">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Thông tin cá nhân</span>
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
                        <h2>Lịch khám ngày <?php echo $day ?></h2>
                    </div>
                    <table id="lichkhamngay" class="table table-bordered table-striped text-center">
                        <thead class="text-center">
                            <tr>
                                <th>Ngày khám</th>
                                <th>Giờ tiếp nhận</th>
                                <th>Bệnh nhân</th>
                                <th>Nội dung</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ngaykham as $obj) { 
                        $bn = $benhnhan->find($obj->id_benhnhan);
                    ?>
                            <tr>
                                <td><?php echo $obj->ngaykham; ?></td>
                                <td><?php echo $obj->gionhan; ?></td>
                                <td><?php echo $bn->hoten; ?></td>
                                <td><?php echo $obj->noidung; ?></td>
                                <td>
                                    <a id="dieutri" class="btn btn-sm btn-info"
                                        href="dieutri.php?id=<?php echo $bn->getMaBN(); ?>&id_pk=<?php echo $obj->getMaPK(); ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true">Điều trị</i></a>
                                </td>
                            </tr>
                            <?php } ?>
                    </table>
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
                $('#lichkhamngay').DataTable({
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
<?php
session_start();
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Benhnhan;
$benhnhan = new Benhnhan($PDO);

$benh_nhan = $benhnhan->all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css" />
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
            <!-- <div class="recentCustomers"> -->
            <div class="recentCustomers">
                <div id="table">
                    <div class="cardHeader">
                        <h2>Danh sách các bệnh nhân</h2>
                    </div>
                    <table id="benhnhan" class="table table-bordered table-striped text-center">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Tên bệnh nhân</th>
                                <th>Giới tính</th>
                                <th>Năm sinh</th>
                                <th>Địa chỉ</th>
                                <th>Điện thoại</th>
                                <th>CCCD/CMND</th>
                                <th>Tài khoản</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($benh_nhan as $benhnhan) :
                            $ID_benhnhan = $benhnhan->getMaBN();
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($ID_benhnhan) ?></td>
                                <td><?= htmlspecialchars($benhnhan->hoten) ?></td>
                                <td><?= htmlspecialchars($benhnhan->gioitinh) ?></td>
                                <td><?= htmlspecialchars($benhnhan->namsinh) ?></td>
                                <td><?= htmlspecialchars($benhnhan->diachi) ?></td>
                                <td><?= htmlspecialchars($benhnhan->sdt) ?></td>
                                <td><?= htmlspecialchars($benhnhan->cmnd) ?></td>
                                <td><?= htmlspecialchars($benhnhan->tk_dangnhap) ?></td>
                            </tr>
                            <?php endforeach; ?>

                    </table>
                </div>

            </div>
            <!-- </div> -->



        </div>
        <script src="script.js"></script>
        <script src="../admin/assets/js/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>
        <script>
        $(document).ready(function() {
            $('#benhnhan').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
                },
            });
        });
        </script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js">
        </script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
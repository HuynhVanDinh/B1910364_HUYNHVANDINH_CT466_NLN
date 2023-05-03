<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Nhasi;
// use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Phieukham;

$phieukham = new Phieukham($PDO);
$nhasi = new Nhasi($PDO);
// $benhnhan = new Benhnhan($PDO);
$user = new User($PDO);

$user_nhasi=$nhasi->findUser($_SESSION["id_user"]);
$id_nhasi=$user_nhasi->getMaNS();
$ngaykham = $phieukham->getDistinctNgayKham($id_nhasi);
$ngaykham_json = json_encode($ngaykham);
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
                <div class="row">
                    <div class="col-lg-5">
                        <div class="cardHeader">
                            <h2>Lịch khám nha sĩ</h2>
                        </div>
                        <div class="calendar">
                            <div class="month">
                                <i class="fas fa-angle-left prev"></i>
                                <div class="date">
                                    <h1></h1>
                                    <p></p>
                                </div>
                                <i class="fas fa-angle-right next"></i>
                            </div>
                            <div class="weekdays">
                                <div>CN</div>
                                <div>T2</div>
                                <div>T3</div>
                                <div>T4</div>
                                <div>T5</div>
                                <div>T6</div>
                                <div>T7</div>
                            </div>
                            <div class="days"></div>
                            <p class="text-danger text-center">***Các ngày được tô đỏ có lịch khám***</p>
                        </div>
                        <div id="ngaykham" data-ngaykham='<?php echo $ngaykham_json; ?>'></div>

                    </div>
                    <div class="col-lg-7 col-sm-12 mt-5">
                        <table id="lichkham" class="table table-bordered table-striped text-center">
                            <thead class="text-center">
                                <tr>
                                    <th>Ngày khám</th>
                                    <th>Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                for ($i = 0; $i < count($ngaykham); $i++) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($ngaykham[$i]) . "</td>";
                                echo "<td><a href=\"chi-tiet-ngay-kham.php?ngaykham=" . urlencode($ngaykham[$i]) . "\">Xem chi tiết</a></td>";
                                echo "</tr>";
                                }
                            ?>
                        </table>
                    </div>
                </div>



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
                $('#benhnhan_dxn').DataTable({
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
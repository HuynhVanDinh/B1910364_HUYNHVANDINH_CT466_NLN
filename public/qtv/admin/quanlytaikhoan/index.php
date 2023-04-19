<?php
include __DIR__."/../../../../bootstrap.php";


use ct466\Nhakhoa\Benhnhan;
$benhnhan = new Benhnhan($PDO);

$benh_nhan = $benhnhan->all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include __DIR__."/../../partials/header.php";
    ?>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    .logo {
        border-radius: 50%;
    }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
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
                    <a href="../index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Trang chủ</span>
                    </a>
                </li>

                <li>
                    <a href="../ql_nhasi.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý nha sĩ</span>
                    </a>
                </li>

                <li>
                    <a href="../ql_nhanvien.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý nhân viên</span>
                    </a>
                </li>

                <li>
                    <a href="../ql_benhnhan.php">
                        <span class="icon">
                            <ion-icon name="man-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý bệnh nhân</span>
                    </a>
                </li>

                <li>
                    <a href="../ql_benh.php">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý danh mục bệnh</span>
                    </a>
                </li>

                <li>
                    <a href="../quanlytintuc/">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý tin tức</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý tài khoản</span>
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

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="alert alert-primary topbar" role="alert">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <img src="../assets/imgs/admin.jpg" alt="">
                </div>
            </div>
            <!-- ================================= -->
            <div class="recentCustomers">
                <div id="table">
                    <div class="cardHeader">
                        <h2>Quản lý tài khoản</h2>
                        <a href="index.php" class="btn mb-3 mr-2">Bệnh nhân</a>
                        <a href="tk_nhanvien.php" class="btn mb-3 mr-2">Nhân viên</a>
                        <a href="tk_nhasi.php" class="btn mb-3">Nha sĩ</a>
                    </div>
                    <table id="benhnhan" class="table table-bordered table-striped text-center">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Tên bệnh nhân</th>
                                <th>Tài khoản</th>
                                <th>Ngày tạo</th>
                                <th>Tùy Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($benh_nhan as $benhnhan) :
                            $ID_benhnhan = $benhnhan->getMaBN();
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($ID_benhnhan) ?></td>
                                <td><?= htmlspecialchars($benhnhan->hoten) ?></td>
                                <td><?= htmlspecialchars($benhnhan->tk_dangnhap) ?></td>
                                <td><?= htmlspecialchars($benhnhan->created_day) ?></td>
                                <td>
                                    <?php
                                if($benhnhan->trangthai == 1){
                                ?>
                                    <form method="get" action="bn_khoa.php" enctype="multipart/form-data">
                                        <input hidden type="text" name="user_id" value="<?php echo $ID_benhnhan; ?>">
                                        <button class=" btn w-100" type="submit"><a class="btn btn-sm btn-danger" ?><i
                                                    class="fa fa-lock" aria-hidden="true">Khoá tài
                                                    khoản</i></a></button>
                                    </form>
                                    <?php }elseif($benhnhan->trangthai == 0){ ?>
                                    <form method="get" action="bn_mo.php" enctype="multipart/form-data">
                                        <input hidden type="text" name="user_id" value="<?php echo $ID_benhnhan; ?>">
                                        <button class=" btn w-100" type="submit"><a class="btn btn-sm btn-success" ?><i
                                                    class="fa fa-unlock" aria-hidden="true">Mở khoá</i></a></button>
                                    </form>
                                    <?php
                                }
                                ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
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
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
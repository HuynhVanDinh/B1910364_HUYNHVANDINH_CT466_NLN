<?php 
include __DIR__."/../../../../bootstrap.php";

use ct466\Nhakhoa\TinTuc;

$tt = new Tintuc($PDO);
$arrtt = $tt->all();

$id = isset($_REQUEST['id']) ?
  filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
if ($id < 0 || !($tt->find($id))) {
  redirect(BASE_URL_PATH);
}
?>
<?PHP
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($tt->update($_POST, $_FILES)) {
    // Cập nhật dữ liệu thành công
    echo '<script>alert("Cập nhật sản phẩm thành công");</script>';
    echo '<script>window.location.href= "index.php?";</script>';
  }
  // Cập nhật dữ liệu không thành công
  $errors = $tt->getValidationErrors();

}
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
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý tin tức</span>
                    </a>
                </li>

                <li>
                    <a href="../quanlytaikhoan">
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
            <div class="recentCustomers">
                <div>
                    <div class="cardHeader">
                        <h2>Cập nhật tin tức</h2>
                    </div>
                    <div class="card frmCreate">
                        <div class="card-body">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?php print_r($errors);?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="post" id="frmQLVC" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="txtTieuDe">Tiêu đề </label>
                                    <input type="text" name="txtTieuDe" id="txtTieuDe" class="form-control" required
                                        value="<?= $tt->tieude?>">
                                </div>
                                <div class="form-group">
                                    <label for="fileToUpload">Hình ảnh </label><br>
                                    <input type="file" name="fileToUpload" id="fileToUpload"
                                        value="<?= htmlspecialchars($tt->hinhanh) ?>">
                                </div>
                                <div class="form-group">
                                    <label for="txtNoiDung">Nội dung</label>
                                    <textarea type="text" name="txtNoiDung" id="textile-demo" class="form-control"
                                        required placeholder="Mô tả nội dung"><?= htmlspecialchars($tt->noidung) ?>>
                                   
                                </textarea>
                                </div>
                                <button name="btnSave" id="btnSave"
                                    class="btn btn-primary rounded-pill w-25 float-right active">Cập nhập</button>
                                <a class="btn btn-danger rounded-pill float-right mr-2" href="index.php"
                                    role="button">Huỷ</a>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../assets/js/main.js"></script>
    <script>
    $(document).ready(function() {
        $("#textile-demo").textileToolbar({
            toolbar: ["strong", "italic", "underline", "h1", "h2", "h3", "paragraph", "spacer", "ul",
                "ol", "url"
            ],
        });
    });
    </script>
</body>

</html>
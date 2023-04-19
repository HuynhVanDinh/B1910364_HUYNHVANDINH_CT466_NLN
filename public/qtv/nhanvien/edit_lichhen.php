<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Lichhen;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Nhasi;

$benhnhan = new Benhnhan($PDO);
$lichhen = new Lichhen($PDO);
$nhasi = new Nhasi($PDO);

$id = isset($_REQUEST['id']) ?
  filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
  if ($id < 0 || !($lichhen->find($id))) {
  redirect(BASE_URL_PATH);
}

$nha_si = $nhasi->all($PDO);
$benhnhan->find($lichhen->id_benhnhan);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($lichhen->update($_POST)) {
    echo "<script>alert('Cập nhật lịch hẹn thành công');</script>";
    echo "<script>window.location.href= 'ql_lichhen.php';</script>";
  }
  // Cập nhật dữ liệu không thành công
  $errors = $lichhen->getValidationErrors();
  if(isset($errors['ngayhen'])){
    echo "<script>alert('Ngày hẹn phải lớn hơn hoặc bằng ngày hiện tại');</script>";
    echo "<script>window.location.href= 'ql_lichhen.php';</script>";
  }
}
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
                    <a href="#">
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
            <div class="details">

                <div class="offset-1 row">
                    <form class="form-inline" action="edit_lichhen.php" method="post">
                        <input hidden type="text" name="id" value="<?php echo $id; ?>">
                        <table class="table table-bordered bg-while shadow col">
                            <tr>
                                <th colspan="2" class="text-center text-title">SỬA LỊCH HẸN (
                                    <?php echo $benhnhan->hoten ?> ) </th>
                            </tr>
                            <tr>
                                <td align="right">Tên bệnh nhân</td>
                                <td>
                                    <input hidden type="text" name="id_benhnhan"
                                        value="<?=htmlspecialchars($id_benhnhan) ?>">
                                    <input type="text" name="hoten" id="hoten" class="form-control"
                                        value="<?=htmlspecialchars($benhnhan->hoten)?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Tên nha sĩ</td>
                                <td><input hidden type="text" name="id_nhasi"
                                        value="<?=htmlspecialchars($lichhen->id_nhasi)?>">
                                    <select name="id_nhasi" id="id_nhasi" class=" form-control w-100">
                                        <option value="" hidden> -- ; --</option>
                                        <?php foreach($nha_si as $nhasi): ?>
                                        <option value="<?=htmlspecialchars($nhasi->getMaNS())?>"
                                            <?= ($nhasi->getMaNS() == $lichhen->id_nhasi) ? 'selected' : '' ?>>
                                            <?=htmlspecialchars($nhasi->tenns)?></option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td align="right">Ngày hẹn</td>
                                <td>
                                    <input class="form-control" placeholder="Nhập ngày hẹn" require type="date"
                                        name="ngayhen" id="ngayhen" value="<?= htmlspecialchars($lichhen->ngayhen) ?>">
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Giờ hẹn</td>
                                <td>
                                    <input class="form-control" placeholder="Nhập giờ hẹn" require type="time"
                                        name="giohen" id="giohen" value="<?= htmlspecialchars($lichhen->giohen) ?>">
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Ghi chú</td>
                                <td><textarea class="form-control" require name="ghichu" id="ghichu" cols="80" rows="5"
                                        placeholder="Nhập ghi chú"><?= htmlspecialchars($lichhen->ghichu) ?></textarea>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">
                                    <button name="btnSave" id="btnSave"
                                        class="btn btn-primary rounded-pill w-25 float-right active">Cập nhật</button>
                                    <a class="btn btn-danger rounded-pill float-right mr-2" href="ql_lichhen.php"
                                        role="button">Huỷ</a>
                                </td>
                            </tr>
                        </table>
                    </form>
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
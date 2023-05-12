<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Nhanvien;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Nhasi;
use ct466\Nhakhoa\Lichhen;

$lichhen = new Lichhen($PDO);
$nhasi = new Nhasi($PDO);
$nhanvien = new Nhanvien($PDO);
$benhnhan = new Benhnhan($PDO);
$user = new User($PDO);

$ds_lichhen = $lichhen->all($PDO);
$ds_lichhen_cxn = $lichhen->lichhen_cxn($PDO);
$ds_lichhen_dxn = $lichhen->lichhen_dxn($PDO);
$nha_si = $nhasi->all($PDO);
$benh_nhan = $benhnhan->all();
$id_benhnhan = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
$BN = $benhnhan->find($id_benhnhan);
$ID_nhanvien = $nhanvien->getMaNV();
$user->find($ID_nhanvien);
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
                        <h2>Danh sách các lịch hẹn chưa xác nhận</h2>
                    </div>
                    <table id="benhnhan" class="table table-bordered table-striped text-center">
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
                                <th>Duyệt</th>
                                <th>Tùy Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ds_lichhen_cxn as $lichhen) :
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
                                    <a id="duyet" class="btn btn-sm btn-warning"
                                        href="duyet_lh.php?id=<?php echo $ID_lichhen; ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true">Duyệt</i></a>
                                </td>

                                <td>
                                    <a class="btn btn-sm btn-danger"
                                        href="del_lichhen.php?id=<?php echo $ID_lichhen; ?>"><i class="fa fa-trash"
                                            aria-hidden="true"> XÓA</i></a>
                                    <a id="edit" class="btn btn-sm btn-warning"
                                        href="edit_lichhen.php?id=<?php echo $ID_lichhen; ?>"><i
                                            class="fa fa-pencil-square-o" aria-hidden="true"> SỬA</i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php if (isset($_POST['submit'])):
                    // var_dump($_POST);
                        $ngayhen = $_POST['ngayhen'];
                        $giohen = $_POST['giohen'];
                        $ghichu = $_POST['ghichu'];
                        $id_benhnhan = $_POST['id_benhnhan'];
                        $_POST['sdt'] = $benhnhan->find($id_benhnhan)->sdt;
                        $id_nhasi = $_POST['id_nhasi'];
                        $nhanvien_id = $_SESSION['id_user'];
                        $lichhen->tao_lichhen($_POST,$nhanvien_id);
                        $errors = $lichhen->getValidationErrors();
                        if (isset($errors['ngayhen'])) {
                            echo '<script>alert("Ngày hẹn phải lớn hơn hoặc bằng ngày hiện tại.");</script>';
                            echo "<script>window.location.href= 'ql_lichhen.php?id=$id_benhnhan';</script>";
                        } elseif (isset($errors['giohen'])) {
                            echo '<script>alert("Giờ hẹn không hợp lệ.");</script>';
                            echo "<script>window.location.href= 'ql_lichhen.php?id=$id_benhnhan';</script>";
                        } else{
                            echo '<script>alert("Tạo lịch hẹn thành công !!!.");</script>';
                            echo '<script>window.location.href= "ql_lichhen.php";</script>';
                        }
                    ?>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-center mt-3">Lập lịch hẹn cho bệnh nhân</h1>
                        </div>
                    </div>
                    <form method="POST" class="mt-3">
                        <div class="form-group">
                            <label for="hoten">Tên bệnh nhân</label>
                            <?php if(isset($_REQUEST['id'])):?>
                            <input hidden type="text" name="id_benhnhan" value="<?=htmlspecialchars($id_benhnhan) ?>">
                            <input type="text" name="hoten" id="hoten" class="form-control"
                                value="<?=htmlspecialchars($benhnhan->find($id_benhnhan)->hoten)?>" disabled>
                            <input hidden type="text" name="sdt" id="sdt" class="form-control"
                                value="<?=htmlspecialchars($benhnhan->find($id_benhnhan)->sdt)?>" readonly>
                            <?php endif;?>
                            <?php if(!isset($_REQUEST['id'])):?>
                            <input hidden type="text" name="id_benhnhan"
                                value="<?=htmlspecialchars($benhnhan->getMaBN())?>">
                            <select name="id_benhnhan" id="id_benhnhan" class=" form-control w-100">
                                <option value="" hidden> -- ; --</option>
                                <?php foreach($benh_nhan as $benhnhan): ?>
                                <option value="<?=htmlspecialchars($benhnhan->getMaBN())?>">
                                    <?=htmlspecialchars($benhnhan->hoten)?></option>
                                <?php endforeach ?>
                                <input hidden type="text" name="sdt" id="sdt" class="form-control"
                                    value="<?=htmlspecialchars($benhnhan->find($benhnhan->getMaBN())->sdt)?>" readonly>
                            </select>
                            <?php endif;?>
                        </div>
                        <div class="form-group">
                            <label for="nhasi">Tên nha sĩ</label>
                            <input hidden type="text" name="id_nhasi" value="<?=htmlspecialchars($nhasi->getMaNS())?>">
                            <select name="id_nhasi" id="id_nhasi" class=" form-control w-100">
                                <option value="" hidden> -- ; --</option>
                                <?php foreach($nha_si as $nhasi): ?>
                                <option value="<?=htmlspecialchars($nhasi->getMaNS())?>">
                                    <?=htmlspecialchars($nhasi->tenns)?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ngayhen">Ngày hẹn</label>
                            <input type="date" name="ngayhen" id="ngayhen" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="giohen">Thời gian</label>
                            <input type="time" name="giohen" id="giohen" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="ghichu">Lý do</label>
                            <textarea name="ghichu" id="ghichu" rows="5" class="form-control" required></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary ml-2 float-right active">Tạo lịch
                            hẹn</button>
                        <a href="index.php" class="btn btn-secondary float-right">Hủy</a>
                    </form>
                </div>
            </div>
            <hr>
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
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
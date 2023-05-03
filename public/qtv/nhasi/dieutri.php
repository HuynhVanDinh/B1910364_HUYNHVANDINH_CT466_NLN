<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Nhasi;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Benh;
use ct466\Nhakhoa\Phieukham;

$phieukham = new Phieukham($PDO);
$nhasi = new Nhasi($PDO);
$benhnhan = new Benhnhan($PDO);
$benh = new Benh($PDO);
$user = new User($PDO);

$id_benhnhan = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
$id_phieukham = isset($_REQUEST['id_pk']) ? filter_var($_REQUEST['id_pk'], FILTER_SANITIZE_NUMBER_INT) : -1;
$bn = $benhnhan->find($id_benhnhan);
$pk = $phieukham->timPK($id_benhnhan,$id_phieukham);
$dm_benh = $benh->all();
$dm_phieukham = $phieukham->all_ctt();

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
                    <div class="col-lg-4">
                        <div class="cardHeader">
                            <h2>Thông tin bệnh nhân</h2>
                        </div>
                        <h4>Tên bệnh nhân:
                            <?=htmlspecialchars($bn->hoten) ?>
                        </h4>
                        <h4>Giới tính:
                            <?=htmlspecialchars($bn->gioitinh) ?>
                        </h4>
                        <h4>Năm sinh:
                            <?=htmlspecialchars($bn->namsinh) ?>
                        </h4>
                        <h4>Số điện thoại:
                            <?=htmlspecialchars($bn->sdt) ?>
                        </h4>
                        <h4>Địa chỉ:
                            <?=htmlspecialchars($bn->diachi) ?>
                        </h4>
                        <hr>
                        <h4>Yêu cầu khám: <br>
                            - <?=htmlspecialchars($pk->noidung) ?>
                        </h4>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="cardHeader text-center">
                            <h2>Lập hoá đơn</h2>
                        </div>
                        <form class="form-inline" action="themdichvu.php" method="post">
                            <input hidden type="text" name="id_benhnhan" value="<?=htmlspecialchars($id_benhnhan) ?>">
                            <input hidden type="text" name="id_phieukham" value="<?=htmlspecialchars($id_phieukham) ?>">
                            <input hidden type="number" name="soluong" value="1">
                            <div class="form-group">
                                <label for="dichvu">Chọn dịch vụ:</label>
                                <select name="dichvu" id="dichvu" class="form-control ml-2 mr-2">
                                    <?php foreach($dm_benh as $benh): ?>
                                    <option value="<?=htmlspecialchars($benh->getId())?>">
                                        <?=htmlspecialchars($benh->tenbenh)?></option>
                                    <?php endforeach ?>
                                </select>
                                <button class="btn btn-primary" type="submit">Thêm</button>
                            </div>
                        </form>
                        <div style="overflow-y: scroll;">
                            <table id="lichkham" class="table table-bordered table-striped text-center mt-2">
                                <thead class="text-center">
                                    <tr>
                                        <th>STT</th>
                                        <th>Dịch vụ</th>
                                        <th>Thuốc</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Tổng tiền</th>
                                        <th>Tuỳ chọn</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                $n = 1;
                                foreach ($dm_phieukham as $phieukham) :
                                    if ($phieukham->id_benhnhan == $id_benhnhan && $phieukham->id_nhasi == $id_nhasi && $phieukham->getMaPK() == $id_phieukham) {
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
                                            <!-- <button class="btn btn-warning" type="submit">Cập nhật</button> -->
                                            <a class="btn btn-danger"
                                                href="xoa_dichvu.php?id_phieukham=<?php echo $phieukham->getMaPK(); ?>&id_benh=<?php echo $phieukham->id_benh; ?>&id_benhnhan=<?php echo $phieukham->id_benhnhan; ?>">Xóa</a>
                                        </td>

                                    </tr>

                                    <?php }endforeach ?>
                            </table>
                        </div>

                        <a class="btn btn-info float-right mt-3"
                            href="xuly_hoadon.php?ma_pk=<?php echo $phieukham->getMaPK(); ?>">Xuất
                            hoá đơn</a>
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
                    $('#lichkham').DataTable({
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
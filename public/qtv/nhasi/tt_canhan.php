<?php
session_start();
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Nhasi;

$nhasi= new Nhasi($PDO);
$Nha_si = $nhasi->all();

$user_nhasi=$nhasi->findUser($_SESSION["id_user"]);
$id=$user_nhasi->getMaNS();
// echo "<script>alert('".$id."');</script>";
if ($id < 0 || !($nhasi->find($id))) {
  redirect(BASE_URL_PATH);
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($nhasi->update($_POST)) {
    echo "<script>alert('Cập nhật thông tin thành công');</script>";
    echo "<script>window.location.href= 'tt_canhan.php';</script>";
  }
  // Cập nhật dữ liệu không thành công
  $errors = $nhasi->getValidationErrors();
  echo "<script>alert('Có lỗi xảy ra');</script>";
  print_r($errors);
}
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
            <div class="offset-2 row">
                <form class="form-inline" action="" enctype="multipart/form-data" method="post">
                    <input hidden type="text" name="id" value="<?php echo $id; ?>">
                    <table class="table table-bordered bg-while shadow col">
                        <tr>
                            <th colspan="4" class="text-center text-title">SỬA THÔNG TIN CÁ NHÂN </th>
                        </tr>
                        <tr>
                            <td align="right">Tên nha sĩ</td>
                            <td><input class="form-control" require type="text" name="tenns" id="tenns"
                                    placeholder="Nhập tên nha sĩ" value="<?= htmlspecialchars($nhasi->tenns) ?>">
                            </td>
                            <td rowspan="2" align="right">Bằng cấp</td>
                            <td rowspan="2"><textarea class="form-control" require name="bangcap" id="bangcap" cols="40"
                                    rows="5"
                                    placeholder="Mô tả bằng cấp"><?= htmlspecialchars($nhasi->bangcap) ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td align="right">Địa chỉ nhà</td>
                            <td>
                                <input class="form-control" require type="text" name="diachinha" id="diachinha"
                                    placeholder="Nhập đia chỉ nhà" value="<?= htmlspecialchars($nhasi->diachinha) ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">CMND/CCCD</td>
                            <td>
                                <input class="form-control" placeholder="Nhập CCCD/CMND" require type="text" name="cm"
                                    id="cm" value="<?= htmlspecialchars($nhasi->cm) ?>">
                            </td>
                            <td rowspan="2" align="right">Kinh nghiệm</td>
                            <td rowspan="2"><textarea class="form-control" require name="kinhnghiem" id="kinhnghiem"
                                    cols="40" rows="5"
                                    placeholder="Mô tả kinh nghiệm"><?= htmlspecialchars($nhasi->kinhnghiem) ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Giới tính</td>
                            <td>
                                <div class=" form-check-inline">
                                    <input class="form-check-input" type="radio" name="gtinh" id="nam" value="nam">
                                    <label for="nam">Nam</label>
                                    <input class="form-check-input" type="radio" name="gtinh" id="nữ" value="nữ">
                                    <label for="nữ">Nữ</label>
                                </div>

                            </td>

                        </tr>
                        <tr>
                            <td align="right">SDT</td>
                            <td>
                                <input class="form-control" placeholder="Nhập số điện thoại" require type="text"
                                    name="dt" id="dt" value="<?= htmlspecialchars($nhasi->dt) ?>">
                            </td>

                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">
                                <button name="btnSave" id="btnSave"
                                    class="btn btn-primary rounded-pill w-25 float-right active">Cập nhật</button>
                            </td>
                        </tr>
                    </table>
                </form>
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
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js">
        </script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
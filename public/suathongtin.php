<?php
    use ct466\Nhakhoa\Benhnhan;
    require_once __DIR__. "/../bootstrap.php";

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $benhnhan = new Benhnhan($PDO);

    if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
        unset($_SESSION['id_benhnhan']);
    }

    if (isset($_SESSION['id_benhnhan'])) {
        $benhnhanid = $_SESSION['id_benhnhan'];
        $benhnhanData = $benhnhan->find($benhnhanid);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($benhnhan->update($_POST)) {
            // Cập nhật dữ liệu thành công
            echo "<script>alert('Cập nhật thành công');</script>";
            echo "<script>window.location.href= 'suathongtin.php';</script>";
        }
    // Cập nhật dữ liệu không thành công
        $errors = $benhnhan->getValidationErrors();
        echo "<script>alert('Có lỗi xảy ra');</script>";
        print_r($errors);
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="css/style.css" rel=" stylesheet">

    <title>Win Smile</title>
    <style>
    .nav-h {
        background: #cf9a2c;
    }
    </style>
</head>

<body>
    <main>

        <nav class="row">
            <div class="pt-2 pb-2 nav-h col-12">
                <div class="row">
                    <div class="pl-5 col-lg-4 col-sm-6 text-white">
                        <h6>Hà Nội: <strong class="number">0371234567</strong> | TP.Hồ Chí Minh: <strong
                                class="number">0377654321</strong></h6>

                    </div>
                    <div class="col-lg-4 col-sm-6"></div>
                    <div class="pl-5 col-lg-4 col-sm-6 text-white">
                        <h6>Giờ mở cửa: <strong class="number">8h00 - 20h00</strong></h6>


                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-sm navbar-light col">
                <a class="navbar-brand" href="#">
                    <img src="img/winsmile.jpg" class="img-fluid" width="80" height="80">
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Trang chủ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tintuc.php">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Nha sĩ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#">Về tôi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0" method="POST" action="search.php">
                        <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm..." name="tukhoa">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="timkiem">Tìm
                            kiếm</button>
                    </form>
                    <div class="nav-item dropdown ml-3 ">
                        <div class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="nav-log "><img src="img/upload/admin.jpg" alt="" class="rounded-circle"
                                    style="width:40px; height:40px"> &nbsp;
                                <?php echo $benhnhanData->hoten; ?></span> |
                        </div>
                        <div class="dropdown-menu shadow-lg">
                            <a href="index.php?dangxuat=1" class="dropdown-item "><i
                                    class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                            <a href="suataikhoan.php" class="dropdown-item "><i class="fa-solid fa-gear"></i> Lịch sử
                                hoá đơn</a>
                            <a href="suataikhoan.php" class="dropdown-item "><i class="fa-solid fa-gear"></i> Lịch sử
                                khám</a>
                            <a href="suataikhoan.php" class="dropdown-item "><i class="fa-solid fa-gear"></i> Sửa tài
                                khoản</a>
                            <a href="suataikhoan.php" class="dropdown-item "><i class="fa-solid fa-gear"></i> Sửa thông
                                tin</a>

                        </div>
                        <?php
                            } else {
                            ?>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Đăng nhập <img src="img/login.png" alt=""></a>
                            </li>
                        </ul>
                        <?php
                            }
                         ?>
                    </div>
                </div>
            </nav>
        </nav>
        <section class="row">
            <div class=" container">
                <form class="form-inline" action="" enctype="multipart/form-data" method="post">
                    <input hidden type="text" name="id" value="<?php echo $id; ?>">
                    <table class="table table-bordered bg-while shadow mt-5">
                        <tr>
                            <th colspan="2" class="text-center text-title">SỬA THÔNG TIN CÁ NHÂN </th>
                        </tr>
                        <tr>
                            <td align="right">Họ và tên</td>
                            <td><input class="form-control" require type="text" name="hoten" id="tenbenhnhan"
                                    placeholder="Nhập tên bệnh nhân" value="<?= htmlspecialchars($benhnhan->hoten) ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">Giới tính</td>
                            <td>
                                <div class=" form-check-inline">
                                    <input class="form-check-input" type="radio" name="gioitinh" id="nam" value="nam"
                                        <?php if($benhnhan->gioitinh == "nam") echo "checked"; ?>>
                                    <label for="nam">Nam</label>
                                    <input class="form-check-input" type="radio" name="gioitinh" id="nữ" value="nữ"
                                        <?php if($benhnhan->gioitinh == "nữ") echo "checked"; ?>>
                                    <label for="nữ">Nữ</label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td align="right">Năm sinh</td>

                            <td>
                                <select class="form-control" require name="namsinh" id="namsinh">
                                    <option value="">-- Chọn năm sinh --</option>
                                    <?php for ($i = date('Y'); $i >= 1900; $i--) { ?>
                                    <option value="<?php echo $i; ?>"
                                        <?php if ($i == $benhnhan->namsinh) echo 'selected'; ?>><?php echo $i; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td align="right">Địa chỉ</td>
                            <td>
                                <input class="form-control" placeholder="Nhập địa chỉ" require type="text" name="diachi"
                                    id="diachi" value="<?= htmlspecialchars($benhnhan->diachi) ?>">
                            </td>
                        </tr>
                        <tr>
                            <td align="right">SĐT</td>
                            <td>
                                <input class="form-control" placeholder="Nhập số điện thoại" require type="text"
                                    name="sdt" id="sdt" value="<?= htmlspecialchars($benhnhan->sdt) ?>">
                            </td>

                        </tr>
                        <tr>
                            <td align="right">CMND/CCCD</td>
                            <td>
                                <input class="form-control" placeholder="Nhập CMND/CCCd" require type="text" name="cmnd"
                                    id="cmnd" value="<?= htmlspecialchars($benhnhan->cmnd) ?>">
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
        </section>
        <?php
        include __DIR__."/../partials/footer.php";
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

</body>

</html>
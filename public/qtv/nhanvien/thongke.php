<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\Bienlai;
use ct466\Nhakhoa\Benhnhan;

$bienlai = new Bienlai($PDO);
$biennhan = new Benhnhan($PDO);

$bienlai_list = [];
// Kiểm tra xem ngày bắt đầu và kết thúc đã được truyền vào hay chưa
if (isset($_POST['time-range'])) {
    // Nếu thống kê theo khoảng ngày
    if ($_POST['time-range'] === 'by-day') {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        // Kiểm tra ngày bắt đầu và kết thúc phải hợp lệ và khác nhau
        if (strtotime($start_date) !== false && strtotime($end_date) !== false && $start_date <= $end_date) {
            // Truy vấn cơ sở dữ liệu để lấy danh sách các biên lai trong khoảng thời gian được chỉ định
            
            $bienlai_list = $bienlai->bienlai_by_date_range($start_date, $end_date);        
        } else {
            echo '<script>alert("Ngày bắt đầu và kết thúc không hợp lệ!");</script>';
            echo '<script>window.location.href= "thongke.php";</script>';
        }
    }
    if ($_POST['time-range'] === 'by-year') {
        $year = $_POST['year'];
        $bienlai_list = $bienlai->bienlai_by_year($year);
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
                        <h2 class="text-center">Thống kê danh thu</h2>
                    </div>
                    <div class="container">
                        <form method="post" action="thongke.php">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="date-type">Thống kê theo:</label>
                                        <div class="form-check">
                                            <input onclick="myFunction()" class="form-check-input" type="radio"
                                                name="time-range" id="by-day" value="by-day"
                                                <?php if(isset($_GET['time-range']) && $_GET['time-range'] === 'by-day') echo 'checked'; ?>>
                                            <label class="form-check-label" for="by-day">
                                                Khoảng ngày
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input onclick="myFunction()" class="form-check-input" type="radio"
                                                name="time-range" id="by-year" value="by-year"
                                                <?php if(isset($_GET['time-range']) && $_GET['time-range'] === 'by-year') echo 'checked'; ?>>
                                            <label class="form-check-label" for="by-year">
                                                Năm
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-sm-12 mt-5">
                                    <div id="text" style="display:none">
                                        <div class="form-group">
                                            <label for="start-date">Ngày bắt đầu:</label>
                                            <input type="date" class="form-control" id="start-date" name="start_date"
                                                value="<?php echo $_GET['start_date'] ?? ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="end-date">Ngày kết thúc:</label>
                                            <input type="date" class="form-control" id="end-date" name="end_date"
                                                value="<?php echo $_GET['end_date'] ?? ''; ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-3">Thống kê</button>
                                    </div>
                                    <div id="textyear" style="display:none" class="form-group">
                                        <label for="year">Năm:</label>
                                        <input type="number" class="form-control" id="year" name="year" min="1900"
                                            max="<?php echo date('Y'); ?>"
                                            value="<?php echo $_GET['year'] ?? date('Y'); ?>">
                                        <button type="submit" class="btn btn-primary mt-3">Thống kê</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table id="thanhtoan" class="table table-bordered table-striped text-center">
                            <thead class="text-center">
                                <tr>
                                    <th>Mã hoá đơn</th>
                                    <th>Ngày khám</th>
                                    <th>Chi phí</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $total_amount = 0;
                                 foreach ($bienlai_list as $bienlai):;
                                $total_amount = $total_amount + $bienlai->tongtien;
                                 $ID_bienlai = $bienlai->getMaBl();
                                $ngay = $bienlai->ngaythu;
                                    $tongtien= $bienlai->tongtien;
                                    $bn = $biennhan->find($bienlai->id_benhnhan);
                                 ?>
                                <tr>

                                    <td><?= htmlspecialchars($ID_bienlai) ?></td>
                                    <td><?= htmlspecialchars($ngay) ?></td>
                                    <td><?= htmlspecialchars($tongtien) ?></td>
                                </tr>
                                <?php endforeach; ?>
                        </table>
                        <div class="float-right mt-5">
                            <h4>Tổng chi phí: <?php echo $total_amount?> VNĐ</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../admin/assets/js/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script>
        function myFunction() {
            // Get the checkbox
            var checkBox = document.getElementById("by-day");
            // Get the output text
            var text = document.getElementById("text");

            // If the checkbox is checked, display the output text
            if (checkBox.checked == true) {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
            var checkBox = document.getElementById("by-year");
            // Get the output text
            var text1 = document.getElementById("textyear");

            // If the checkbox is checked, display the output text
            if (checkBox.checked == true) {
                text1.style.display = "block";
            } else {
                text1.style.display = "none";
            }
        }
        </script>
</body>

</html>
<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Nhasi;
use ct466\Nhakhoa\Nhanvien;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Benh;
use ct466\Nhakhoa\Bienlai;

$nhasi = new Nhasi($PDO);
$nhanvien = new Nhanvien($PDO);
$benhnhan = new Benhnhan($PDO);
$benh = new Benh($PDO);
$user = new User($PDO);
if (!isset($_SESSION['id_user'])) {
    redirect(BASE_URL_PATH);
} elseif ($user->find($_SESSION['id_user'])->status == 0) {
    redirect(BASE_URL_PATH);
}
?>
<?php
    $doanhthuThang = [];
    $bienlaiList = [];
    $month = [];
        $bienlai = new Bienlai($PDO);
        $currentMonth = date('m');
        $y = date('Y');
        for ($i = 0; $i <= 11; $i++) { 
            $doanhthu = 0;
            $m = $i + 1;
            $month[] = $m;
        }
        $i = 1;
        foreach ($month as $m) {
            $bienlaiList[$i] = $bienlai->getBienLaiofMonth($i, $y);
            if ($bienlaiList[$i] == null) {
                $doanhthuThang[] = 0;
            } else {
            
        foreach ($bienlaiList as $bien_lai) {
            $doanhthu = 0;
                foreach ($bien_lai as $key) {
                    if (isset($key->tongtien)) {
                        $doanhthu = $doanhthu + $key->tongtien;
                    }
                }
            }
            $doanhthuThang[] = $doanhthu;
        } $i = $i + 1;
        }
    $month_json = json_encode($month); 
    $dtt_json = json_encode($doanhthuThang); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include __DIR__."/../partials/header.php";
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

</head>

<body>
    <!-- =============== Navigation ================ -->
    <?php
    include __DIR__."/../partials/navigation.php";
    ?>
    <!-- ========================= Main ==================== -->
    <div class="main">
        <?php
        include __DIR__."/../partials/topbar.php";
        ?>
        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="cardName">Số nha sĩ</div>
                    <div class="numbers">
                        <?php
                        echo htmlspecialchars($nhasi->so_nhasi());
                        ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="cardName">Số nhân viên</div>
                    <div class="numbers">
                        <?php
                        echo htmlspecialchars($nhanvien->so_nhanvien());
                        ?></div>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="cardName">Số bệnh nhân</div>
                    <div class="numbers">
                        <?php
                        echo htmlspecialchars($benhnhan->so_benhnhan());
                        ?>
                    </div>

                </div>
            </div>

            <div class="card">
                <div>
                    <div class="cardName">Số danh mục bệnh</div>
                    <div class="numbers">
                        <?php
                        echo htmlspecialchars($benh->so_Benh());
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================ ================= -->
        <div class="recentCustomers">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Biểu đồ doanh thu</h2>
                    <!-- <a href="#" class="btn">Xem chi tiết</a> -->
                </div>

                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div id="month" data-month='<?php echo $month_json; ?>'></div>
                <div id="doanhthuthang" data-dtt='<?php echo $dtt_json; ?>'></div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/chart.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
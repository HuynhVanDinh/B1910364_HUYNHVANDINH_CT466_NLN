<?php
 session_start();
include "../bootstrap.php";
use ct466\Nhakhoa\Bienlai;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Nhanvien;

$bl = new Bienlai($PDO);
$biennhan = new Benhnhan($PDO);
$nhanvien = new Nhanvien($PDO);
$kq = $bl->tim_bienlai($_SESSION['id_benhnhan']);
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
</head>

<body>
    <main class="pl-2">
        <?php
        include __DIR__."/../partials/nav.php";
        ?>
        <section class="row">
            <div class="container">
                <p class="text-contact text-center mt-3" style="font-size: 36px">Lịch sử hoá đơn</p>
                <p class="text-center">Hệ thống Nha Khoa Thẩm Mỹ Quốc Tế WinSmile.
                </p>
                <table id="bienlai" class="table table-bordered table-striped text-center">
                    <thead class="text-center">
                        <tr>
                            <th>Mã hoá đơn</th>
                            <th>Người thu</th>
                            <th>Tên bệnh nhân</th>
                            <th>Tuổi</th>
                            <th>Ngày khám</th>
                            <th>Chi phí</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kq as $bl) :
                            $ID_bienlai = $bl->getMaBl();
                            $bn = $biennhan->find($bl->id_benhnhan);
                            $nam_hien_tai = date('Y');
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($ID_bienlai) ?></td>
                            <td><?= htmlspecialchars(($nhanvien->find($bl->id_nhanvien))->tennv)?></td>
                            <td><?= htmlspecialchars($bn->hoten) ?></td>
                            <td><?= htmlspecialchars($nam_hien_tai-$bn->namsinh) ?></td>
                            <td><?= htmlspecialchars($bl->ngaythu) ?></td>
                            <td><?= htmlspecialchars($bl->tongtien) ?></td>
                        </tr>
                        <?php endforeach; ?>

                </table>
            </div>
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
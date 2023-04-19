<?php
 session_start();
include "../bootstrap.php";
use ct466\Nhakhoa\Phieukham;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Benh;
use ct466\Nhakhoa\Nhanvien;
use ct466\Nhakhoa\Nhasi;
use ct466\Nhakhoa\Bienlai;

$phieukham = new Phieukham($PDO);
$dm_phieukham = $phieukham->all_ctpk_user($_SESSION['id_benhnhan']);
$nhasi = new Nhasi($PDO);
$benhnhan = new Benhnhan($PDO);
$benh = new Benh($PDO);
$bienlai = new Bienlai($PDO);
$nhanvien = new Nhanvien($PDO);
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
                <p class="text-contact text-center mt-3" style="font-size: 36px">Lịch sử khám</p>
                <p class="text-center">Hệ thống Nha Khoa Thẩm Mỹ Quốc Tế WinSmile.
                </p>
                <table id="bienlai" class="table table-bordered table-striped text-center">
                    <thead class="text-center">
                        <tr>
                            <th>STT</th>
                            <th>Người lập phiếu</th>
                            <th>Người thu tiền</th>
                            <th>Nha sĩ</th>
                            <th>Ngày khám</th>
                            <th>Tên bệnh nhân</th>
                            <th>Nội dung khám</th>
                            <th>Lời dặn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $n = 1;
                         foreach ($dm_phieukham as $phieukham) :
                            $ID_phieukham = $phieukham->getMaPK();
                            $bn = $benhnhan->find($phieukham->id_benhnhan);
                            $id_nguoithu = ($bienlai->find($phieukham->ma_bl))->id_nhanvien;
                        ?>
                        <tr>
                            <td><?php echo $n;
									$n++; ?></td>
                            <td><?= htmlspecialchars(($nhanvien->find($phieukham->id_nhanvien))->tennv)?></td>
                            <td><?= htmlspecialchars(($nhanvien->find($id_nguoithu))->tennv)?></td>
                            <td><?= htmlspecialchars(($nhasi->find($phieukham->id_nhasi))->tenns)?></td>
                            <td><?= htmlspecialchars($phieukham->ngay) ?></td>
                            <td><?= htmlspecialchars($bn->hoten) ?></td>
                            <td><?= htmlspecialchars(($benh->find($phieukham->id_benh))->tenbenh)?></td>
                            <td><?= htmlspecialchars(($benh->find($phieukham->id_benh))->mota)?></td>
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
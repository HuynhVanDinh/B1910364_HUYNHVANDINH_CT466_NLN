<?php
session_start();
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\Phieukham;
use ct466\Nhakhoa\Benhnhan;
use ct466\Nhakhoa\Benh;
use ct466\Nhakhoa\Bienlai;

$phieukham = new Phieukham($PDO);
$biennhan = new Benhnhan($PDO);
$benh = new Benh($PDO);
$bienlai = new Bienlai($PDO);

$id_benhnhan = $_GET['id'];
$dm_phieukham = $phieukham->bl_ctt($_GET['ma_bl']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>In hoá đơn</title>
    <style>
    .clearfix {
        clear: both;
    }
    </style>
</head>

<body>
    <div class="container mt-3">
        <div class="float-left">
            <p>Ngày khám: <br><?php echo htmlspecialchars($bienlai->find($_GET['ma_bl'])->ngaythu)?></p>
        </div>
        <div class="float-right" onclick="inHoaDon()">
            <p>In hoá đơn</p>
        </div>
        <div class="text-center">
            <h5 class="text-primary">NHA KHOA WIN SMILE</h5>
            <h6>
                <p>Địa chỉ: abc, đường 3/2, q.Ninh Kiều, tp.Cần Thơ</p>
            </h6>
            <h6>Giờ mở cửa: <strong class="number">8h00 - 20h00</strong></h6>
            <h6>Hà Nội: <strong class="number">0371234567</strong> | TP.Hồ Chí Minh: <strong
                    class="number">0377654321</strong></h6>
            <h2 class="text-primary">HOÁ ĐƠN KHÁM BỆNH</h2>
        </div>
        <div class="float-right">
            <p>Số: 000<?php echo $_GET['ma_bl']?></p>
        </div>
        <div class="float-left">
            <p>Tên khách hàng: <b><?php 
                        echo htmlspecialchars($biennhan->find($_GET['id'])->hoten)
                        ?></b></p>
            <p>Địa chỉ: <b><?php 
                        echo htmlspecialchars($biennhan->find($_GET['id'])->diachi)
                        ?></b></p>
            <p>SĐT: <b><?php 
                        echo htmlspecialchars($biennhan->find($_GET['id'])->sdt)
                        ?></b></p>
        </div>
        <table id="thanhtoan" class="table table-bordered table-striped text-center mt-2">
            <thead class="text-center">
                <tr>
                    <th>STT</th>
                    <th>Dịch vụ</th>
                    <th>Thuốc</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>

                <?php
                                $n = 1;
                                foreach ($dm_phieukham as $phieukham) :
                                    if ($phieukham->id_benhnhan == $id_benhnhan) {
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
                </tr>

                <?php }endforeach ?>
        </table>
        <div class="float-right">
            <b>
                <h4>Tổng cộng:<?php 
                        echo htmlspecialchars($bienlai->find($_GET['ma_bl'])->tongtien)
                        ?><sup> vnđ</sup></h4>
            </b>
            <h5 class="mt-5 pr-5">....ngày....tháng....năm 2023</h5>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col">
                <div class="text-center">
                    <b>Bệnh nhân</b> <br>
                    <b>(kí, họ tên)</b>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <b>Nhân viên thu ngân</b> <br>
                    <b>(kí, họ tên)</b>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <b>Nha sĩ điều trị</b> <br>
                    <b>(kí, họ tên)</b>
                </div>
            </div>
        </div>
    </div>
    <script>
    function inHoaDon() {
        print();
    }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>
</body>

</html>
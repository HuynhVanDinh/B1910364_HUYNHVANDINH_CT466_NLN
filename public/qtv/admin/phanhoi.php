<?php
session_start();
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Lienhe;
$lienhe = new Lienhe($PDO);
$dmlienhe = $lienhe->all();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include __DIR__."/../partials/header.php";
    ?>
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
        <div class="recentCustomers">
            <div id="table">
                <div class="cardHeader">
                    <h2>Các liên hệ</h2>
                </div>
                <table id="tbphanhoi" class="table table-bordered table-striped text-center">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên liên hệ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Cơ sở</th>
                            <th>Lời nhắn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dmlienhe as $lienhe) :
                            $ID_lienhe = $lienhe->layID();
                            // $timestamp = strtotime($product->created_day);
                            // $date = date('d-m-Y', $timestamp);

                        ?>
                        <tr>
                            <td><?= htmlspecialchars($ID_lienhe) ?></td>
                            <td><?= htmlspecialchars($lienhe->hoten) ?></td>
                            <td><?= htmlspecialchars($lienhe->dthoai)?></td>
                            <td><?= htmlspecialchars($lienhe->email) ?></td>
                            <td><?= htmlspecialchars($lienhe->coso) ?></td>
                            <td><?= htmlspecialchars($lienhe->loinhan) ?></td>
                        </tr>
                        <?php endforeach; ?>

                </table>
            </div>

        </div>
    </div>
    </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>

    <script>
    $(document).ready(function() {
        $('#tbphanhoi').DataTable({
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
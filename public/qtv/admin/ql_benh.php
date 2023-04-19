<?php
session_start();
include __DIR__."/../../../bootstrap.php";

// use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Benh;
// $user = new User($PDO);
$benh = new Benh($PDO);
// $users = $user->getUser();
$dmbenh = $benh->all();


use ct466\Nhakhoa\User;

$user = new User($PDO);
if (!isset($_SESSION['id_user'])) {
    redirect(BASE_URL_PATH);
} elseif ($user->find($_SESSION['id_user'])->status == 0) {
    redirect(BASE_URL_PATH);
}
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
        <!-- ================ Order Details List ================= -->
        <div class="details">
            <div id="menu1">
                <b>Thêm danh mục thuốc mới:</b>
                <input type="checkbox" id="myCheck" onclick="myFunction()">
                <div id="text" style="display:none">
                    <form class="form-inline" action="themdmbenh.php" enctype="multipart/form-data" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2" class="text-center text-title">THÊM DANH MỤC THUỐC MỚI</th>

                            </tr>
                            <tr>
                                <td align="right">Tên loại bệnh <strong class="text-danger">(*)</strong>
                                </td>
                                <td><input class="form-control" require type="text" name="tenbenh" id="tenbenh"
                                        placeholder="Nhập tên loại bệnh" value="<?php if (isset($_GET['tenbenh'])) {
                             echo $_GET['tenbenh'];
                            } ?>">
                                </td>
                            </tr>

                            <tr>
                                <td align="right">Đơn giá <strong class="text-danger">(*)</strong></td>
                                <td>
                                    <input class="form-control" placeholder="Nhập đơn giá" require type="number"
                                        min="1000" name="dongia" id="dongia" value="<?php if (isset($_GET['dongia'])) {
                             echo $_GET['dongia'];
                            } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Thuốc đính kèm <strong class="text-danger">(*)</strong></td>
                                <td>
                                    <input class="form-control" placeholder="Nhập thuốc đính kèm" require type="text"
                                        name="thuocdinhkem" id="thuocdinhkem" value="<?php if (isset($_GET['thuocdinhkem'])) {
                             echo $_GET['thuocdinhkem'];
                            } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Mô tả <strong class="text-danger">(*)</strong></td>
                                <td><textarea class="form-control" require name="mota" id="mota" cols="80" rows="5"
                                        placeholder="Mô tả"><?php if (isset($_GET['mota'])) {
                                    echo $_GET['mota'];
                                 } ?></textarea>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Thêm danh mục
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="recentCustomers">
            <div id="table">
                <div class="cardHeader">
                    <h2>Quản lý danh mục thuốc</h2>
                </div>
                <table id="tbbenh" class="table table-bordered table-striped text-center">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên bệnh</th>
                            <th>Đơn giá</th>
                            <th>Thuốc đính kèm </th>
                            <th>Ghi chú</th>
                            <th width="15%">Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dmbenh as $benh) :
                            $ID_benh = $benh->getId();
                            // $timestamp = strtotime($product->created_day);
                            // $date = date('d-m-Y', $timestamp);

                        ?>
                        <tr>
                            <td><?= htmlspecialchars($ID_benh) ?></td>
                            <td><?= htmlspecialchars($benh->tenbenh) ?></td>
                            <td><?php echo number_format($benh->dongia, 0, '', '.'); ?> VNĐ</td>
                            <td><?= htmlspecialchars($benh->thuocdinhkem) ?></td>
                            <td><?= htmlspecialchars($benh->mota) ?></td>
                            <td>
                                <!-- <a class="btn btn-sm btn-danger" href="del_benh.php?id=<?php echo $ID_benh; ?>"><i
                                        class="fa fa-trash" aria-hidden="true"> XÓA</i></a> -->
                                <a id="edit" class="btn btn-sm btn-warning"
                                    href="edit_benh.php?id=<?php echo $ID_benh; ?>"><i class="fa fa-pencil-square-o"
                                        aria-hidden="true"> SỬA</i></a>
                            </td>
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
        $('#tbbenh').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
            },
        });
    });

    function myFunction() {
        // Get the checkbox
        var checkBox = document.getElementById("myCheck");
        // Get the output text
        var text = document.getElementById("text");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
    </script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
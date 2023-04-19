<?php
session_start();
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Nhasi;
$user = new User($PDO);
$nhasi = new Nhasi($PDO);
$users = $user->User_ns();
$nha_si = $nhasi->all();

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
        <div class="details">
            <div id="menu1">
                <b>Thêm nha sĩ mới:</b>
                <input type="checkbox" id="myCheck" onclick="myFunction()">
                <div id="text" style="display:none">
                    <form class="form-inline" action="themnhasi.php" enctype="multipart/form-data" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="4" class="text-center text-title">THÊM NHA SĨ MỚI</th>
                            </tr>

                            <tr>
                                <td>Tên nha sĩ <strong class="text-danger">(*)</strong></td>
                                <td><input class="form-control" require type="text" name="fullname" id="tenns"
                                        placeholder="Nhập tên nha sĩ" value="<?php if (isset($_GET['name'])) {
                             echo $_GET['name'];
                            } ?>">
                                </td>
                                <td rowspan="2" width="20%" align="right">Bằng cấp <strong
                                        class="text-danger">(*)</strong></td>
                                <td rowspan="2"><textarea class="form-control" require name="bangcap" id="bangcap"
                                        cols="80" rows="5" placeholder="Mô tả bằng cấp"><?php if (isset($_GET['bangcap'])) {
                                    echo $_GET['bangcap'];
                                 } ?></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>Địa chỉ nhà <strong class="text-danger">(*)</strong></td>
                                <td><input class="form-control" require type="text" name="diachinha" id="diachinha"
                                        placeholder="Nhập địa chỉ" value="<?php if (isset($_GET['diachinha'])) {
                             echo $_GET['diachinha'];
                            } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>CMND/CCCD <strong class="text-danger">(*)</strong></td>
                                <td>
                                    <input class="form-control" require type="text" name="username" id="cm"
                                        placeholder="Nhập CMND/CCCD" value="<?php if (isset($_GET['username'])) {
                             echo $_GET['username'];
                            } ?>">
                                </td>
                                <td rowspan="2" align="right">Kinh nghiệm <strong class="text-danger">(*)</strong></td>
                                <td rowspan="2"><textarea class="form-control" require name="kinhnghiem" id="" cols="80"
                                        rows="5" placeholder="Mô tả kinh nghiệm"><?php if (isset($_GET['kinhnghiem'])) {
                                    echo $_GET['kinhnghiem'];
                                 } ?></textarea>
                                </td>

                            </tr>
                            <tr>
                                <td>Giới tính <strong class="text-danger">(*)</strong></td>
                                <td>
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="gtinh" id="nam"
                                            checked="checked" value="nam">
                                        <label for="nam">Nam</label>
                                        <input class="form-check-input" type="radio" name="gtinh" id="nữ" value="nữ">
                                        <label for="nữ">Nữ</label>
                                    </div>

                                </td>

                            </tr>
                            <tr>
                                <td>SDT <strong class="text-danger">(*)</strong></td>
                                <td>
                                    <input class="form-control" placeholder="Nhập số điện thoại" require type="text"
                                        name="password" id="" value="<?php if (isset($_GET['password'])) {
                             echo $_GET['password'];
                            } ?>">
                                </td>
                                <!-- <td align="right">Hình ảnh</td>
                                    <td>
                                        <input require type="file" name="p_p" id="p_p" value="<?php if (isset($_GET['p_p'])) {
                                echo $_GET['p_p'];
                                } ?>"> -->
                                </td>


                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Thêm nha sĩ
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
                    <h2>Danh sách các nha sĩ</h2>
                </div>
                <table id="nhasi" class="table table-bordered table-striped text-center">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên nha sĩ</th>
                            <th>Hình ảnh</th>
                            <th>Bằng cấp</th>
                            <th>Kinh nghiệm</th>
                            <th>Giới tính</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                            <th>CMND/CCCD</th>
                            <th>Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nha_si as $nhasi) :
                            $ID_nhasi = $nhasi->getMaNS();
                            $user->find($nhasi->user_id);

                            // $timestamp = strtotime($product->created_day);
                            // $date = date('d-m-Y', $timestamp);

                        ?>
                        <tr>
                            <td><?= htmlspecialchars($ID_nhasi) ?></td>
                            <td><?= htmlspecialchars($nhasi->tenns) ?></td>
                            <td><img src="../../img/upload/<?= htmlspecialchars($user->p_p) ?>" width="100px"
                                    height="100px" alt="">
                            </td>
                            <td><?= htmlspecialchars($nhasi->bangcap) ?></td>
                            <td><?= htmlspecialchars($nhasi->kinhnghiem) ?></td>
                            <td><?= htmlspecialchars($nhasi->gtinh) ?></td>
                            <td><?= htmlspecialchars($nhasi->diachinha) ?></td>
                            <td><?= htmlspecialchars($nhasi->dt) ?></td>
                            <td><?= htmlspecialchars($nhasi->cm) ?></td>
                            <td>
                                <a id="edit" class="btn btn-sm btn-warning"
                                    href="edit_nhasi.php?id=<?php echo $ID_nhasi; ?>"><i class="fa fa-pencil-square-o"
                                        aria-hidden="true">SỬA</i></a>
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
    // $(document).ready(function() {
    //     $('#nhasi').DataTable();
    //     $('.dataTables_length').addClass('bs-select');
    // });
    $(document).ready(function() {
        $('#nhasi').DataTable({
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
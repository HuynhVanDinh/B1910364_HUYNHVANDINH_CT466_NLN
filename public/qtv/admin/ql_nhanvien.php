<?php
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Nhanvien;
$user = new User($PDO);
$nhanvien = new Nhanvien($PDO);
$users = $user->User_nv();
$nhan_vien = $nhanvien->all();
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
                <b>Thêm nhân viên mới:</b>
                <input type="checkbox" id="myCheck" onclick="myFunction()">
                <div id="text" style="display:none">
                    <form class="form-inline" action="themnhanvien.php" enctype="multipart/form-data" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="4" class="text-center text-title">THÊM NHÂN VIÊN MỚI</th>
                            </tr>

                            <tr>
                                <td>Tên nhân viên<strong class="text-danger">(*)</strong></td>
                                <td><input class="form-control" require type="text" name="fullname" id="tennv"
                                        placeholder="Nhập tên nha sĩ" value="<?php if (isset($_GET['name'])) {
                             echo $_GET['name'];
                            } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Năm sinh <strong class="text-danger">(*)</strong></td>
                                <td><input class="form-control" require type="date" name="nsinh" value="<?php if (isset($_GET['name'])) {
                             echo $_GET['name'];
                            } ?>">
                                </td>
                            </tr>

                            <tr>
                                <td>Địa chỉ nhà <strong class="text-danger">(*)</strong></td>
                                <td><input class="form-control" require type="text" name="dc" placeholder="Nhập địa chỉ"
                                        value="<?php if (isset($_GET['price'])) {
                             echo $_GET['price'];
                            } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>CMND/CCCD <strong class="text-danger">(*)</strong></td>
                                <td>
                                    <input class="form-control" require type="text" name="username"
                                        placeholder="Nhập CMND/CCCD" value="<?php if (isset($_GET['price'])) {
                             echo $_GET['price'];
                            } ?>">
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
                                        name="password" id="">
                                </td>
                                <!-- <td align="right">Hình ảnh</td>
                                    <td>
                                        <input type="file" name="" id="">
                                    </td> -->


                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Thêm nhân viên
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
                    <h2>Danh sách các nhân viên</h2>
                </div>
                <table id="tbnhanvien" class="table table-bordered table-striped text-center">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên nhân viên</th>
                            <th>Hình ảnh</th>
                            <th>Năm sinh</th>
                            <th>Giới tính</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                            <th>CMND/CCCD</th>
                            <th>Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nhan_vien as $nhanvien) :
                            $ID_nhanvien = $nhanvien->getMaNV();
                            $user->find($nhanvien->user_id);
                            // $timestamp = strtotime($product->created_day);
                            // $date = date('d-m-Y', $timestamp);

                        ?>
                        <tr>
                            <td><?= htmlspecialchars($ID_nhanvien) ?></td>
                            <td><?= htmlspecialchars($nhanvien->tennv) ?></td>
                            <td><img src="../../img/upload/<?= htmlspecialchars($user->p_p) ?>" width="100px"
                                    height="100px" alt="">
                            </td>
                            <td><?= htmlspecialchars($nhanvien->nsinh) ?></td>
                            <td><?= htmlspecialchars($nhanvien->gtinh) ?></td>
                            <td><?= htmlspecialchars($nhanvien->dc) ?></td>
                            <td><?= htmlspecialchars($nhanvien->sodt) ?></td>
                            <td><?= htmlspecialchars($nhanvien->cccd) ?></td>
                            <td>
                                <a id="edit" class="btn btn-sm btn-warning"
                                    href="edit_nhanvien.php?id=<?php echo $ID_nhanvien; ?>"><i
                                        class="fa fa-pencil-square-o" aria-hidden="true"> SỬA</i></a>
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
        $('#tbnhanvien').DataTable({
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
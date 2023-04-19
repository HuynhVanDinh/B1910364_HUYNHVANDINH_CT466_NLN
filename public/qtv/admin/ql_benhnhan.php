<?php
include __DIR__."/../../../bootstrap.php";


use ct466\Nhakhoa\Benhnhan;
$benhnhan = new Benhnhan($PDO);

$benh_nhan = $benhnhan->all();
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
                <b>Thêm bệnh nhân mới:</b>
                <input type="checkbox" id="myCheck" onclick="myFunction()">
                <div id="text" style="display:none">
                    <form class="form-inline" action="thembenhnhan.php" enctype="multipart/form-data" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2" class="text-center text-title">THÊM BỆNH NHÂN MỚI</th>
                            </tr>

                            <tr>
                                <td>Tên bệnh nhân <strong class="text-danger">(*)</strong>
                                </td>
                                <td><input class="form-control" require type="text" name="hoten" id="hoten"
                                        placeholder="Nhập tên bệnh nhân" value="<?php if (isset($_GET['hoten'])) {
                             echo $_GET['hoten'];
                            } ?>">
                                </td>
                            </tr>

                            <tr>
                                <td>Giới tính <strong class="text-danger">(*)</strong>
                                </td>
                                <td>
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="gioitinh" id="nam"
                                            value="nam" checked="checked">
                                        <label for="nam">Nam</label>
                                        <input class="form-check-input" type="radio" name="gioitinh" id="nữ" value="nữ">
                                        <label for="nữ">Nữ</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Năm sinh <strong class="text-danger">(*)</strong>
                                </td>
                                <td>
                                    <input class="form-control" require type="text" name="namsinh" id="namsinh"
                                        placeholder="Nhập năm sinh" value="<?php if (isset($_GET['namsinh'])) {
                             echo $_GET['namsinh'];
                            } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ <strong class="text-danger">(*)</strong>
                                </td>
                                <td>
                                    <input class="form-control" require type="text" name="diachi" id="diachi"
                                        placeholder="Nhập địa chỉ" value="<?php if (isset($_GET['diachi'])) {
                             echo $_GET['diachi'];
                            } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>SDT <strong class="text-danger">(*)</strong>
                                </td>
                                <td>
                                    <input class="form-control" placeholder="Nhập số điện thoại" require type="text"
                                        name="sdt" id="sdt" value="<?php if (isset($_GET['sdt'])) {
                             echo $_GET['sdt'];
                            } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>CMND/CCCD <strong class="text-danger">(*)</strong>
                                </td>
                                <td>
                                    <input class="form-control" placeholder="Nhập số CMND/CCCD" require type="text"
                                        name="cmnd" id="cmnd" value="<?php if (isset($_GET['cmnd'])) {
                             echo $_GET['cmnd'];
                            } ?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        Thêm bệnh nhân
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
                    <h2>Danh sách các bệnh nhân</h2>
                </div>
                <table id="benhnhan" class="table table-bordered table-striped text-center">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tên bệnh nhân</th>
                            <th>Giới tính</th>
                            <th>Năm sinh</th>
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                            <th>CCCD/CMND</th>
                            <th>Tài khoản</th>
                            <th>Tùy Chọn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($benh_nhan as $benhnhan) :
                            $ID_benhnhan = $benhnhan->getMaBN();

                            // $timestamp = strtotime($product->created_day);
                            // $date = date('d-m-Y', $timestamp);

                        ?>
                        <tr>
                            <td><?= htmlspecialchars($ID_benhnhan) ?></td>
                            <td><?= htmlspecialchars($benhnhan->hoten) ?></td>
                            <td><?= htmlspecialchars($benhnhan->gioitinh) ?></td>
                            <td><?= htmlspecialchars($benhnhan->namsinh) ?></td>
                            <td><?= htmlspecialchars($benhnhan->diachi) ?></td>
                            <td><?= htmlspecialchars($benhnhan->sdt) ?></td>
                            <td><?= htmlspecialchars($benhnhan->cmnd) ?></td>
                            <td><?= htmlspecialchars($benhnhan->tk_dangnhap) ?></td>
                            <td>
                                <a id="edit" class="btn btn-sm btn-warning"
                                    href="edit_benhnhan.php?id=<?php echo $ID_benhnhan; ?>"><i
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
    // $(document).ready(function() {
    //     $('#nhasi').DataTable();
    //     $('.dataTables_length').addClass('bs-select');
    // });
    $(document).ready(function() {
        $('#benhnhan').DataTable({
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
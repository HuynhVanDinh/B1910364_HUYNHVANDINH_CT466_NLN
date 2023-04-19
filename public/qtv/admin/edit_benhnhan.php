<?php
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Benhnhan;

$benhnhan = new Benhnhan($PDO);
$dmbenhnhan = $benhnhan->all();


$id = isset($_REQUEST['id']) ?
  filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
if ($id < 0 || !($benhnhan->find($id))) {
  redirect(BASE_URL_PATH);
}
?>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($benhnhan->update($_POST)) {
    // Cập nhật dữ liệu thành công
    echo "<script>alert('Cập nhật bệnh nhân thành công');</script>";
    echo "<script>window.location.href= 'ql_benhnhan.php';</script>";
  }
  // Cập nhật dữ liệu không thành công
  $errors = $benhnhan->getValidationErrors();
  echo "<script>alert('Có lỗi xảy ra');</script>";
  print_r($errors);
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
        <div class="offset-3 col-6">
            <form class="form-inline" action="edit_benhnhan.php" enctype="multipart/form-data" method="post">
                <input hidden type="text" name="id" value="<?php echo $id; ?>">
                <table class="table table-bordered bg-while shadow">
                    <tr>
                        <th colspan="2" class="text-center text-title">SỬA THÔNG TIN BỆNH NHÂN (
                            <?php echo $benhnhan->hoten ?> ) </th>
                    </tr>
                    <tr>
                        <td align="right">Tên bệnh nhân</td>
                        <td><input class="form-control" require type="text" name="hoten" id="tenbenhnhan"
                                placeholder="Nhập tên bệnh nhân" value="<?= htmlspecialchars($benhnhan->hoten) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Giới tính</td>
                        <td>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="radio" name="gioitinh" id="nam" value="nam">
                                <label for="nam">Nam</label>
                                <input class="form-check-input" type="radio" name="gioitinh" id="nữ" value="nữ">
                                <label for="nữ">Nữ</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">Năm sinh</td>
                        <td>
                            <input class="form-control" require type="number" name="namsinh" id="namsinh" min="1990"
                                placeholder="Nhập năm sinh bệnh nhân"
                                value="<?= htmlspecialchars($benhnhan->namsinh) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Địa chỉ</td>
                        <td>
                            <input class="form-control" placeholder="Nhập địa chỉ" require type="text" name="diachi"
                                id="diachi" value="<?= htmlspecialchars($benhnhan->diachi) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">SĐT</td>
                        <td>
                            <input class="form-control" placeholder="Nhập số điện thoại" require type="text" name="sdt"
                                id="sdt" value="<?= htmlspecialchars($benhnhan->sdt) ?>">
                        </td>

                    </tr>
                    <tr>
                        <td align="right">CMND/CCCD</td>
                        <td>
                            <input class="form-control" placeholder="Nhập CMND/CCCd" require type="text" name="cmnd"
                                id="cmnd" value="<?= htmlspecialchars($benhnhan->cmnd) ?>">
                        </td>

                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">
                            <button name="btnSave" id="btnSave"
                                class="btn btn-primary rounded-pill w-25 float-right active">Cập nhật</button>
                            <a class="btn btn-danger rounded-pill float-right mr-2" href="ql_benhnhan.php"
                                role="button">Huỷ</a>
                        </td>
                    </tr>
                </table>
            </form>
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

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
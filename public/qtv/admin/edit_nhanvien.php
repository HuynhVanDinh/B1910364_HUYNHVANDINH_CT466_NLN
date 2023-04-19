<?php
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\Nhanvien;

$nhanvien = new Nhanvien($PDO);



$id = isset($_REQUEST['id']) ?
  filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
// echo "<script>alert('".$id."');</script>";
if ($id < 0 || !($nhanvien->find($id))) {
  redirect(BASE_URL_PATH);
  // echo "<script>alert('checker');</script>";
}
//echo "<script>alert('".$id."');</script>";
?>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_POST);
  if ($nhanvien->update($_POST)) {
    // Cập nhật dữ liệu thành công
    echo "<script>alert('Cập nhật nhân viên thành công');</script>";
    echo "<script>window.location.href= 'ql_nhanvien.php';</script>";
  }
  // Cập nhật dữ liệu không thành công
  $errors = $nhanvien->getValidationErrors();
  echo "<script>alert('Có lỗi xảy ra');</script>";
//   print_r($errors);
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
            <form class="form-inline" action="edit_nhanvien.php" enctype="multipart/form-data" method="post">
                <input hidden type="text" name="id" value="<?php echo $id; ?>">
                <table class="table table-bordered bg-while shadow ">
                    <tr>
                        <th colspan="2" class="text-center text-title">SỬA THÔNG TIN NHÂN VIÊN(
                            <?php echo $nhanvien->tennv ?> ) </th>
                    </tr>
                    <tr>
                        <td align="right">Tên nhân viên </td>
                        <td><input class="form-control" require type="text" name="tennv" id="tennhanvien"
                                placeholder="Nhập tên nhân viên" value="<?= htmlspecialchars($nhanvien->tennv) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Giới tính </td>
                        <td>
                            <div class=" form-check-inline">
                                <input class="form-check-input" type="radio" name="gtinh" id="nam" value="nam">
                                <label for="nam">Nam</label>
                                <input class="form-check-input" type="radio" name="gtinh" id="nữ" value="nữ">
                                <label for="nữ">Nữ</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">SĐT</td>
                        <td>
                            <input class="form-control" placeholder="Nhập số điện thoại" require type="text"
                                name="password" id="" value="<?= htmlspecialchars($nhanvien->sodt) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Năm sinh</td>
                        <td>
                            <input class="form-control" require type="number" name="nsinh" id="nsinh"
                                placeholder="Nhập năm sinh" value="<?= htmlspecialchars($nhanvien->nsinh) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Địa chỉ nhà</td>
                        <td><input class="form-control" require type="text" name="dc" placeholder="Nhập địa chỉ"
                                value="<?= htmlspecialchars($nhanvien->dc) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">CMND/CCCD</td>
                        <td>
                            <input class="form-control" require type="text" name="cccd" placeholder="Nhập CMND/CCCD"
                                value="<?= htmlspecialchars($nhanvien->cccd) ?>">
                        </td>

                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">
                            <button name="btnSave" id="btnSave"
                                class="btn btn-primary rounded-pill w-25 float-right active">Cập nhật</button>
                            <a class="btn btn-danger rounded-pill float-right mr-2" href="ql_nhanvien.php"
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
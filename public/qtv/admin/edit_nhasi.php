<?php
include __DIR__."/../../../bootstrap.php";

// use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Nhasi;
// $user = new User($PDO);
$nhasi= new Nhasi($PDO);
// $users = $user->getUser();
$Nha_si = $nhasi->all();


$id = isset($_REQUEST['id']) ?
  filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
// echo "<script>alert('".$id."');</script>";
if ($id < 0 || !($nhasi->find($id))) {
  redirect(BASE_URL_PATH);
  // echo "<script>alert('checker');</script>";
}
//echo "<script>alert('".$id."');</script>";
?>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($nhasi->update($_POST)) {
    // Cập nhật dữ liệu thành công
    //redirect(BASE_URL_PATH);
    echo "<script>alert('Cập nhật nha sĩ thành công');</script>";
    echo "<script>window.location.href= 'ql_nhasi.php';</script>";
  }
  // Cập nhật dữ liệu không thành công
  $errors = $nhasi->getValidationErrors();
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


        <div class="offset-1 row">
            <form class="form-inline" action="edit_nhasi.php" enctype="multipart/form-data" method="post">
                <input hidden type="text" name="id" value="<?php echo $id; ?>">
                <table class="table table-bordered bg-while shadow col">
                    <tr>
                        <th colspan="4" class="text-center text-title">SỬA THÔNG TIN NHA SĨ (
                            <?php echo $nhasi->tenns ?> ) </th>
                    </tr>
                    <tr>
                        <td align="right">Tên nha sĩ</td>
                        <td><input class="form-control" require type="text" name="tenns" id="tenns"
                                placeholder="Nhập tên nha sĩ" value="<?= htmlspecialchars($nhasi->tenns) ?>">
                        </td>
                        <td rowspan="2" align="right">Bằng cấp</td>
                        <td rowspan="2"><textarea class="form-control" require name="bangcap" id="bangcap" cols="40"
                                rows="5"
                                placeholder="Mô tả bằng cấp"><?= htmlspecialchars($nhasi->bangcap) ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td align="right">Địa chỉ nhà</td>
                        <td>
                            <input class="form-control" require type="text" name="diachinha" id="diachinha"
                                placeholder="Nhập đia chỉ nhà" value="<?= htmlspecialchars($nhasi->diachinha) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">CMND/CCCD</td>
                        <td>
                            <input class="form-control" placeholder="Nhập CCCD/CMND" require type="text" name="cm"
                                id="cm" value="<?= htmlspecialchars($nhasi->cm) ?>">
                        </td>
                        <td rowspan="2" align="right">Kinh nghiệm</td>
                        <td rowspan="2"><textarea class="form-control" require name="kinhnghiem" id="kinhnghiem"
                                cols="40" rows="5"
                                placeholder="Mô tả kinh nghiệm"><?= htmlspecialchars($nhasi->kinhnghiem) ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Giới tính</td>
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
                        <td align="right">SDT</td>
                        <td>
                            <input class="form-control" placeholder="Nhập số điện thoại" require type="text" name="dt"
                                id="dt" value="<?= htmlspecialchars($nhasi->dt) ?>">
                        </td>

                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">
                            <button name="btnSave" id="btnSave"
                                class="btn btn-primary rounded-pill w-25 float-right active">Cập nhật</button>
                            <a class="btn btn-danger rounded-pill float-right mr-2" href="ql_nhasi.php"
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
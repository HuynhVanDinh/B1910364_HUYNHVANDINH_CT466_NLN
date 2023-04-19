<?php
include __DIR__."/../../../bootstrap.php";

// use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Benh;
// $user = new User($PDO);
$benh = new Benh($PDO);
// $users = $user->getUser();
$dmbenh = $benh->all();


$id = isset($_REQUEST['id']) ?
  filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
// echo "<script>alert('".$id."');</script>";
if ($id < 0 || !($benh->find($id))) {
  redirect(BASE_URL_PATH);
  // echo "<script>alert('checker');</script>";
}
//echo "<script>alert('".$id."');</script>";
?>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($benh->update($_POST)) {
    // Cập nhật dữ liệu thành công
    //redirect(BASE_URL_PATH);
    echo "<script>alert('Cập nhật danh mục thành công');</script>";
    echo "<script>window.location.href= 'ql_benh.php';</script>";
  }
  // Cập nhật dữ liệu không thành công
  $errors = $benh->getValidationErrors();
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
            <form class="form-inline" action="edit_benh.php" enctype="multipart/form-data" method="post">
                <input hidden type="text" name="id" value="<?php echo $id; ?>">
                <table class="table table-bordered bg-while shadow col">
                    <tr>
                        <th colspan="2" class="text-center text-title">SỬA DANH MỤC THUỐC (
                            <?php echo $benh->tenbenh ?> ) </th>
                    </tr>
                    <tr>
                        <td align="right">Tên loại bệnh</td>
                        <td><input class="form-control" require type="text" name="tenbenh" id="tenbenh"
                                placeholder="Nhập tên loại bệnh" value="<?= htmlspecialchars($benh->tenbenh) ?>">
                        </td>
                    </tr>

                    <tr>
                        <td align="right">Đơn giá</td>
                        <td>
                            <input class="form-control" placeholder="Nhập đơn giá" require type="number" min="1000"
                                name="dongia" id="dongia"
                                value="<?php echo number_format($benh->dongia, 0, '', '.'); ?>"> VNĐ
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Thuốc đính kèm</td>
                        <td>
                            <input class="form-control" placeholder="Nhập thuốc đính kèm" require type="text"
                                name="thuocdinhkem" id="thuocdinhkem"
                                value="<?= htmlspecialchars($benh->thuocdinhkem) ?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Mô tả</td>
                        <td><textarea class="form-control" require name="mota" id="mota" cols="80" rows="5"
                                placeholder="Mô tả"><?= htmlspecialchars($benh->mota) ?></textarea>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">
                            <button name="btnSave" id="btnSave"
                                class="btn btn-primary rounded-pill w-25 float-right active">Cập nhật</button>
                            <a class="btn btn-danger rounded-pill float-right mr-2" href="ql_benh.php"
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
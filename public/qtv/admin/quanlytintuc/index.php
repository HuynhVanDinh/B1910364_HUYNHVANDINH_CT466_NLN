<?php
include __DIR__."/../../../../bootstrap.php";

include __DIR__."/../../../helpers/format.php";
// use ct466\Nhakhoa\User;
use ct466\Nhakhoa\Tintuc;

$fm = new Format($PDO);
// $user = new User($PDO);
$tt = new Tintuc($PDO);
// $users = $user->getUser();
$arrtt = $tt->all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include __DIR__."/../../partials/header.php";
    ?>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
    .logo {
        border-radius: 50%;
    }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="">
        <div class="navigation">
            <ul>
                <li>
                    <a href="../index.php">
                        <span class="icon">
                            <div>
                                <img class="crounded-circle logo" src="../../../img/winsmile.jpg" alt="" height="50">
                            </div>
                        </span>
                        <span class="title">Win smile</span>
                    </a>
                </li>

                <li>
                    <a href="../index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Trang chủ</span>
                    </a>
                </li>

                <li>
                    <a href="../ql_nhasi.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý nha sĩ</span>
                    </a>
                </li>

                <li>
                    <a href="../ql_nhanvien.php">
                        <span class="icon">
                            <ion-icon name="person-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý nhân viên</span>
                    </a>
                </li>

                <li>
                    <a href="../ql_benhnhan.php">
                        <span class="icon">
                            <ion-icon name="man-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý bệnh nhân</span>
                    </a>
                </li>

                <li>
                    <a href="../ql_benh.php">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý danh mục bệnh</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý tin tức</span>
                    </a>
                </li>

                <li>
                    <a href="../quanlytaikhoan/">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Quản lý tài khoản</span>
                    </a>
                </li>
                <?php if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {unset($_SESSION['id_user']); } ?>
                <li>
                    <a href="../../index.php?dangxuat=1">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="alert alert-primary topbar" role="alert">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <img src="../assets/imgs/admin.jpg" alt="">
                </div>
            </div>
            <div class="details">
                <div id="menu1">
                    <b>Đăng tin tức mới:</b>
                    <input type="checkbox" id="myCheck" onclick="myFunction()">
                    <div id="text" style="display:none">
                        <form class="form-inline" action="create.php" enctype="multipart/form-data" method="post">
                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="2" class="text-center text-title">ĐĂNG TIN TỨC MỚI</th>

                                </tr>
                                <tr>
                                    <td align="right">Tên tiêu đề</td>
                                    <td><input class="form-control" require type="text" name="txtTieuDe" id="txtTieuDe"
                                            placeholder="Nhập tên tiêu đề" value="<?php if (isset($_GET['txtTieuDe'])) {
                             echo $_GET['txtTieuDe'];
                            } ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td align="right">Hình ảnh</td>
                                    <td>
                                        <input require type="file" name="fileToUpload" id="fileToUpload" value="<?php if (isset($_GET['fileToUpload'])) {
                             echo $_GET['fileToUpload'];
                            } ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">Nội dung</td>
                                    <td><textarea class="form-control" require name="txtNoiDung" id="textile-demo"
                                            cols="80" rows="5" placeholder="Nội dung..."><?php if (isset($_GET['txtNoiDung'])) {
                                    echo $_GET['txtNoiDung'];
                                 } ?></textarea>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">
                                        <button type="submit" class="btn btn-primary">
                                            Đăng tin tức
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
                        <h2>Quản lý tin tức</h2>
                    </div>
                    <table id="tbTinTuc" class="table table-bordered table-striped text-center">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung</th>
                                <th width="15%">Tùy Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($arrtt as $tt) :
                            $ID_tt = $tt->layID();
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($ID_tt) ?></td>
                                <td>
                                    <img src="../../../img/upload/<?= $tt->hinhanh?>" alt="" width="100px"
                                        height="100px">
                                </td>
                                <td class="ttxoa"><?= htmlspecialchars($tt->tieude) ?></td>
                                <td><?= $fm->textShorten(htmlspecialchars($tt->noidung),100)?></td>
                                <td>
                                    <a class="btn btn-sm btn-danger" id="btn-del"
                                        href="delete.php?id=<?= $tt->layID()?>"><i class="fa fa-trash"
                                            aria-hidden="true">
                                            XÓA</i></a>
                                    <a id="edit" class="btn btn-sm btn-warning" href="edit.php?id=<?= $tt->layID()?>"><i
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
    <?php if (isset($_GET['id'])) : ?>
    <div class="flash-data" data-flashdata="<?= $_GET['id'];?>"></div>
    <?php endif; ?>
    <!-- =========== Scripts =========  -->
    <script src="../assets/js/main.js"></script>
    <script src="../../../js/sweetalert2.all.min.js"></script>
    <script src="../../../js/jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>
    <script>
    $(document).ready(function() {
        $('#tbTinTuc').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json",
            },
        });
    });
    $('#btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: 'Bạn có muốn xoá?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xoá',
            cancelButtonText: 'Huỷ',
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        })
    })

    const flashdata = $('.flash-data').data('flashdata')
    if (flashdata) {
        Swal.fire({
            icon: 'success',
            text: 'Xoá tin tức thành công'
        })
    }

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
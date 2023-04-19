<?php
include "../bootstrap.php";

use ct466\Nhakhoa\Tintuc;
$tt = new Tintuc($PDO);
$tukhoa = $_POST['tukhoa'];
$arr = $tt->search($tukhoa);
?>
<?php
   session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="css/style.css" rel=" stylesheet">
    <title>Win Smile</title>
</head>

<body>
    <main class="pl-2">
        <?php
        include __DIR__."/../partials/nav.php";
        ?>
        <section class="row">
            <div class="container">
                <p class="text-contact text-center mt-3" style="font-size: 36px">Tin Tức / Sự Kiện</p>
                <p class="text-center">Các Tin Tức / Sự Kiện nổi bật của hệ thống Nha Khoa Thẩm Mỹ Quốc Tế WinSmile.
                </p>
                <div class="row p-3">
                    <?php foreach($arr as $tt):?>
                    <div class="col-sm-3 col-xs-6 p-2">
                        <div class="card bg-light shadow" style="width: 14rem; height: 18rem;">
                            <a href="chitiettintuc.php?id=<?= $tt->layId()?>" class="text-decoration-none">
                                <img src="img/upload/<?= $tt->hinhanh?>" class="card-img-top" height="150px">
                                <span>Xem thêm</span>
                                <div class="card-body">
                                    <p class="text-contact"><?= $tt->tieude?></p>
                                </div>
                            </a>

                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </section>
        <?php
        include __DIR__."/../partials/footer.php";
        ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
</body>

</html>
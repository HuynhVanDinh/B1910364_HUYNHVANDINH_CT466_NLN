<?php
include "../bootstrap.php";

use ct466\Nhakhoa\Nhasi;
use ct466\Nhakhoa\User;

$ns = new Nhasi($PDO);
$user = new User($PDO);
$arr = $ns->all();
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
                <p class="text-contact text-center mt-3" style="font-size: 36px">Thông tin các nha sĩ của hệ thống Win
                    smile</p>
                <p class="text-center">Win Smile tập trung cung cấp các dịch vụ nha khoa thẩm mỹ trong môi trường nhẹ
                    nhàng, chu đáo, chuyên nghiệp. Đảm bảo mọi khách hàng tới Win Smile đều có những trải nhiệm nha khoa
                    đẳng cấp, ưng ý nhất cho đường cười của chính mình.
                </p>
                <div class="row p-3">
                    <?php
                        $anh_ns = $user->user_ns($ns->getMaNS());
                        foreach($anh_ns as $user):
                            $kq = $user->p_p;
                        endforeach;
                        foreach($arr as $ns):
                        ?>

                    <div class="col-sm-3 col-xs-6 p-2">
                        <div class="card bg-light shadow" style="width: 14rem; height: 18rem;">
                            <a href="chitietnhasi.php?id=<?= $ns->getMaNS();?>" class="text-decoration-none"><img
                                    src="img/upload/<?= $kq?>" class="card-img-top" height="150px">
                                <span>Xem thêm</span>
                                <div class="card-body">
                                    <p class="text-contact">Ns. <?= $ns->tenns?></p>
                                </div>
                            </a>


                        </div>
                    </div>
                    <?php
                 endforeach;?>
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
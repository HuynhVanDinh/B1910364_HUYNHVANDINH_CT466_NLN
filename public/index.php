<?php
include "../bootstrap.php";
session_start();
use ct466\Nhakhoa\Tintuc;
$tt = new Tintuc($PDO);
$arr = $tt->all();
use ct466\Nhakhoa\Nhasi;
use ct466\Nhakhoa\User;

$ns = new Nhasi($PDO);
$user = new User($PDO);
$arr_ns= $ns->all();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="css/style.css" rel=" stylesheet">
    <title>Win Smile</title>
</head>

<body>
    <main>
        <?php
        include __DIR__."/../partials/nav.php";
        ?>
        <section class="row">
            <div id="carouselExampleCaptions" class="carousel slide col" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/bg-1.png" class="d-block w-100" alt="..." height="650">
                    </div>
                    <div class="carousel-item">
                        <img src="img/bg-3.png" class="d-block w-100" alt="..." height="650">
                    </div>
                    <div class="carousel-item">
                        <img src="img/bg-2.png" class="d-block w-100" alt="..." height="650">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
        </section>
        <div class="row">
            <div class="col-lg-7 col-sm-12 mt-5">
                <div class="col-md-10 offset-md-2">
                    <p class="text-contact">Triết lý tại Winsmile</p>
                    <p class="mb-5">Tôn chỉ của Win Smile là giúp đỡ khách hàng có 1 cuộc sống mới thông qua nụ cười
                        mới. Chúng tôi luôn chú trọng quan tâm đến vấn đề sức khỏe và thẩm mỹ của khách hàng trước khi
                        quyết định sử dụng dịch vụ của Win Smile. Win Smile tự hào là điểm đến của các doanh nhân, chủ
                        doanh nghiệp, người nổi tiếng. Bằng các kỹ thuật, công nghệ tiên tiến bậc nhất. Win Smile cùng
                        đội ngũ bác sĩ lành nghề với nhiều năm kinh nghiệm sẽ đáp ứng hoàn hảo với những yếu tố thẩm mỹ
                        khắt khe của mọi khách hàng.</p>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 mt-5">
                <img src="img/anh-contact.png" alt="">
            </div>
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
                        foreach($arr_ns as $ns):
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
        </div>
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
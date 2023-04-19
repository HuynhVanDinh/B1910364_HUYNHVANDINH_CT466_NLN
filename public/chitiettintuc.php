<?php
include "../bootstrap.php";

use ct466\Nhakhoa\Tintuc;
$cn = new TinTuc($PDO);
    if(isset($_GET["id"])){
        $cn->find($_GET["id"]);
    }
    else{
        header("location: index.php");
    }
?>
<?php
   session_start();
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
    <main class="pl-2">
        <?php
        include __DIR__."/../partials/nav.php";
        ?>
        <section class="row mt-2">
            <div class="container mt-3 mb-3">
                <div class="row">
                    <div class="col-5">
                        <img src="img/upload/<?= $cn->hinhanh?>" alt="" class="w-100">
                    </div>
                    <div class="col-7">
                        <h5 class="text-contact"><b><?=$cn->tieude?></b></h5>
                        <h6><?= $cn->noidung?></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-sm-12 mt-5">
                <div class="col-md-10 offset-md-2">
                    <p class="text-contact">Đến với nha khoa thẩm mỹ Quốc tế WinSmile</p>
                    <p class="mb-5">Trải nghiệm sự khác biệt đến từ đội ngũ chuyên nghiệp.</p>
                    <form>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input type="text" class="form-control" id="name" placeholder="Họ và tên*">
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="email" class="form-control" id="email"
                                    placeholder="Số điện thoại liên hệ*">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input type="text" class="form-control" id="name" placeholder="Email liên hệ*">
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="email" class="form-control" id="email" placeholder="Chọn cơ sở gần bạn*">
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" id="message" rows="3" placeholder="Lời nhắn"></textarea>
                        </div>
                        <p style="font-size: 14px;">* Thông tin của bạn sẽ được bảo mật!</p>
                        <button type="submit" class="btn btn_yellow">GỬI THÔNG TIN</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 mt-5">
                <img src="img/anh-contact.png" alt="">
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
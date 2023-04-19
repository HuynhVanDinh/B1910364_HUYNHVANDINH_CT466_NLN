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
    <style>
    .text-contact {
        color: #cf9a2c;
        font-size: 28px;
    }

    .nav-h {
        background: #cf9a2c;
    }

    .btn_yellow {
        position: relative;
        overflow: hidden;
        display: inline-block;
        height: 40px;
        line-height: 40px;
        padding: 0 30px;
        color: #FFF;
        text-transform: uppercase;
        font-size: 16px;
        font-family: "SVN-GothamBold";
        border-radius: 20px;
        background: #cf9a2c;
        transition: all .3s;
    }

    .form-control {
        border-radius: 20px;
        height: 40px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .text-title {
        color: #cf9a2c;
        font-size: 20px;
    }

    .box-footer {
        padding: 30px 0 30px;
        background: #f7f7f7;
    }

    .ft-page {
        padding: 20px 0 20px;
        position: relative;
        background: #eeeeee;
        color: #6a6a6a;
        font-size: 14px;
        text-align: center;
    }

    .logo {
        border-radius: 50%;
    }

    .vetoi-page {
        background: url(/img/cover-vetoi.jpg) no-repeat center center;
        background-size: cover;
    }
    </style>
</head>

<body>
    <main>
        <?php
        include __DIR__."/../partials/nav.php";
        ?>
        <section class="row">
            <div class="vetoi-page w-100">
                <div class="container">
                    <p class="text-contact mt-5">WinSmile - Thành công từ những nụ cười.</p>
                    <p class="text-white">Win Smile hiểu rằng, mỗi khách hàng đến với chúng tôi luôn có 1 câu chuyện
                        riêng, một nhu cầu và
                        mong muốn riêng.</p>

                    <p class="text-light mb-5">Thấu hiểu được tâm lý đó Win Smile lựa chọn giải pháp tối ưu cho khách
                        hàng trong quá trình tư
                        vấn
                        nha khoa thẩm mỹ. Đặc biệt, chúng tôi tự hào rằng các kỹ thuật thẩm mỹ nha của Win Smile được
                        cập
                        nhật thường xuyên, là công nghệ tiên tiến và mới nhất trên thế giời, bảo toàn răng gốc tối đa,
                        an
                        toàn, bêng vững theo thời gian. Hữu xạ tự nhiên hương đó cũng là lý do vì sao Win Smile lại có
                        tỷ lệ
                        giới thiệu khách hàng từ khách hàng cũ cao nhất trong giới nha khoa thẩm mỹ.

                        Với mong muốn đồng hành cùng nụ cười doanh nhân, Win Smile luôn đặt quan điểm khách hàng là
                        trọng
                        tâm của sự phát triển, trách nhiệm, sự bền vững và uy tín nhằm mang đến vẻ đẹp an toàn, bền vững
                        cho
                        khách hàng.</p>
                </div>
            </div>
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
            <div class="col-lg-5 col-sm-12 ">
                <img src="img/su-menh.png" alt="">
            </div>
            <div class="col-lg-7 col-sm-12">
                <div class="col-md-10">
                    <p class="text-contact">Sứ mệnh Winsmile</p>
                    <p class="mb-5">Win Smile khao khát xây dựng đội ngũ nhân viên, y bác sĩ phục vụ tận tâm, trách
                        nhiệm đảm bảo yếu tố an toàn và chuyên nghiệp trong từng dịch vụ</p>
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
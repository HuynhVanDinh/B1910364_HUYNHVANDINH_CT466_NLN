<?php
   session_start();
   include  "../bootstrap.php";
   use ct466\Nhakhoa\Lienhe;
   $errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lienhe = new Lienhe($PDO);
    $kq = $lienhe->fill($_POST);
    if($kq->validate()){
        $kq->save();
        echo '<script>alert("Đã gửi liên hệ. Chúng tôi sẽ phản hồi bạn nhanh nhất");</script>';
    } else {
        $errors = $kq->getValidationErrors();
        if (isset($errors['txtHoten'])) {
            echo '<script>alert("Tên không được để trống.");</script>';
        } else{
            if (isset($errors['txtEmail'])) {
                echo '<script>alert("Email không được để trống.");</script>';
            } else {
                if (isset($errors['txtDienthoai'])) {
                    echo '<script>alert("Số điện thoại không được để trống.");</script>';
                } else{
                    if (isset($errors['txtCoso'])) {
                    echo '<script>alert("Cơ sở không được để trống.");</script>';
                    } else{
                        if (isset($errors['txtLoinhan'])) {
                        echo '<script>alert("Lời nhắn không được để trống.");</script>';
                        }      
                    }
 
                }
               
            }

        }

    }   
}
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
    <main>
        <?php
        include __DIR__."/../partials/nav.php";
        ?>
        <section class="row">
            <div class="col-lg-7 col-sm-12 mt-5">
                <div class="col-md-10 offset-md-2">
                    <p class="text-contact">Đến với nha khoa thẩm mỹ Quốc tế WinSmile</p>
                    <p class="mb-5">Trải nghiệm sự khác biệt đến từ đội ngũ chuyên nghiệp.</p>
                    <form action="lienhe.php" method="post">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input type="text" class="form-control" id="name" name="txtHoten"
                                    placeholder="Họ và tên*" require>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input type="text" class="form-control" id="sdt" name="txtDienthoai"
                                    placeholder="Số điện thoại liên hệ*" require>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input type="email" class="form-control" id="email" name="txtEmail"
                                    placeholder="Email liên hệ*" require>
                            </div>
                            <div class="col-sm-6 form-group">
                                <select name="txtCoso" id="coso" class="form-control" require>
                                    <option value="Hà Nội">Chọn cơ sở gần bạn*</option>
                                    <option value="Tp. Hồ Chí Minh">Tp. Hồ Chí Minh</option>
                                    <option value="Hà Nội">Hà Nội</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" id="message" name="txtLoinhan" rows="3"
                                placeholder="Lời nhắn*" require></textarea>
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
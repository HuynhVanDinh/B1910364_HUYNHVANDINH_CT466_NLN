<?php
include "../bootstrap.php";

use ct466\Nhakhoa\Benhnhan;
$Benhnhan = new Benhnhan($PDO);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="css/login.css" rel=" stylesheet">
    <style>
    .gender-label {
        margin-right: 20px;
        margin-left: 30px;
        font-weight: bold;
        color: #666;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
    }

    .form-check-inline {
        display: inline-block;
        margin-right: 1rem;
    }
    </style>
    <title>Win smile</title>
</head>

<body>
    <div class="container">
        <div class="signin-signup">
            <form action="process_login.php" method="post" class="sign-in-form">
                <div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">
                    <a href="index.php"><img src="img/winsmile.jpg" width="150" height="150"></a>
                </div>
                <h2 class="title display-4 fs-1 
	 		           text-center">Đăng nhập</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Số CMND/CCCD" name="username" id="username" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Mật khẩu" name="password" id="password" required>
                </div>
                <button type="submit" name="submit" id="submit" value="Đăng nhập" class="btn btn-primary">
                    ĐĂNG NHẬP</button>
                <p class="account-text">Chưa có tài khoản, đăng ký tại đây? <a href="#" id="sign-up-btn2">Đăng ký</a>
                </p>
            </form>
            <form action="process_logup.php" method="post" class="sign-up-form">
                <h2 class="title">Đăng ký</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="hoten" id="hoten" placeholder="Họ và tên">
                </div>
                <div class="input-field">
                    <label for="gioitinh" class="gender-label">Giới tính:</label>
                    <div class="form-check form-check-inline" style="margin-right: 20px;">
                        <input class="form-check-input" type="radio" name="gioitinh" id="nam" value="nam">
                        <label class="form-check-label" for="male">
                            <i class="fas fa-mars"></i> Nam
                        </label>
                    </div>
                    <div class="form-check form-check-inline" style="margin-right: 20px;">
                        <input class="form-check-input" type="radio" name="gioitinh" id="nữ" value="nữ">
                        <label class="form-check-label" for="female">
                            <i class="fas fa-venus"></i> Nữ
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gioitinh" id="khác" value="other">
                        <label class="form-check-label" for="other">
                            <i class="fas fa-transgender-alt"></i> Khác
                        </label>
                    </div>
                </div>
                <div class="input-field">
                    <!-- <i class="fas fa-calendar"></i> -->
                    <label class="gender-label" for="namsinh">Năm sinh:</label>
                    <select id="namsinh" name="namsinh">
                        <option value="">-- Chọn năm sinh --</option>
                        <?php for ($i = date('Y'); $i >= 1900; $i--) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-field">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" id="diachi" name="diachi" placeholder="Nhập địa chỉ của bạn...">
                </div>
                <div class="input-field">
                    <i class="fas fa-phone"></i>
                    <input type="sdt" id="sdt" name="sdt" placeholder="Số điện thoại">
                </div>
                <div class="input-field">
                    <i class="fas fa-id-card"></i>
                    <input type="text" id="cmnd" name="cmnd" placeholder="Nhập số CMND của bạn...">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Mật khẩu">
                </div>

                <input type="submit" id="submit" value="ĐĂNG KÝ" class="btn">
                <p class="account-text">Đã có tài khoản, đăng nhập tại đây? <a href="#" id="sign-in-btn2">Đăng nhập</a>
                </p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Trở lại!</h3>
                    <p>Bạn đã có tài khoản, vui lòng đăng nhập tại đây.</p>
                    <button class="btn" id="sign-in-btn">Đăng nhập</button>
                </div>
                <img src="img/doctor.svg" alt="" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Xin chào, bạn!</h3>
                    <p>Nếu chưa có tài khoản, vui lòng đăng ký tại đây.</p>
                    <button class="btn" id="sign-up-btn">Đăng ký</button>
                </div>
                <img src="img/nure.svg" alt="" class="image">
            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
</body>

</html>
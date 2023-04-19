<?php
include __DIR__."/../../../bootstrap.php";

use ct466\Nhakhoa\User;
$user = new User($PDO);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Win Smile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    .bg-nk {
        background-size: cover;
        background-repeat: no-repeat;
        background-image: url(../../../img/background2.jpg);
    }
    </style>
</head>

<body class="d-flex
             justify-content-center
             align-items-center
             vh-100 bg-nk">
    <div class="w-500 p-5 shadow rounded bg-white">
        <form id="login-form" method="post" action="process_login.php">
            <div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

                <img src="../../img/winsmile.jpg" width="100" height="100">
                <!-- <h3 class="display-4 fs-1 
	 		           text-center">
                    LOGIN</h3> -->


            </div>
            <div class="mb-3">
                <label class="form-label">
                    Tên đăng nhập</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Mật khẩu</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <button type="submit" name="submit" value="Đăng nhập" class="btn btn-primary float-right active">
                Đăng nhập</button>
            <a href="../index.php" class="btn btn-danger float-right mr-2" role="button">Huỷ</a>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
include  "../bootstrap.php";
    use ct466\Nhakhoa\Benhnhan;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$newbenhnhan = new Benhnhan($PDO);
    $findUser = $newbenhnhan->findUsername($_POST['cmnd']);
	$newbenhnhan->fill1($_POST);
    if($findUser->tk_dangnhap != $_POST['cmnd']){
        if ($newbenhnhan->validate()) {
            $newbenhnhan->save(); 
            echo '<script>alert("Đăng ký thành công.");</script>';
            echo '<script>window.location.href= "login.php";</script>';
        } $errors = $newbenhnhan->getValidationErrors();
        if (isset($errors['hoten'])) {
            $diachi = $_POST['diachi'];
            $namsinh= $_POST['namsinh'];
            $sdt= $_POST['sdt'];
            $cmnd= $_POST['cmnd'];
            echo '<script>alert("Tên bệnh nhân không được rỗng.");</script>';
            echo "<script>window.location.href= 'login.php?diachi=$diachi&namsinh=$namsinh&sdt=$sdt&cnmd=$cmnd';</script>";
        }
        if (isset($errors['diachi'])) {
            $hoten = $_POST['hoten'];
            $namsinh= $_POST['namsinh'];
            $sdt= $_POST['sdt'];
            $cmnd= $_POST['cmnd'];
            echo '<script>alert("Địa chỉ không được rỗng.");</script>';
            echo "<script>window.location.href= 'login.php?hoten=$hoten&namsinh=$namsinh&sdt=$sdt&cnmd=$cmnd';</script>";
        }
        if (isset($errors['namsinh'])) {
            $diachi = $_POST['diachi'];
            $hoten= $_POST['hoten'];
            $sdt= $_POST['sdt'];
            $cmnd= $_POST['cmnd'];
            echo '<script>alert("Năm sinh không được rỗng.");</script>';
            echo "<script>window.location.href= 'login.php?diachi=$diachi&hoten=$hoten&sdt=$sdt&cnmd=$cmnd';</script>";
        }
        if (isset($errors['sdt'])) {
            $diachi = $_POST['diachi'];
            $namsinh= $_POST['namsinh'];
            $hoten= $_POST['hoten'];
            $cmnd= $_POST['cmnd'];
            echo '<script>alert("Số điện thoại không hợp lệ.");</script>';
            echo "<script>window.location.href= 'login.php?diachi=$diachi&namsinh=$namsinh&hoten=$hoten&cnmd=$cmnd';</script>";
        }
        if (isset($errors['cmnd'])) {
            $diachi = $_POST['diachi'];
            $namsinh= $_POST['namsinh'];
            $hoten= $_POST['hoten'];
            $sdt= $_POST['sdt'];
            echo '<script>alert("Số cmnd không hợp lệ.");</script>';
            echo "<script>window.location.href= 'login.php?diachi=$diachi&namsinh=$namsinh&hoten=$hoten&sdt=$sdt';</script>";
        }
    }else {
				echo '<script>alert("Đăng ký không thành công, Tài khoản (CCCD) đã tồn tại.");</script>';
				echo '<script>window.location.href= "login.php";</script>';
			}
}
?>
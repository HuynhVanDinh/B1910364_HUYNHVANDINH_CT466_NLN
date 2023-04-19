<?php
    include __DIR__."/../../../bootstrap.php";
    use ct466\Nhakhoa\User;
    use ct466\Nhakhoa\Nhanvien;

    $newNV = new Nhanvien($PDO);
    $newTK = new User($PDO);
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $findUser = $newTK->findUsername($_POST['username']);
        $newTK->fill($_POST); 
        if($findUser->username != $_POST['username']){
            if($newTK->validate()){
                $newTK->save2();
                } $errors = $newTK->getValidationErrors();
            if (isset($errors['username'])) {
                $username = $_POST['username'];
                echo '<script>alert("Tên đăng nhập/cccd không hợp lệ.");</script>';
                echo '<script>window.location.href= "ql_nhanvien.php";</script>';
            } 
            if (isset($errors['password'])) {
                $username = $_POST['password'];
                echo '<script>alert("Mật khẩu/số điện thoại không hợp lệ.");</script>';
                echo '<script>window.location.href= "ql_nhanvien.php";</script>';
            } 
        }else {
				echo '<script>alert("Thêm không thành công, Tài khoản (CCCD) đã tồn tại.");</script>';
				echo '<script>window.location.href= "ql_nhanvien.php";</script>';
			}
       
        $id = $newTK->getId();
        $newNV->fill($_POST,$id); 
        if($newNV->validate()){
            $newNV->save();  
        }        
       header("Location: ql_nhanvien.php");
        
    }
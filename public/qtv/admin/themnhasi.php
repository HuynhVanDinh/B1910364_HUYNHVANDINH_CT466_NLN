<?php
    include __DIR__."/../../../bootstrap.php";
    use ct466\Nhakhoa\User;
    use ct466\Nhakhoa\Nhasi;

    $newNS = new Nhasi($PDO);
    $newTK = new User($PDO);
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $findUser = $newTK->findUsername($_POST['username']);
        $newTK->fill($_POST); 
        if($findUser->username != $_POST['username']){
            if($newTK->validate()){
                $newTK->save();
                } $errors = $newTK->getValidationErrors();
            if (isset($errors['username'])) {
                $username = $_POST['username'];
                echo '<script>alert("Tên đăng nhập/cccd không hợp lệ.");</script>';
                echo '<script>window.location.href= "ql_nhasi.php";</script>';
            } 
            if (isset($errors['password'])) {
                $username = $_POST['password'];
                echo '<script>alert("Mật khẩu/số điện thoại không hợp lệ.");</script>';
                echo '<script>window.location.href= "ql_nhasi.php";</script>';
            } 
        }else {
				echo '<script>alert("Thêm không thành công, Tài khoản (CCCD) đã tồn tại.");</script>';
				echo '<script>window.location.href= "ql_nhasi.php";</script>';
			}
       
        $id = $newTK->getId();
        $newNS->fill($_POST,$id);
        if($newNS->validate()){
            $newNS->save();  
        }        
       header("Location: ql_nhasi.php");
        
    }
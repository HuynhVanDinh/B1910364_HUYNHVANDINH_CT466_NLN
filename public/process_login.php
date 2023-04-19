<?php
session_start();
include  "../bootstrap.php";
use ct466\Nhakhoa\Benhnhan;

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $benhnhan = new Benhnhan($PDO);
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $row = $benhnhan->checkpoint($username,$password);
    $results = $benhnhan->checkpoint2($username,$password);
    //  var_dump($results['trangthai']);
    if(!$results){
        echo '<script>alert("Tài khoản không tồn tại. Vui lòng nhập lại!!!");</script>';
                echo '<script>window.location.href= "login.php";</script>';

    }else {
         if ($results['trangthai'] == 0) {
                echo '<script>alert("Tài khoản bạn đã bị vô hiệu hoá.");</script>';
                echo '<script>window.location.href= "login.php";</script>';
        } else{
            if($row > 0){
                $_SESSION["id_benhnhan"] =  $results['MaBN'];
            
            } else {
                unset($_SESSION["id_benhnhan"]);
            }
            
            if(isset($_SESSION["id_benhnhan"])){
                    header("Location: index.php");
            }else {
                echo '<script>alert("Đăng nhập thất bại!!! Vui lòng kiểm tra lại.");</script>';
                echo '<script>window.location.href= "login.php";</script>';
            }
        }
    }  
}
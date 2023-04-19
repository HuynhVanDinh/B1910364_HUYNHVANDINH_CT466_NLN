<?php
session_start();
include __DIR__. "/../../../bootstrap.php";
require_once __DIR__. "/../../../bootstrap.php";
use ct466\Nhakhoa\User;

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = new User($PDO);
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $row = $user->checkpoint($username,$password);
    $results = $user->checkpoint2($username,$password);
    // var_dump($results);
    if ($results['status'] == 0) {
            echo '<script>alert("Tài khoản bạn đã bị vô hiệu hoá.");</script>';
            echo '<script>window.location.href= "dangnhap.php";</script>';
    } else{
        if($row > 0){
            $_SESSION["id_user"] =  $results['user_id'];
        
        } else {
            unset($_SESSION["id_user"]);
        }
        
        if(isset($_SESSION["id_user"])){

           if ($results['role'] == 3) {
                header("Location: index.php");
            } elseif ($results['role'] != 3){
                unset($_SESSION['id_user']);
                echo '<script>alert("Bạn không có quyền đăng nhập trang này");</script>';
                echo '<script>window.location.href= "dangnhap.php";</script>';
                }else header("Location: index.php");
            
        }else {
            echo '<script>alert("Đăng nhập thất bại!!! Vui lòng kiểm tra lại.");</script>';
            echo '<script>window.location.href= "dangnhap.php";</script>';
        }
    }
       
    
    
}
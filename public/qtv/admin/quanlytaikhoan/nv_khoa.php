<?php 
include __DIR__."/../../../../bootstrap.php";

use ct466\Nhakhoa\User;
$user = new User($PDO);

$id = $_GET['user_id'];
$finduser = $user->find($id);
if ($finduser != null) {
	$array = [];
	$array['status'] = $finduser->status;
	$result = $user->update1($array);
	if ($result == true) {
		// echo '<script>alert("Bạn đã khoá tài khoản này.");</script>';
		echo "<script>window.location.href= 'tk_nhanvien.php?user_id=$id';</script>";
	} else {
		echo '<script>alert("Không thể khoá tài khoản này.");</script>';
		echo '<script>window.location.href= "tk_nhanvien.php";</script>';
	}
} else {
	echo '<script>alert("Không thể khoá tài khoản này.");</script>';
	echo '<script>window.location.href= "tk_nhanvien.php";</script>';
}

?>
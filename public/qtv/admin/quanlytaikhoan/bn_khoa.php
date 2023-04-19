<?php 
include __DIR__."/../../../../bootstrap.php";

use ct466\Nhakhoa\Benhnhan;
$benhnhan = new Benhnhan($PDO);

$id = $_GET['user_id'];
$finduser = $benhnhan->find($id);
if ($finduser != null) {
	$array = [];
	$array['trangthai'] = $finduser->trangthai;
	$result = $benhnhan->update1($array);
	if ($result == true) {
		echo '<script>alert("Bạn đã khoá tài khoản này.");</script>';
		echo '<script>window.location.href= "index.php";</script>';
	} else {
		echo '<script>alert("Không thể khoá tài khoản này.");</script>';
		echo '<script>window.location.href= "index.php";</script>';
	}
} else {
	echo '<script>alert("Không thể khoá tài khoản này.");</script>';
	echo '<script>window.location.href= "index.php";</script>';
}

?>
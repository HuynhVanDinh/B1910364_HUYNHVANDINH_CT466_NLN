<?php  
 include __DIR__."/../../../../bootstrap.php";
use ct466\Nhakhoa\Tintuc;
$errors = [];
$tt = new Tintuc($PDO);
if ((isset($_GET['id'])) && ($tt->find($_GET['id'])) !== NULL) {
    $id =$_GET['id'];
	if ($tt->delete() == null) {
		echo '<script>window.location.href= "index.php";</script>';
	} else {
	echo "<script>window.location.href= 'index.php?id=$id';</script>";}
}
?>
<?php
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\Lichhen;
$lichhen = new Lichhen($PDO);
// lấy ID của bản ghi lichhen để phê duyệt
$id_lichhen = $_GET['id'];
// lấy thông tin lichhen đã được phê duyệt
$lichhen_duyet = $lichhen->find($id_lichhen);
//  var_dump($lichhen_duyet);
// lấy số điện thoại của người nhận từ bảng thông tin khách hàng
 $sdt_nguoinhan = $lichhen_duyet->sdt;
// var_dump($lichhen_duyet);
// gửi tin nhắn SMS xác nhận đến số điện thoại của người nhận
require_once __DIR__."/../../../vendor/autoload.php";
use Twilio\Rest\Client;

$account_sid = 'ACcb3155479cd3c9cc2e61ec352b183571';
$auth_token = '69ad50ff1c16be4e0713bb4a3fb26200'; 
$twilio_number = '+16205319802'; 

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    "+84".$sdt_nguoinhan,
    array(
        'from' => $twilio_number,
        'body' => 'Lịch hẹn của bạn đã được phê duyệt. Vui lòng đến phòng khám đúng hẹn'
    )
);
if ((isset($_GET['id'])) && ($lichhen->find($_GET['id'])) !== NULL) {
    $lichhen->duyet();
    echo '<script>alert("Duyệt lịch hẹn thành công và đã gửi tin nhắn SMS xác nhận đến khách hàng.");</script>';
    echo "<script>window.location.href= 'ql_lichhen.php';</script>";
}
?>
<?php
include __DIR__."/../../../bootstrap.php";
use ct466\Nhakhoa\Lichhen;
use ct466\Nhakhoa\Benhnhan;
$benhnhan= new Benhnhan($PDO);
$lichhen = new Lichhen($PDO);
// lấy ID của bản ghi lichhen để phê duyệt
$id_lichhen = $_GET['id'];
// lấy thông tin lichhen đã được phê duyệt
$lichhen_duyet = $lichhen->find($id_lichhen);
$ten_benhnhan = $benhnhan->find($lichhen_duyet->find($id_lichhen)->id_benhnhan)->hoten;
//  var_dump($lichhen_duyet);
// lấy số điện thoại của người nhận từ bảng thông tin khách hàng
 $sdt_nguoinhan = $lichhen_duyet->sdt;
// var_dump($lichhen_duyet);
// gửi tin nhắn SMS xác nhận đến số điện thoại của người nhận
require_once __DIR__."/../../../vendor/autoload.php";
use Twilio\Rest\Client;
if($sdt_nguoinhan == "0342303842") {
    $account_sid = 'ACcb3155479cd3c9cc2e61ec352b183571';
    $auth_token = '8298b859e3a851b349829607cf9a3151'; 
    $twilio_number = '+16205319802'; 

    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
        "+84".$sdt_nguoinhan,
        array(
            'from' => $twilio_number,
            'body' => "Xin chào, $ten_benhnhan, Nha khoa WinSmile xin thông báo. Lịch hẹn của bạn đã được phê duyệt. Vui lòng đến phòng khám đúng hẹn ($lichhen_duyet->ngayhen). Trân trọng !!!"
        )
    );
    if ((isset($_GET['id'])) && ($lichhen->find($_GET['id'])) !== NULL) {
        $lichhen->duyet();
        echo '<script>alert("Duyệt lịch hẹn thành công và đã gửi tin nhắn SMS xác nhận đến khách hàng.");</script>';
        echo "<script>window.location.href= 'ql_lichhen.php';</script>";
    }
} else {
    if ((isset($_GET['id'])) && ($lichhen->find($_GET['id'])) !== NULL) {
        $lichhen->duyet();
        echo '<script>alert("Duyệt lịch hẹn thành công");</script>';
        echo "<script>window.location.href= 'ql_lichhen.php';</script>";
    }
}

?>
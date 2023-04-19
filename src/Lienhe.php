<?php 
namespace ct466\Nhakhoa;
use PDO;
class Lienhe{
    private PDO $db;
    private $id = -1;
    public $hoten, $dthoai;
    public $email, $coso, $loinhan;

    public function layID(){
        return $this->id;
    }
    public function __construct(PDO $pdo){
        $this->db = $pdo;
    }
    
    protected function fillFromDB(array $row){
		[
			'id' => $this->id,
			'hoten' => $this->hoten,
			'dthoai' => $this->dthoai,
			'email' => $this->email,
            'coso' => $this->coso,
            'loinhan' => $this->loinhan
		] = $row;
	    return $this;
	}

	public function fill(array $data){
		if(isset($data['txtHoten'])){
			$this->hoten = trim($data['txtHoten']);
		}
		if(isset($data['txtDienthoai'])){
			$this->dthoai = trim($data['txtDienthoai']);
		}
		if(isset($data['txtEmail'])){
			$this->email = trim($data['txtEmail']);
		}
        if(isset($data['txtCoso'])){
			$this->coso = trim($data['txtCoso']);
		}
        if(isset($data['txtLoinhan'])){
			$this->loinhan = trim($data['txtLoinhan']);
		}
		return $this;
	}


    public function getValidationErrors()
	{
		return $this->errors;
	}
 
    public function validate()
	{
		if (!$this->hoten) {
			$this->errors['txtHoten'] = 'Họ tên không hợp lệ.';
		}
        if (!$this->dthoai) {
			$this->errors['txtDienthoai'] = 'Số điện không hợp lệ.';
		}
        if (!$this->email) {
			$this->errors['txtEmail'] = 'Email không hợp lệ.';
		}
		if (!$this->coso) {
			$this->errors['txtCoso'] = 'Cơ sở không hợp lệ.';
		}
        if (!$this->loinhan) {
			$this->errors['txtLoinhan'] = 'Nội dung không hợp lệ.';
		}
		return empty($this->errors);
	}
    public function all(){
		$Array = [];
		$stmt = $this->db->prepare('select * from lienhe');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
            $lienhe = new Lienhe($this->db);
            $lienhe->fillFromDB($row);
            $Array[] = $lienhe;
		}
		return $Array;
	}

	public function save(){
        $result = false;
            $sql = $this->db->prepare('insert into lienhe
            (hoten, email, dthoai, coso, loinhan)
			values (:hoten, :email, :dthoai, :coso, :loinhan)');
            $result = $sql->execute([
                'hoten' => $this->hoten,
                'email' => $this->email,
                'dthoai' => $this->dthoai,
               	'coso' => $this->coso,
				'loinhan' => $this->loinhan
            ]);
            if($result){
                $this->id = $this->db->lastInsertId();
        }
        return $result;
    }
}
?>
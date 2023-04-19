<?php
namespace ct466\Nhakhoa;

class Nhanvien{
    private $db;
    private $MaNV = -1;
    public $tennv;
    public $user_id;
    public $gtinh;
    public $nsinh;
    public $sodt;
    public $cccd;
    public $dc;
    public $errors = [];

    public  function __construct($pdo){
        $this->db = $pdo;
    }

    public function getMaNV()
    {
        return $this->MaNV;
    }

    public function fill(array $data, $tk_id)
    {
        if(isset($data['fullname'])){
            $this->tennv = trim($data['fullname']);
        }
        if(isset($data['gtinh'])){
            $this->gtinh = trim($data['gtinh']);
        }
        if(isset($data['nsinh'])){
            $this->nsinh = trim($data['nsinh']);
        }
        if(isset($data['password'])){
            $this->sodt = trim($data['password']);
        }
        if(isset($data['username'])){
            $this->cccd = trim($data['username']);
        }
        if(isset($data['dc'])){
            $this->dc = trim($data['dc']);
        }
        $this->user_id = $tk_id;
        return $this;
    
    }
    public function fill2(array $data)
    {
        if(isset($data['tennv'])){
            $this->tennv = trim($data['tennv']);
        }
        if(isset($data['gtinh'])){
            $this->gtinh = trim($data['gtinh']);
        }
        if(isset($data['nsinh'])){
            $this->nsinh = trim($data['nsinh']);
        }
        if(isset($data['password'])){
            $this->sodt = trim($data['password']);
        }
        if(isset($data['cccd'])){
            $this->cccd = trim($data['cccd']);
        }
        if(isset($data['dc'])){
            $this->dc = trim($data['dc']);
        }
        return $this;
    
    }
        public function all()
	{
		$nhan_vien = [];
		$stmt = $this->db->prepare('select * from nhanvien');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$nhanvien = new Nhanvien($this->db);
			$nhanvien->fillFromDB($row);
			$nhan_vien[] = $nhanvien;
		} return $nhan_vien;
	}

    public function getValidationErrors()
	{
		return $this->errors;
	}
    public function validate()  
    {
        if(!$this->tennv){
            $this->erros['tennv'] ='Họ tên nhân viên không hợp lệ.';
        }
         if(!$this->gtinh){
            $this->erros['gtinh'] ='Giới tính nhân viên không hợp lệ.';
        }
         if(!$this->nsinh){
            $this->erros['nsinh'] ='Năm sinh nhân viên không hợp lệ.';
        }
         if(!$this->sodt){
            $this->erros['sodt'] ='Số điện thoại nhân viên không hợp lệ.';
        }
         if(!$this->cccd){
            $this->erros['cccd'] ='Số căn cước không hợp lệ.';
        }
         if(!$this->dc){
            $this->erros['dc'] ='Địa chỉ nhân viên không hợp lệ.';
        }
        return empty($this->errors);
    }
    protected function fillFromDB(array $row)
	{
		[
		'MaNV' => $this->MaNV,
        'user_id' => $this->user_id,
		'tennv' => $this->tennv,
		'gt' => $this->gtinh,
        'nsinh' => $this->nsinh,
        'dc' => $this->dc,
        'sodt' => $this->sodt,
        'cccd' => $this->cccd
		] = $row;
		return $this;
	}
    public function find($MaNV)
	{
		$stmt = $this->db->prepare('select * from nhanvien where MaNV = :MaNV');
		$stmt->execute(['MaNV' => $MaNV]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}
    public function findUser($user_id)
	{
		$stmt = $this->db->prepare('select * from nhanvien where  user_id= :user_id');
		$stmt->execute(['user_id' => $user_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}
    
    public function save()
	{
		$result = false;
		if ($this->MaNV > 0) {
			$stmt = $this->db->prepare('update nhanvien set tennv = :tennv,
			gt = :gtinh, nsinh = :nsinh, 
            dc = :dc, sodt = :sodt, cccd = :cccd
			where MaNV = :MaNV');
			$result = $stmt->execute([
			'tennv' => $this->tennv,
			'gtinh' => $this->gtinh,
            'nsinh' => $this->nsinh,
            'dc' => $this->dc,
            'sodt' => $this->sodt,
            'cccd' => $this->cccd,
			'MaNV' => $this->MaNV]);
		} else {
			$stmt = $this->db->prepare(
			'insert into nhanvien (tennv, user_id, gt, nsinh, dc, sodt, cccd)
			values (:fullname, :user_id, :gtinh, :nsinh, :dc, :password, :username)');
			$result = $stmt->execute([
			'fullname' => $this->tennv,
            'user_id'=> $this->user_id,
			'gtinh' => $this->gtinh,
            'nsinh' => $this->nsinh,
            'dc' => $this->dc,
            'password' => $this->sodt,
            'username' => $this->cccd]);
		if ($result) {
				$this->MaNV = $this->db->lastInsertId();
			}
		} 
		return $result;
	}

    //Cap nhat hoac them du lieu du lieu
	public function update(array $data)
	{
		$this->fill2($data);
		if ($this->validate()) {
			return $this->save();
		}
		return false;
	}

    public function delete()
	{
		$stmt = $this->db->prepare('delete from nhanvien where MaNV = :MaNV');
		return $stmt->execute(['MaNV' => $this->MaNV]);
	}
    public function so_nhanvien(){
		$stmt = $this->db->prepare("select count(*) as countNV from nhanvien");
		$stmt->execute();
		$row = $stmt->fetch();
		return $row["countNV"];
	}
}




?>
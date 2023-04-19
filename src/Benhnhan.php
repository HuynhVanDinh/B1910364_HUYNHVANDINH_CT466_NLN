<?php
namespace ct466\Nhakhoa;

class Benhnhan{
    private $db;
    private $MaBN = -1;
    public $hoten;
    public $tk_dangnhap;
    public $matkhau;
    public $trangthai;
    public $gioitinh;
    public $namsinh;
    public $diachi;
    public $sdt;
    public $cmnd;
    public $created_day;
    public $errors = [];

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getMaBN()
    {
        return $this->MaBN;
    }
	public function all()
	{
		$users = [];
		$stmt = $this->db->prepare('select * from benhnhan');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$user = new Benhnhan($this->db);
			$user->fillFromDB($row);
			$users[] = $user;
		} return $users;
	}

    public function fill(array $data)
    {
        if(isset($data['hoten'])){
            $this->hoten = trim($data['hoten']);
        }
        if(isset($data['cmnd'])){
            $this->tk_dangnhap = trim($data['cmnd']);
        }
        if(isset($data['sdt'])){
            $this->matkhau = trim($data['sdt']);
        }
        if(isset($data['trangthai'])){
            $this->trangthai = trim($data['trangthai']);
        }
        if(isset($data['gioitinh'])){
            $this->gioitinh = trim($data['gioitinh']);
        }
        if(isset($data['namsinh'])){
            $this->namsinh = trim($data['namsinh']);
        }
        if(isset($data['diachi'])){
            $this->diachi = trim($data['diachi']);
        }
        if(isset($data['sdt'])){
            $this->sdt = trim($data['sdt']);
        }
        if(isset($data['cmnd'])){
            $this->cmnd = trim($data['cmnd']);
        }
        return $this;
    }

	    public function fill1(array $data)
    {
        if(isset($data['hoten'])){
            $this->hoten = trim($data['hoten']);
        }
        if(isset($data['cmnd'])){
            $this->tk_dangnhap = trim($data['cmnd']);
        }
        if(isset($data['password'])){
            $this->matkhau = trim($data['password']);
        }
        if(isset($data['gioitinh'])){
            $this->gioitinh = trim($data['gioitinh']);
        }
        if(isset($data['namsinh'])){
            $this->namsinh = trim($data['namsinh']);
        }
        if(isset($data['diachi'])){
            $this->diachi = trim($data['diachi']);
        }
        if(isset($data['sdt'])){
            $this->sdt = trim($data['sdt']);
        }
        if(isset($data['cmnd'])){
            $this->cmnd = trim($data['cmnd']);
        }
        return $this;
    }
	
    public function getValidationErrors()
	{
		return $this->errors;
	}
    
    public function validate()
    {
        if(!$this->hoten){
            $this->errors['hoten'] ='Họ tên người dùng không hợp lệ.';
        }
        if (!$this->tk_dangnhap) {
			$this->errors['tk_dangnhap'] = 'Tên đăng nhập không hợp lệ. Vui lòng nhập lại!';
		} elseif (strlen($this->tk_dangnhap) < 2) {
			$this->errors['tk_dangnhap'] = 'Tên đăng nhập phải hơn 2 ký tự. Vui lòng nhập lại!';
		}
        if (strlen($this->matkhau) < 8) {
			$this->errors['matkhau'] = 'Mật khẩu phải hơn 8 ký tự. Vui lòng nhập lại!';
		}elseif (!$this->matkhau) {
			$this->errors['matkhau'] = 'Mật khẩu không hợp lệ. Vui lòng nhập lại!';
        }
        if(!$this->gioitinh){
            $this->errors['gioitinh'] ='Giới tính người dùng không hợp lệ.';
        }
        if(!$this->namsinh){
            $this->errors['namsinh'] ='Nam sinh người dùng không hợp lệ.';
        }
        if(!$this->diachi){
            $this->errors['diachi'] ='Địa chỉ người dùng không hợp lệ.';
        }
        if(!$this->sdt){
            $this->errors['sdt'] ='Số điện thoại người dùng không hợp lệ.';
        }
        if(!$this->cmnd){
            $this->errors['cmnd'] ='CMND không hợp lệ.';
        }
        return empty($this->errors);
    }

	public function validate_pass()
	{
		if (strlen($this->matkhau) < 8) {
			$this->errors['matkhau'] = 'Mật khẩu phải có ít nhất 8 ký tự. Vui lòng nhập lại!';
		} elseif (!$this->matkhau) {
			$this->errors['matkhau'] = 'Mật khẩu không hợp lệ. Vui lòng nhập lại!';
		}
		return empty($this->errors);
	}
	//Lay nguoi dung
	public function getUser()
	{
		$users = [];
		$stmt = $this->db->prepare('select * from benhnhan');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$user = new Benhnhan($this->db);
			$user->fillFromDB($row);
			$users[] = $tk_dangnhap;
		}
		return $users;
	}
	public function findUsername($username)
	{
		$stmt = $this->db->prepare('select * from benhnhan where tk_dangnhap = :tk_dangnhap');
		$stmt->execute(['tk_dangnhap' => $username]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}

    protected function fillFromDB(array $row)
	{
		[
		'MaBN' => $this->MaBN,
		'hoten' => $this->hoten,
		'tk_dangnhap' => $this->tk_dangnhap,
		'matkhau' => $this->matkhau,
		'trangthai' => $this->trangthai,
		'gioitinh' => $this->gioitinh,
		'namsinh' => $this->namsinh,
        'diachi' => $this->diachi,
        'sdt' => $this->sdt,
        'cmnd' => $this->cmnd,
		'created_day' => $this->created_day
		] = $row;
		return $this;
	}
    
    public function find($MaBN)
	{
		$stmt = $this->db->prepare('select * from benhnhan where MaBN = :MaBN');
		$stmt->execute(['MaBN' => $MaBN]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}
	public function save()
	{
		$result = false;
		if ($this->MaBN > 0) {
			$stmt = $this->db->prepare('update benhnhan set hoten = :hoten,
			tk_dangnhap = :tk_dangnhap, matkhau = :matkhau, gioitinh = :gioitinh, namsinh = :namsinh, 
            diachi = :diachi, sdt = :sdt, cmnd = :cmnd
			where MaBN = :MaBN');
			$result = $stmt->execute([
			'hoten' => $this->hoten,
			'tk_dangnhap' => $this->tk_dangnhap,
			'matkhau' => md5($this->matkhau),
			'gioitinh' => $this->gioitinh,
            'namsinh' => $this->namsinh,
            'diachi' => $this->diachi,
            'sdt' => $this->sdt,
            'cmnd' => $this->cmnd,
			'MaBN' => $this->MaBN]);
		} else {
			$stmt = $this->db->prepare(
			'insert into benhnhan (hoten, tk_dangnhap, matkhau, trangthai, gioitinh, namsinh, diachi, sdt, cmnd, created_day)
			values (:hoten, :tk_dangnhap, :matkhau, 1, :gioitinh, :namsinh, :diachi, :sdt, :cmnd, now())');
			$result = $stmt->execute([
			'hoten' => $this->hoten,
			'tk_dangnhap' => $this->tk_dangnhap,
			'matkhau' => md5($this->matkhau),
			'gioitinh' => $this->gioitinh,
            'namsinh' => $this->namsinh,
            'diachi' => $this->diachi,
            'sdt' => $this->sdt,
            'cmnd' => $this->cmnd]);
		if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		} 
		return $result;
	}
	public function save_pass()
	{
		$result = false;
		if ($this->MaBN > 0) {
			$stmt = $this->db->prepare('update benhnhan set matkhau = :new_password
			where MaBN = :MaBN');
			$result = $stmt->execute([
			'new_password' => $this->matkhau,
			'MaBN' => $this->MaBN]);
		} else {
			$stmt = $this->db->prepare(
			'insert into benhnhan (hoten, tk_dangnhap, matkhau, trangthai, gioitinh, namsinh, diachi, sdt, cmnd, created_day)
			values (:hoten, :tk_dangnhap, :matkhau, 1, :gioitinh, :namsinh, :diachi, :sdt, :cmnd, now())');
			$result = $stmt->execute([
			'hoten' => $this->hoten,
			'tk_dangnhap' => $this->tk_dangnhap,
			'matkhau' => md5($this->matkhau),
			'gioitinh' => $this->gioitinh,
            'namsinh' => $this->namsinh,
            'diachi' => $this->diachi,
            'sdt' => $this->sdt,
            'cmnd' => $this->cmnd]);
		if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		} 
		return $result;
	}
	public function save1()
	{
		$result = false;
		if ($this->MaBN > 0) {
			$stmt = $this->db->prepare('update benhnhan set trangthai = 0
			where MaBN = :MaBN');
			$result = $stmt->execute([
			'MaBN' => $this->MaBN]);
		} else {
			$stmt = $this->db->prepare(
			'insert into benhnhan (hoten, tk_dangnhap, matkhau, trangthai, gioitinh, namsinh, diachi, sdt, cmnd, created_day)
			values (:hoten, :tk_dangnhap, :matkhau, 1, :gioitinh, :namsinh, :diachi, :sdt, :cmnd, now())');
			$result = $stmt->execute([
			'hoten' => $this->hoten,
			'tk_dangnhap' => $this->tk_dangnhap,
			'matkhau' => md5($this->matkhau),
			'gioitinh' => $this->gioitinh,
            'namsinh' => $this->namsinh,
            'diachi' => $this->diachi,
            'sdt' => $this->sdt,
            'cmnd' => $this->cmnd]);
		if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		} 
		return $result;
	}
public function save2()
	{
		$result = false;
		if ($this->MaBN > 0) {
			$stmt = $this->db->prepare('update benhnhan set trangthai = 1
			where MaBN = :MaBN');
			$result = $stmt->execute([
			'MaBN' => $this->MaBN]);
		} else {
			$stmt = $this->db->prepare(
			'insert into benhnhan (hoten, tk_dangnhap, matkhau, trangthai, gioitinh, namsinh, diachi, sdt, cmnd, created_day)
			values (:hoten, :tk_dangnhap, :matkhau, 1, :gioitinh, :namsinh, :diachi, :sdt, :cmnd, now())');
			$result = $stmt->execute([
			'hoten' => $this->hoten,
			'tk_dangnhap' => $this->tk_dangnhap,
			'matkhau' => md5($this->matkhau),
			'gioitinh' => $this->gioitinh,
            'namsinh' => $this->namsinh,
            'diachi' => $this->diachi,
            'sdt' => $this->sdt,
            'cmnd' => $this->cmnd]);
		if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		} 
		return $result;
	}
	
    //Cap nhat hoac them du lieu du lieu
	public function update(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save();
		}
		return false;
	}
	public function update_pass(array $data)
	{
		$this->fill($data);
		if ($this->validate_pass()) {
			return $this->save_pass();
		}
		return false;
	}

	public function update1(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save1();
		}
		return false;
	}
	public function update2(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save2();
		}
		return false;
	}
    public function delete()
	{
		$stmt = $this->db->prepare('delete from benhnhan where MaBN = :MaBN');
		return $stmt->execute(['MaBN' => $this->MaBN]);
	}

    //Kiem tra dang nhap
	//Ham tra ve so dong sau khi thuc hien cau lenh 
	public function checkpoint($username,$password){
		$sql = "select * from benhnhan where tk_dangnhap =:u and matkhau =:p";
	    $query = $this->db->prepare($sql);
	    $query->execute([
	        'u' => $username,
	        'p' => $password
	    ]);
	    return $query->rowCount();
	}
	//Kiem tra dang nhap
	//Ham tra ve mang du lieu username va password
	public function checkpoint2($username,$password){
		$sql = "select * from benhnhan where tk_dangnhap =:u and matkhau =:p";
	    $query = $this->db->prepare($sql);
	    $query->execute([
	        'u' => $username,
	        'p' => $password
	    ]);

	     return $query->fetch();
	}
    public function so_benhnhan(){
		$stmt = $this->db->prepare("select count(*) as countBN from benhnhan");
		$stmt->execute();
		$row = $stmt->fetch();
		return $row["countBN"];
	}



    
}
?>
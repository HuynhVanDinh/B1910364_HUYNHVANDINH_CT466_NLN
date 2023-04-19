<?php
namespace ct466\Nhakhoa;
class User {
    private $db;
    private $user_id = -1;
    public $username;
    public $fullname;
    public $password;
    public $p_p;
    public $status;
    public $created_at;
    public $role;
    private $errors = [];

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function fill(array $data)
	{
		if (isset($data['username'])) {
			$this->username = trim($data['username']);
		}
        if (isset($data['fullname'])) {
			$this->fullname = trim($data['fullname']);
		}
        if (isset($data['password'])) {
			$this->password = trim($data['password']);
		}
		if (isset($data['status'])) {
			$this->status = trim($data['status']);
		}
        // if (isset($file)) {
		// 	$this->p_p =($file['p_p']['name']);
		// }
        return $this;
    }

    public function getValidationErrors()
	{
		return $this->errors;
	}

    public function validate()
    {
        if (!$this->username) {
			$this->errors['username'] = 'Tên đăng nhập không hợp lệ. Vui lòng nhập lại!';
        }
        if (!$this->fullname) {
			$this->errors['fullname'] = 'Tên người dùng không hợp lệ. Vui lòng nhập lại!';
		}
		if(!$this->password){
            $this->errors['password'] = 'Bạn chưa nhập số điện thoại';
        } elseif (strlen($this->password) != 10){
            $this->errors['password'] = 'Số điện thoại phải đủ 10 chữ số';
        }
        // if (!$this->p_p) {
		// 	$this->errors['p_p'] = 'Ảnh đại diện không hợp lệ. Vui lòng nhập lại!';
        // }
        return empty($this->errors);
    }
    //Lay tat ca du lieu tu bang taikhoan
	public function all()
	{
		$users = [];
		$stmt = $this->db->prepare('select * from taikhoan');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$user = new User($this->db);
			$user->fillFromDB($row);
			$users[] = $user;
		} return $users;
	}

	public function user_nv()
	{
		$users = [];
		$stmt = $this->db->prepare('select * from taikhoan where role = 2');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$user = new User($this->db);
			$user->fillFromDB($row);
			$users[] = $user;
		} return $users;
	}
	

	public function user_ns()
	{
		$users = [];
		$stmt = $this->db->prepare('select * from taikhoan where role = 3');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$user = new User($this->db);
			$user->fillFromDB($row);
			$users[] = $user;
		}
		return $users;
	}
    	//Lay du lieu tu csdl
	protected function fillFromDB(array $row)
	{
		[
		'user_id' => $this->user_id,
		'username' => $this->username,
        'fullname' => $this->fullname,
		'password' => $this->password,
		'p_p' => $this->p_p,
		'created_at' => $this->created_at,
		'role' => $this->role,
        'status' => $this->status
		] = $row;
		return $this;
	}
    //Tim nguoi dung
	public function find($user_id)
	{
		$stmt = $this->db->prepare('select * from taikhoan where user_id = :user_id');
		$stmt->execute(['user_id' => $user_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}

    //Tim kiem username, kiem tra neu co ton tai username trong csdl thi thông bao 
	// da ton tai va yeu cau chon 1 username khac de dang nhap
	public function findUsername($username)
	{
		$stmt = $this->db->prepare('select * from taikhoan where username = :username');
		$stmt->execute(['username' => $username]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}
    //Cap nhat hoac them du lieu (Neu id ton tai thi cap nhat nguoi dung dua tren id,
    // Neu id khong ton tai <= 0 thi them du lieu moi)
	public function save()
	{
		$result = false;
		if ($this->user_id > 0) {
			$stmt = $this->db->prepare('update taikhoan set fullname = :fullname,
			username = :username, password = :password, p_p = :p_p,
			where user_id = :user_id');
			$result = $stmt->execute([
			'fullname' => $this->fullname,
			'username' => $this->username,
			'password' => md5($this->password),
			'p_p' => $this->p_p,
			'user_id' => $this->user_id]);
			// $imgname = $this->p_p;
			// move_uploaded_file($_FILES['p_p']['tmp_name'], __DIR__.'/../public/img/upload/'.$imgname);
		} else {
			$stmt = $this->db->prepare(
			'insert into taikhoan (fullname, username, password, p_p, status, role, created_at)
			values (:fullname, :username, :password, :p_p, 1, 3, now())');
			$result = $stmt->execute([
			'fullname' => $this->fullname,
			'username' => $this->username,
			'p_p' => "default.jpg",
			'password' => md5($this->password)
			]);
		if ($result) {
				$this->user_id = $this->db->lastInsertId();
			}
			// $imgname = $this->p_p;
			// move_uploaded_file($_FILES['p_p']['tmp_name'], __DIR__.'/../public/img/upload/'.$imgname);
		} 
		return $result;
	}
	public function save2()
	{
		$result = false;
		if ($this->user_id > 0) {
			$stmt = $this->db->prepare('update taikhoan set fullname = :fullname,
			username = :username, password = :password, p_p = :p_p,
			where user_id = :user_id');
			$result = $stmt->execute([
			'fullname' => $this->fullname,
			'username' => $this->username,
			'password' => md5($this->password),
			'p_p' => $this->p_p,
			'user_id' => $this->user_id]);
			// $imgname = $this->p_p;
			// move_uploaded_file($_FILES['p_p']['tmp_name'], __DIR__.'/../public/img/upload/'.$imgname);
		} else {
			$stmt = $this->db->prepare(
			'insert into taikhoan (fullname, username, password, p_p, status, role, created_at)
			values (:fullname, :username, :password, :p_p, 1, 2, now())');
			$result = $stmt->execute([
			'fullname' => $this->fullname,
			'username' => $this->username,
			'p_p' => "default2.jpg",
			'password' => md5($this->password)
			]);
		if ($result) {
				$this->user_id = $this->db->lastInsertId();
			}
			// $imgname = $this->p_p;
			// move_uploaded_file($_FILES['p_p']['tmp_name'], __DIR__.'/../public/img/upload/'.$imgname);
		} 
		return $result;
	}
	public function save3()
	{
		$result = false;
		if ($this->user_id > 0) {
			$stmt = $this->db->prepare('update taikhoan set status = 0
			where user_id = :user_id');
			$result = $stmt->execute([
			'user_id' => $this->user_id]);
			// $imgname = $this->p_p;
			// move_uploaded_file($_FILES['p_p']['tmp_name'], __DIR__.'/../public/img/upload/'.$imgname);
		} else {
			$stmt = $this->db->prepare(
			'insert into taikhoan (fullname, username, password, p_p, status, role, created_at)
			values (:fullname, :username, :password, :p_p, 1, 2, now())');
			$result = $stmt->execute([
			'fullname' => $this->fullname,
			'username' => $this->username,
			'p_p' => "default2.jpg",
			'password' => md5($this->password)
			]);
		if ($result) {
				$this->user_id = $this->db->lastInsertId();
			}
			// $imgname = $this->p_p;
			// move_uploaded_file($_FILES['p_p']['tmp_name'], __DIR__.'/../public/img/upload/'.$imgname);
		} 
		return $result;
	}
	public function save4()
	{
		$result = false;
		if ($this->user_id > 0) {
			$stmt = $this->db->prepare('update taikhoan set status = 1
			where user_id = :user_id');
			$result = $stmt->execute([
			'user_id' => $this->user_id]);
			// $imgname = $this->p_p;
			// move_uploaded_file($_FILES['p_p']['tmp_name'], __DIR__.'/../public/img/upload/'.$imgname);
		} else {
			$stmt = $this->db->prepare(
			'insert into taikhoan (fullname, username, password, p_p, status, role, created_at)
			values (:fullname, :username, :password, :p_p, 1, 2, now())');
			$result = $stmt->execute([
			'fullname' => $this->fullname,
			'username' => $this->username,
			'p_p' => "default2.jpg",
			'password' => md5($this->password)
			]);
		if ($result) {
				$this->user_id = $this->db->lastInsertId();
			}
			// $imgname = $this->p_p;
			// move_uploaded_file($_FILES['p_p']['tmp_name'], __DIR__.'/../public/img/upload/'.$imgname);
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

	public function update1(array $data)
	{
		$this->fill($data);
			return $this->save3();
		return $this;
	}
	public function update2(array $data)
	{
		$this->fill($data);
			return $this->save4();
		return $this;
	}
    public function delete()
	{
		$stmt = $this->db->prepare('delete from taikhoan where user_id = :user_id');
		return $stmt->execute(['user_id' => $this->user_id]);
	}

    //Kiem tra dang nhap
	//Ham tra ve so dong sau khi thuc hien cau lenh 
	public function checkpoint($username,$password){
		$sql = "select * from taikhoan where username =:u and password =:p";
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
		$sql = "select * from taikhoan where username =:u and password =:p";
	    $query = $this->db->prepare($sql);
	    $query->execute([
	        'u' => $username,
	        'p' => $password
	    ]);

	     return $query->fetch();
	}
	

}
?>
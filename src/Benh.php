<?php

namespace ct466\Nhakhoa;

class Benh
{
	private $db;

	private $benh_id = -1;
	public $tenbenh;
    public $mota;
    public $dongia;
    public $thuocdinhkem;
	
	private $errors = [];

	public function getId()
	{
		return $this->benh_id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}


	public function fill(array $data)
	{
		if (isset($data['tenbenh'])) {
			$this->tenbenh = trim($data['tenbenh']);
		}
        if (isset($data['mota'])) {
			$this->mota = trim($data['mota']);
		}
        if (isset($data['dongia'])) {
			$this->dongia = trim($data['dongia']);
		}
        if (isset($data['thuocdinhkem'])) {
			$this->thuocdinhkem = trim($data['thuocdinhkem']);
		}
		return $this;
	}
	//Xuat loi
	public function getValidationErrors()
	{
		return $this->errors;
	}

	//Kiem tra loi
	public function validate()
	{
		if (!$this->tenbenh) {
			$this->errors['tenbenh'] = 'Tên Danh mục bệnh không hợp lệ.';
		}
        if (!$this->mota) {
			$this->errors['mota'] = 'Mô tả không hợp lệ.';
		}
        if (!$this->dongia) {
			$this->errors['dongia'] = 'Đơn giá không hợp lệ.';
		}
        if (!$this->thuocdinhkem) {
			$this->errors['thuocdinhkem'] = 'Tên thuốc không hợp lệ.';
		}
		return empty($this->errors);
	}
	//Lay du lieu tu csdl
	protected function fillFromDB(array $row)
	{
		[
		'benh_id' => $this->benh_id,
		'tenbenh' => $this->tenbenh,
        'mota' => $this->mota,
        'dongia' => $this->dongia,
        'thuocdinhkem' => $this->thuocdinhkem
		] = $row;
		return $this;
	}
	//Hien thi tat ca danh muc
	public function all()
	{
		$dmbenh = [];
		$stmt = $this->db->prepare('select * from benh');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$benh = new Benh($this->db);
			$benh->fillFromDB($row);
			$dmbenh[] = $benh;
		} return $dmbenh;
	} 

	
	//Cap nhat hoac insert vao table
	public function save()
	{
		$result = false;
		if ($this->benh_id >= 0) {
			$stmt = $this->db->prepare('update benh set tenbenh = :tenbenh, mota = :mota, dongia = :dongia, thuocdinhkem = :thuocdinhkem
			                            where benh_id = :benh_id');
			$result = $stmt->execute([
			'tenbenh' => $this->tenbenh,
            'mota' => $this->mota,
            'dongia' => $this->dongia,
            'thuocdinhkem' => $this->thuocdinhkem,
			'benh_id' => $this->benh_id]);
		
		} else {
			$stmt = $this->db->prepare(
			'insert into  benh (tenbenh, mota, dongia, thuocdinhkem)
			values (:tenbenh, :mota, :dongia, :thuocdinhkem)');
			$result = $stmt->execute([
			'tenbenh' => $this->tenbenh,
            'mota' => $this->mota,
            'dongia' => $this->dongia,
            'thuocdinhkem' => $this->thuocdinhkem
			]);
			if ($result) {
				$this->benh_id = $this->db->lastInsertId();
			}
			
			//move_uploaded_file : di chuyen tep da tai len den file moi vua tao
		} return $result;
	}

	public function find($benh_id)
	{
		$stmt = $this->db->prepare('select * from benh where benh_id = :benh_id');
		$stmt->execute(['benh_id' => $benh_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} else return null;
	} 

	public function update(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save();
		} return false; 
	}

	public function delete()
	{
		$stmt = $this->db->prepare('delete from benh where benh_id = :benh_id');
		return $stmt->execute(['benh_id' => $this->benh_id]);
	}
	public function so_Benh(){
		$stmt = $this->db->prepare("select count(*) as countB from benh");
		$stmt->execute();
		$row = $stmt->fetch();
		return $row["countB"];
	}



}
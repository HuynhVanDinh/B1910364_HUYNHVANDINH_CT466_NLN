<?php
namespace ct466\Nhakhoa;

class Nhasi
{
    private $db;
    private $MaNS =-1;
    public $tenns;
	public $user_id;
    public $bangcap;
    public $kinhnghiem;
    public $diachinha;
    public $cm;
    public $gtinh;
    public $dt;
    public $errors = [];
    
    public function getMaNS()
    {
        return $this->MaNS;
    }

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function fill(array $data, $tk_id)
    {
        if(isset($data['fullname'])){
            $this->tenns = trim($data['fullname']);
        }
        if(isset($data['bangcap'])){
            $this->bangcap = trim($data['bangcap']);
        }
         if(isset($data['kinhnghiem'])){
            $this->kinhnghiem = trim($data['kinhnghiem']);
        }
         if(isset($data['diachinha'])){
            $this->diachinha = trim($data['diachinha']);
        }
         if(isset($data['username'])){
            $this->cm = trim($data['username']);
        }
         if(isset($data['gtinh'])){
            $this->gtinh = trim($data['gtinh']);
        }
        if(isset($data['password'])){
            $this->dt = trim($data['password']);
        }
		$this->user_id = $tk_id;
        return $this;
    }
    public function fill2(array $data)
    {
        if(isset($data['tenns'])){
            $this->tenns = trim($data['tenns']);
        }
        if(isset($data['bangcap'])){
            $this->bangcap = trim($data['bangcap']);
        }
         if(isset($data['kinhnghiem'])){
            $this->kinhnghiem = trim($data['kinhnghiem']);
        }
         if(isset($data['diachinha'])){
            $this->diachinha = trim($data['diachinha']);
        }
         if(isset($data['cm'])){
            $this->cm = trim($data['cm']);
        }
         if(isset($data['gtinh'])){
            $this->gtinh = trim($data['gtinh']);
        }
        if(isset($data['dt'])){
            $this->dt = trim($data['dt']);
        }
        return $this;
    }
    public function getValidationErrors()
	{
		return $this->errors;
	}

    public function validate()
	{
		if (!$this->tenns) {
			$this->errors['tenns'] = 'Tên nha sĩ không hợp lệ.';
		}

		if (!$this->bangcap) {
			$this->errors['bangcap'] = 'Giá trị không hợp lệ.';
		}

		if (strlen($this->kinhnghiem) > 255) {
			$this->errors['kinhnghiem'] = 'Mô kinh nghiệm tả ít nhất phải 255 ký tự.';
		}

		if (!$this->diachinha) {
			$this->errors['diachinha'] = 'Địa chỉ nhà không hợp lệ.';
		}

		if (!$this->cm) {
			$this->errors['cm'] = 'Chứng minh nhân dân không hợp lệ.';
		}
        if (!$this->gtinh) {
			$this->errors['gtinh'] = 'Nhập giới tính không hợp lệ.';
		}
        if (!$this->dt) {
			$this->errors['dt'] = 'Số điện thoại không hợp lệ.';
		}

		return empty($this->errors);
	}

    protected function fillFromDB(array $row)
	{
		[
		'MaNS' => $this->MaNS,
        'user_id' => $this->user_id,
		'tenns' => $this->tenns,
		'bangcap' => $this->bangcap,
		'kinhnghiem' => $this->kinhnghiem,
		'diachinha' => $this->diachinha,
		'cm' => $this->cm,
		'gtinh' => $this->gtinh,
		'dt' => $this->dt
		] = $row;
		return $this;
	}
    public function all()
	{
		$nha_si = [];
		$stmt = $this->db->prepare('select * from nhasi');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$nhasi = new Nhasi($this->db);
			$nhasi->fillFromDB($row);
			$nha_si[] = $nhasi;
		} return $nha_si;
	}

    public function save()
	{
		$result = false;
		if ($this->MaNS >= 0) {
			$stmt = $this->db->prepare('update nhasi set tenns = :tenns,
			bangcap = :bangcap, kinhnghiem = :kinhnghiem, diachinha = :diachinha, cm = :cm, gtinh = :gtinh, dt = :dt
			where MaNS = :MaNS');
			$result = $stmt->execute([
			'tenns' => $this->tenns,
			'bangcap' => $this->bangcap,
			'kinhnghiem' => $this->kinhnghiem,
			'diachinha' => $this->diachinha,
			'cm' => $this->cm,
            'gtinh' => $this->gtinh,
            'dt' => $this->dt,
			'MaNS' => $this->MaNS]);
		} else {
			$stmt = $this->db->prepare(
			'insert into nhasi (tenns, user_id, bangcap, kinhnghiem, diachinha, cm, gtinh, dt)
			values (:fullname, :user_id, :bangcap, :kinhnghiem, :diachinha, :username, :gtinh, :password)');
			$result = $stmt->execute([
			'fullname' => $this->tenns,
			'user_id'=> $this->user_id,
			'bangcap' => $this->bangcap,
			'kinhnghiem' => $this->kinhnghiem,
			'diachinha' => $this->diachinha,
			'username' => $this->cm,
            'gtinh' => $this->gtinh,
            'password' => $this->dt]);
			if ($result) {
				$this->MaNS = $this->db->lastInsertId();
			}
		} return $result;
	}

    public function find($MaNS)
	{
		$stmt = $this->db->prepare('select * from nhasi where MaNS = :MaNS');
		$stmt->execute(['MaNS' => $MaNS]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} else return null;
	} 

	public function findUser($user_id)
	{
		$stmt = $this->db->prepare('select * from nhasi where user_id = :user_id');
		$stmt->execute(['user_id' => $user_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} else return null;
	} 

    public function update(array $data)
	{

		$this->fill2($data);
		if ($this->validate()) {
			return $this->save();
		} return false; 
	}
    
  public function delete()
	{
		$stmt = $this->db->prepare('delete from nhasi where MaNS = :MaNS');
		return $stmt->execute(['MaNS' => $this->MaNS
    
    
    ]);
	}

    public function search($key)
	{
		$nha_si = [];
		$stmt = $this->db->prepare("select * from nhasi where name LIKE '%" . $key . "%' ");
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$nhasi = new Nhasi($this->db);
			$nhasi->fillFromDB($row);
			$nha_si[] = $nhasi;
		} return $nha_si;
	}
	public function so_nhasi(){
		$stmt = $this->db->prepare("select count(*) as countNS from nhasi");
		$stmt->execute();
		$row = $stmt->fetch();
		return $row["countNS"];
	}
}
?>
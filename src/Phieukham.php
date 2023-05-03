<?php

namespace ct466\Nhakhoa;

class Phieukham
{
    private $db;
    private $ma_pk = -1;
    public $ngaykham;
	public $id_benhnhan;
	public $id_nhanvien;
	public $id_nhasi;
	public $id_benh;
	public $ma_bl;
    public $noidung;
    public $gionhan;
    public $giotra;
	public $xacnhan;
	public $soluong;
    private $errors = [];

    public function __construct($pdo)
	{
		$this->db = $pdo;
	}
    
	public function getMaPK()
	{
		return $this->ma_pk;
	}

    public function fill(array $data)
	{
		if (isset($data['ngayhen'])) {
			$this->ngaykham = trim($data['ngayhen']);
		}
        if (isset($data['gionhan'])) {
			$this->gionhan = trim($data['gionhan']);
		}
        if (isset($data['giotra'])) {
			$this->giotra = trim($data['giotra']);
		}
        if (isset($data['noidung'])) {
			$this->noidung = trim($data['noidung']);
		}
		if (isset($data['id_benhnhan'])) {
			$this->id_benhnhan = trim($data['id_benhnhan']);
		}
		if (isset($data['id_nhasi'])) {
			$this->id_nhasi = trim($data['id_nhasi']);
		}
        if (isset($data['id_nhanvien'])) {
			$this->id_nhanvien = trim($data['id_nhanvien']);
		}
		return $this;
	}
	public function fill2(array $data)
	{
		if (isset($data['id_phieukham'])) {
			$this->ma_pk = trim($data['id_phieukham']);
		}
		if (isset($data['id_benhnhan'])) {
			$this->id_benhnhan = trim($data['id_benhnhan']);
		}
		if (isset($data['ma_bl'])) {
			$this->ma_bl = trim($data['ma_bl']);
		}
		if (isset($data['id_benh'])) {
			$this->id_benh = trim($data['id_benh']);
		}
		if (isset($data['soluong'])) {
			$this->soluong = trim($data['soluong']);
		}
		return $this;
	}
    public function validate3()
	{
		if (!$this->ma_bl) {
			$this->errors['ma_bl'] = 'mã biên lai không hợp lệ.';
		}
		return empty($this->errors);
	} 
	
    public function validate()
	{
		if (!$this->noidung) {
			$this->errors['noidung'] = 'Nội dung không hợp lệ.';
		}
		return empty($this->errors);
	}
	public function validate2()
	{
		if (!$this->id_benh) {
			$this->errors['id_benh'] = 'Không hợp lệ.';
		}
		return empty($this->errors);
	}

    public function getValidationErrors()
	{
		return $this->errors;
	}

    protected function fillFromDB(array $row)
	{
		[
		'id_benhnhan' => $this->id_benhnhan,
		'id_nhasi' => $this->id_nhasi,
        'id_nhanvien' => $this->id_nhanvien,
		'ma_pk' => $this->ma_pk,
		'ngaykham' => $this->ngaykham,
        'gionhan' => $this->gionhan,
        'giotra' => $this->giotra,
		'noidung' => $this->noidung
		] = $row;
		return $this;
	}
	    protected function fillFromDB2(array $row)
	{
		[
		'id_benhnhan' => $this->id_benhnhan,
		'id_nhasi' => $this->id_nhasi,
        'id_nhanvien' => $this->id_nhanvien,
		'id_benh' => $this->id_benh,
		'ma_pk' => $this->ma_pk,
		'soluong' => $this->soluong,
		'ngaykham' => $this->ngaykham,
        'gionhan' => $this->gionhan,
        'giotra' => $this->giotra,
		'noidung' => $this->noidung
		] = $row;
		return $this;
	}
    protected function fillFromDB3(array $row)
	{
		[
		'id_benhnhan' => $this->id_benhnhan,
		'id_nhasi' => $this->id_nhasi,
        'id_nhanvien' => $this->id_nhanvien,
		'id_benh' => $this->id_benh,
		'ma_bl' => $this->ma_bl,
		'ma_pk' => $this->ma_pk,
		'soluong' => $this->soluong,
		'ngaykham' => $this->ngaykham,
		'ngay' => $this->ngay,
        'gionhan' => $this->gionhan,
        'giotra' => $this->giotra,
		'noidung' => $this->noidung
		] = $row;
		return $this;
	}
    public function all_ctt()
	{
		$dmphieukham = [];
		$stmt = $this->db->prepare('select pk.*,ctpk.id_benh,ctpk.soluong from phieukham pk inner join ct_phieukham ctpk on pk.ma_pk= ctpk.ma_pk where thanhtoan = 0');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$phieukham = new Phieukham($this->db);
			$phieukham->fillFromDB2($row);
			$dmphieukham[] = $phieukham;
		} return $dmphieukham;
	} 

	public function bl_ctt()
	{
		$dmphieukham = [];
		$stmt = $this->db->prepare('select pk.*,ctpk.id_benh,ctpk.soluong from phieukham pk inner join ct_phieukham ctpk on pk.ma_pk= ctpk.ma_pk inner join bienlai bl on bl.ma_pk = pk.ma_pk where ctpk.ma_bl = 0 and thanhtoan = 1 and tinhtrang =0');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$phieukham = new Phieukham($this->db);
			$phieukham->fillFromDB2($row);
			$dmphieukham[] = $phieukham;
		} return $dmphieukham;
	}
	public function all_dtt($ma_bl)
	{
		$dmphieukham = [];
		$stmt = $this->db->prepare('select DISTINCT pk.*,ctpk.id_benh,ctpk.soluong from phieukham pk inner join ct_phieukham ctpk on pk.ma_pk= ctpk.ma_pk inner join bienlai bl on bl.ma_pk = pk.ma_pk where ctpk.ma_bl = :ma_bl and thanhtoan = 1');
		$stmt->execute(['ma_bl' => $ma_bl]);
		while ($row = $stmt->fetch()) {
			$phieukham = new Phieukham($this->db);
			$phieukham->fillFromDB2($row);
			$dmphieukham[] = $phieukham;
		} return $dmphieukham;
	}
	public function all_ctpk_user($id_benhnhan)
	{
		$dmphieukham = [];
		$stmt = $this->db->prepare('select * from phieukham pk inner join ct_phieukham ctpk on pk.ma_pk= ctpk.ma_pk where pk.id_benhnhan = :id_benhnhan and xacnhan = 1');
		$stmt->execute(['id_benhnhan' => $id_benhnhan]);
		while ($row = $stmt->fetch()) {
			$phieukham = new Phieukham($this->db);
			$phieukham->fillFromDB3($row);
			$dmphieukham[] = $phieukham;
		} return $dmphieukham;
	}

	public function phieukham_dl()
	{
		$dmphieukham = [];
		$stmt = $this->db->prepare('select * from phieukham where xacnhan = 0');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$phieukham = new Phieukham($this->db);
			$phieukham->fillFromDB($row);
			$dmphieukham[] = $phieukham;
		} return $dmphieukham;
	}
	public function getDistinctNgayKham($id_nhasi)
	{
		$stmt = $this->db->prepare("SELECT DISTINCT ngaykham FROM phieukham WHERE id_nhasi = :id_nhasi and xacnhan = 0");
		$stmt->execute(['id_nhasi' => $id_nhasi]);
		$rows = $stmt->fetchAll();
		$result = array();
		foreach ($rows as $row) {
			$result[] = $row["ngaykham"];
		}
		return $result;
	}
	public function LichKhamTrongNgay($id_nhasi, $ngaykham)
	{
		$dmphieukham = [];
		$stmt = $this->db->prepare('select * from phieukham WHERE id_nhasi = :id_nhasi AND ngaykham = :ngaykham and xacnhan = 0');
		$stmt->execute(['id_nhasi' => $id_nhasi, 'ngaykham' => $ngaykham]);
		while ($row = $stmt->fetch()) {
			$phieukham = new Phieukham($this->db);
			$phieukham->fillFromDB($row);
			$dmphieukham[] = $phieukham;
		} return $dmphieukham;
	} 
    
    public function save()
	{
		$result = false;
		if ($this->ma_pk >= 0) {
			$stmt = $this->db->prepare('update phieukham set id_nhasi = :id_nhasi, ngayhen = :ngayhen, giohen = :giohen, ghichu =:ghichu
			                            where ma_lh = :ma_lh');
			$result = $stmt->execute([
			'id_nhasi' => $this->id_nhasi,
			'ngayhen' => $this->ngayhen,
            'giohen' => $this->giohen,
			'ghichu' => $this->ghichu,
			'ma_lh' => $this->ma_lh]);
		
		} else {
			$stmt = $this->db->prepare(
			'insert into  phieukham (id_benhnhan, id_nhasi, ngayhen, giohen, ghichu, duyet)
			values (:id_benhnhan, :id_nhasi, :ngayhen, :giohen, :ghichu, 0)');
			$result = $stmt->execute([
			'id_benhnhan' => $this->id_benhnhan,
			'id_nhasi' => $this->id_nhasi,
			'ngayhen' => $this->ngayhen,
            'giohen' => $this->giohen,
			'ghichu' => $this->ghichu
			]);
			if ($result) {
				$this->ma_lh = $this->db->lastInsertId();
			}
		} return $result;
	}
    public function save_Phieukham($id_nhanvien)
    {
        $result = false;
        $stmt = $this->db->prepare(
        'insert into  phieukham (id_benhnhan, id_nhasi, id_nhanvien, ngaykham, gionhan, giotra, noidung, xacnhan)
        values (:id_benhnhan, :id_nhasi, :id_nhanvien, :ngayhen, now(), now(), :noidung, 0)');
        $result = $stmt->execute([
            'id_benhnhan' => $this->id_benhnhan,
            'id_nhasi' => $this->id_nhasi,
            'id_nhanvien' => $id_nhanvien,
			'ngayhen' => $this->ngaykham,
            'noidung' => $this->noidung,
        ]);
        if ($result) {
            $this->ma_pk = $this->db->lastInsertId();
        }
        return $result;
    }

	public function capnhat_phieukham($id_nhanvien)
    {
        $result = false;
        $stmt = $this->db->prepare(
        'update phieukham set id_benhnhan = :id_benhnhan, id_nhasi = :id_nhasi, id_nhanvien = :id_nhanvien, ngaykham = :ngayhen, gionhan = now(), giotra = now(), noidung = :noidung, xacnhan =0 where ma_pk = :ma_pk');
        $result = $stmt->execute([
            'id_benhnhan' => $this->id_benhnhan,
            'id_nhasi' => $this->id_nhasi,
            'id_nhanvien' => $id_nhanvien,
			'ngayhen' => $this->ngaykham,
            'noidung' => $this->noidung,
			'ma_pk' => $this->ma_pk
        ]);
        if ($result) {
            $this->ma_pk = $this->db->lastInsertId();
        }
        return $result;
    }
    
	public function kt_phieukham($id_benhnhan, $id_benh)
	{
		$stmt = $this->db->prepare('select pk.*,ctpk.id_benh,ctpk.soluong from phieukham pk inner join ct_phieukham ctpk on pk.ma_pk = ctpk.ma_pk where pk.id_benhnhan = :id_benhnhan and ctpk.id_benh = :id_benh and thanhtoan = 0');
		$stmt->execute(['id_benh' => $id_benh, 'id_benhnhan' =>$id_benhnhan]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB2($row);
			return $this;
		}
		return null;
	}
	
    public function find($ma_pk)
	{
		$stmt = $this->db->prepare('select * from phieukham where ma_pk = :ma_pk');
		$stmt->execute(['ma_pk' => $ma_pk]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} else return null;
	} 

	 public function tim_benhnhan($id_benhnhan)
	{
		$stmt = $this->db->prepare('select * from phieukham where id_benhnhan = :id_benhnhan');
		$stmt->execute(['id_benhnhan' => $id_benhnhan]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} else return null;
	}
	 
	public function tim_mabl($ma_bl)
	{
		$stmt = $this->db->prepare('select * from ct_phieukham where ma_bl = :ma_bl');
		$stmt->execute(['ma_bl' => $ma_bl]);
		if ($row = $stmt->fetch()) {
			// $this->fillFromDB($row);
			return true;
		} else return false;
	}
	
	public function find_id($ma_pk,$id_benh)
	{
		$stmt = $this->db->prepare('select pk.*,ctpk.id_benh,ctpk.soluong from phieukham pk inner join ct_phieukham ctpk on pk.ma_pk = ctpk.ma_pk where pk.ma_pk = :ma_pk and ctpk.id_benh = :id_benh');
		$stmt->execute(['ma_pk' => $ma_pk,'id_benh' => $id_benh]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB2($row);
			return $this;
		} return null;
	}
	public function find_pk_mapk($ma_pk)
	{
		$stmt = $this->db->prepare('select pk.*,ctpk.id_benh,ctpk.soluong from phieukham pk inner join ct_phieukham ctpk on pk.ma_pk = ctpk.ma_pk where pk.ma_pk = :ma_pk');
		$stmt->execute(['ma_pk' => $ma_pk]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB2($row);
			return $this;
		}
		return null;
	}

	public function delete_detail()
	{
		$stmt = $this->db->prepare('delete from ct_phieukham where ma_pk = :ma_pk and id_benh = :id_benh');
		return $stmt->execute([
			'ma_pk' => $this->ma_pk,
			'id_benh' => $this->id_benh
		]);
	}
	
	public function timPk($id_benhnhan,$ma_pk)
	{
		$stmt = $this->db->prepare('select * from phieukham where id_benhnhan = :id_benhnhan and ma_pk = :ma_pk');
		$stmt->execute([
			'id_benhnhan' => $id_benhnhan,
			'ma_pk' => $ma_pk
		]);
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
	
	public function update_phieukham_dtt(array $data)
	{
		$this->fill2($data);
		if ($this->validate3()) {
			return $this->set_phieukham_dtt();
		}
		return false;
	}
	
	public function update_phieukham(array $data)
	{
		$this->fill2($data);
		if ($this->validate()) {
			return $this->set_phieukham();
		}
		return false;
	}
	
	public function set_phieukham()
	{
		$sql = "update ct_phieukham set soluong = :soluong where (ma_pk = :ma_pk and id_benh = :id_benh)";
		$query = $this->db->prepare($sql);
		$result = $query->execute([
			'ma_pk' => $this->ma_pk,
			'soluong' => $this->soluong,
			'id_benh' => $this->id_benh
		]);
		if ($result) {
			$this->id = $this->db->lastInsertId();
		}
		return $result;
	}
	
	public function set_phieukham_dtt()
	{
		$sql = "UPDATE `bienlai` bl INNER JOIN `ct_phieukham` ct_pk ON bl.ma_pk = ct_pk.ma_pk set ct_pk.ma_bl = :ma_bl WHERE tinhtrang = 0 and ct_pk.ma_bl = 0";
		$query = $this->db->prepare($sql);
		$result = $query->execute([
			'ma_bl' => $this->ma_bl
		]);
		if ($result) {
			$this->id = $this->db->lastInsertId();
		}
		return $result;
	}

	public function them_dv()
	{
		$sql = "insert into ct_phieukham (ma_pk, id_benh, soluong, ngay, thanhtoan) values (:ma_pk, :id_benh, :soluong, now(), 0)";
		$query = $this->db->prepare($sql);
		$result = $query->execute([
			'ma_pk' => $this->ma_pk,
			'id_benh' => $this->id_benh,
			'soluong' => $this->soluong,
		]);
		if ($result) {
			$this->id = $this->db->lastInsertId();
		}
		return $result;
	}

	public function tao_phieukham(array $data, $id_nhanvien)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save_Phieukham($id_nhanvien);
		} return false; 
	}

		public function lay_phieukham(array $data, $id_nhanvien)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->capnhat_phieukham($id_nhanvien);
		} return false; 
	}

    public function delete()
	{
		$stmt = $this->db->prepare('delete from phieukham where ma_pk = :ma_pk');
		return $stmt->execute(['ma_pk' => $this->ma_pk]);
	}
    
    public function so_Phieu_Kham(){
		$stmt = $this->db->prepare("select count(*) as countPK from phieukham");
		$stmt->execute();
		$row = $stmt->fetch();
		return $row["countPK"];
	}
}
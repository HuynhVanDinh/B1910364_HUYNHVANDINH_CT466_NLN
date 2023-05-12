<?php

namespace ct466\Nhakhoa;

class Lichhen
{
    private $db;
    private $ma_lh = -1;
    public $ngayhen;
	public $id_benhnhan;
	public $sdt;
	public $id_nhanvien;
	public $id_nhasi;
    public $giohen;
    public $ghichu;
    public $duyet;
    private $errors = [];

    public function __construct($pdo)
	{
		$this->db = $pdo;
	}
    
	public function getMaLH()
	{
		return $this->ma_lh;
	}

    public function fill(array $data)
	{
		if (isset($data['ngayhen'])) {
			$this->ngayhen = trim($data['ngayhen']);
		}
        if (isset($data['giohen'])) {
			$this->giohen = trim($data['giohen']);
		}
        if (isset($data['ghichu'])) {
			$this->ghichu = trim($data['ghichu']);
		}
		if (isset($data['id_benhnhan'])) {
			$this->id_benhnhan = trim($data['id_benhnhan']);
		}
		if (isset($data['sdt'])) {
			$this->sdt = trim($data['sdt']);
		}
		if (isset($data['id_nhasi'])) {
			$this->id_nhasi = trim($data['id_nhasi']);
		}
		return $this;
	}

    public function validate()
	{
		if (!$this->ngayhen) {
			$this->errors['ngayhen'] = 'Ngày hẹn không tồn tại';
		} elseif (strtotime($this->ngayhen) < strtotime('today')) {
			$this->errors['ngayhen'] = 'Ngày hẹn phải lớn hơn hoặc bằng ngày hiện tại';
		}
        // Lấy thời gian bắt đầu và kết thúc của giờ làm việc
		$gioLamViecBatDau = strtotime('08:00');
		$gioLamViecKetThuc = strtotime('17:00');

		// Chuyển giờ hẹn sang định dạng thời gian Unix timestamp
		$gioHen = strtotime($this->giohen);

		// Kiểm tra nếu giờ hẹn không nằm trong khoảng giờ làm việc
		if ($gioHen < $gioLamViecBatDau || $gioHen > $gioLamViecKetThuc) {
			$this->errors['giohen'] = 'Giờ hẹn không hợp lệ.';
		}
		if (!$this->ghichu) {
			$this->errors['ghichu'] = 'Ghi chú không hợp lệ.';
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
		'sdt' => $this->sdt,
		'id_nhasi' => $this->id_nhasi,
		'ma_lh' => $this->ma_lh,
		'ngayhen' => $this->ngayhen,
        'giohen' => $this->giohen,
		'ghichu' => $this->ghichu,
        'duyet' => $this->duyet
		] = $row;
		return $this;
	}

    public function all()
	{
		$dmlichhen = [];
		$stmt = $this->db->prepare('select * from lichhen');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$lichhen = new Lichhen($this->db);
			$lichhen->fillFromDB($row);
			$dmlichhen[] = $lichhen;
		} return $dmlichhen;
	} 
	
	public function lichhen_cxn()
	{
		$dmlichhen = [];
		$stmt = $this->db->prepare('select * from lichhen where duyet = 0');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$lichhen = new Lichhen($this->db);
			$lichhen->fillFromDB($row);
			$dmlichhen[] = $lichhen;
		} return $dmlichhen;
	}

	public function lichhen_dxn()
	{
		$dmlichhen = [];
		$stmt = $this->db->prepare('select * from lichhen where duyet = 1');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$lichhen = new Lichhen($this->db);
			$lichhen->fillFromDB($row);
			$dmlichhen[] = $lichhen;
		} return $dmlichhen;
	}
    
    public function save()
	{
		$result = false;
		if ($this->ma_lh >= 0) {
			$stmt = $this->db->prepare('update lichhen set id_nhasi = :id_nhasi, ngayhen = :ngayhen, giohen = :giohen, ghichu =:ghichu
			                            where ma_lh = :ma_lh');
			$result = $stmt->execute([
			'id_nhasi' => $this->id_nhasi,
			'ngayhen' => $this->ngayhen,
            'giohen' => $this->giohen,
			'ghichu' => $this->ghichu,
			'ma_lh' => $this->ma_lh]);
		
		} else {
			$stmt = $this->db->prepare(
			'insert into  lichhen (id_benhnhan, id_nhasi, ngayhen, giohen, ghichu, duyet)
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
	public function save_LichHen($id_nhanvien)
	{
			$result = false;
			$stmt = $this->db->prepare(
			'insert into  lichhen (id_benhnhan, sdt, id_nhasi, id_nhanvien, ngayhen, giohen, ghichu, duyet)
			values (:id_benhnhan, :sdt, :id_nhasi, :id_nhanvien, :ngayhen, :giohen, :ghichu, 0)');
			$result = $stmt->execute([
			'id_benhnhan' => $this->id_benhnhan,
			'sdt' => $this->sdt,
			'id_nhasi' => $this->id_nhasi,
			'id_nhanvien' => $id_nhanvien,
			'ngayhen' => $this->ngayhen,
            'giohen' => $this->giohen,
			'ghichu' => $this->ghichu
			]);
			if ($result) {
				$this->ma_lh = $this->db->lastInsertId();
			}
		 	return $result;
	}
	public function duyet()
	{
		$result = false;
		if ($this->ma_lh >= 0) {
			$stmt = $this->db->prepare('update lichhen set  duyet = 1
			                            where ma_lh = :ma_lh');
			$result = $stmt->execute([
			'ma_lh' => $this->ma_lh]);
		} return $result;
	}
	public function nhankham()
	{
		$result = false;
		if ($this->ma_lh >= 0) {
			$stmt = $this->db->prepare('update lichhen set  duyet = 2
			                            where ma_lh = :ma_lh');
			$result = $stmt->execute([
			'ma_lh' => $this->ma_lh]);
		} return $result;
	}

    public function find($ma_lh)
	{
		$stmt = $this->db->prepare('select * from lichhen where ma_lh = :ma_lh');
		$stmt->execute(['ma_lh' => $ma_lh]);
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

	public function tao_lichhen(array $data, $id_nhanvien)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save_LichHen($id_nhanvien);
		} return false; 
	}
	


    public function delete()
	{
		$stmt = $this->db->prepare('delete from lichhen where ma_lh = :ma_lh');
		return $stmt->execute(['ma_lh' => $this->ma_lh]);
	}
    	public function so_Lich_Hen(){
		$stmt = $this->db->prepare("select count(*) as countLH from lichhen");
		$stmt->execute();
		$row = $stmt->fetch();
		return $row["countLH"];
	}
}
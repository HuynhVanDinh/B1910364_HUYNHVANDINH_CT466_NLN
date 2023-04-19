<?php
namespace ct466\Nhakhoa;
class Bienlai
{
	private $db;
	private $ma_bl = -1;
	public $id_benhnhan;
	public $ma_pk;
	public $id_nhanvien;
    public $tongtien;
    public $ngaythu;
    public $tinhtrang;
	private $errors = [];

	public function getMaBl()
	{
		return $this->ma_bl;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function them_bienlai(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->insert();
		} return false;
	}
	public function insert(){
		$tongtien = 0;
		$result = $this->db->prepare('select pk.*,ctpk.soluong,b.dongia from phieukham pk inner join ct_phieukham ctpk on pk.ma_pk = ctpk.ma_pk inner join benh b on ctpk.id_benh = b.benh_id where pk.ma_pk = :ma_pk and thanhtoan = 0');
		$result->execute(['ma_pk' => $this->ma_pk]);

		foreach ($result as $phieukham) {
			$tongtien = $tongtien + $phieukham['soluong']*$phieukham['dongia'];
		}
		$stmt = $this->db->prepare(
		'insert into bienlai (id_benhnhan, ma_pk, id_nhanvien, tongtien, tinhtrang, ngaythu)
		values (:id_benhnhan, :ma_pk, 1 , :tongtien, 0, now())');
		$bienlai = $stmt->execute([
		'id_benhnhan' => $this->id_benhnhan,
		'ma_pk' => $this->ma_pk,
		'tongtien' => $tongtien
		]);
		$sql = $this->db->prepare('update ct_phieukham set thanhtoan = 1 where ma_pk = :ma_pk');
		$del_ctphieukham = $sql->execute(['ma_pk' => $this->ma_pk]);
		$sql = $this->db->prepare('update phieukham set xacnhan = 1
			where ma_pk = :ma_pk');
		$del_phieukam = $sql->execute(['ma_pk' => $this->ma_pk]);
		if ($bienlai) {
			$this->id = $this->db->lastInsertId();
		}
	return $bienlai;
	}

	public function tim_bienlai($id_benhnhan){
		$bien_lai = [];
		$stmt = $this->db->prepare('select * from bienlai where id_benhnhan = :id_benhnhan');
		$stmt->execute(['id_benhnhan' => $id_benhnhan]);
		while ($row = $stmt->fetch()) {
			$bienlai = new Bienlai($this->db);
			$bienlai->fillFromDB($row);
			$bien_lai[] = $bienlai;
		} return $bien_lai;
	}

	public function all(){
		$bien_lai = [];
		$stmt = $this->db->prepare('select * from bienlai order by ma_bl desc');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$bienlai = new Bienlai($this->db);
			$bienlai->fillFromDB($row);
			$bien_lai[] = $bienlai;
		} return $bien_lai;
	}

	public function bienlai_dtt(){
		$bien_lai = [];
		$stmt = $this->db->prepare('select * from bienlai where tinhtrang = 0');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$bienlai = new Bienlai($this->db);
			$bienlai->fillFromDB($row);
			$bien_lai[] = $bienlai;
		} return $bien_lai;
	}

	public function find_bienlai_ctt($id_benhnhan)
	{
		$stmt = $this->db->prepare('select * from bienlai where id_benhnhan = :id_benhnhan and tinhtrang = 0');
		$stmt->execute(['id_benhnhan' => $id_benhnhan]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}

	public function bienlai_ctt(){
		$bien_lai = [];
		$stmt = $this->db->prepare('select * from bienlai where tinhtrang = 1');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$bienlai = new Bienlai($this->db);
			$bienlai->fillFromDB($row);
			$bien_lai[] = $bienlai;
		} return $bien_lai;
	}

	
	//Lay du lieu tu input de dua vao  csdl
	public function fill(array $data)
	{
		if (isset($data['ma_bl'])) {
			$this->ma_bl = trim($data['ma_bl']);
		}

		if (isset($data['id_benhnhan'])) {
			$this->id_benhnhan = trim($data['id_benhnhan']);
		}

		if (isset($data['ma_pk'])) {
			$this->ma_pk = trim($data['ma_pk']);
		}

		if (isset($data['id_nhanvien'])) {
			$this->id_nhanvien = trim($data['id_nhanvien']);
		}

        if (isset($data['ngaythu'])) {
			$this->ngaythu = trim($data['ngaythu']);
		}

		if (isset($data['tongtien'])) {
			$this->tongtien = trim($data['tongtien']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->id_benhnhan) {
			$this->errors['id_benhnhan'] = 'Mã bệnh nhân không hợp lệ.';
		}

		if (!$this->ma_pk) {
			$this->errors['ma_pk'] = 'Mã phiếu khám không hợp lệ.';
		}

		if ($this->tinhtrang < 0) {
			$this->errors['tinhtrang'] = 'Trạng thái không hợp lệ.';
		}

		if ($this->tongtien < 0) {
			$this->errors['tongtien'] = 'Tổng tiền không hợp lệ.';
		}

		return empty($this->errors);
	}
	
	//Lay du lieu tu csdl
	protected function fillFromDB(array $row)
	{
		[
		'ma_bl' => $this->ma_bl,
		'id_benhnhan' => $this->id_benhnhan,
		'ma_pk' => $this->ma_pk,
        'id_nhanvien' => $this->id_nhanvien,
		'tinhtrang' => $this->tinhtrang,
		'tongtien' => $this->tongtien,
		'ngaythu' => $this->ngaythu
		] = $row;
		return $this;
	}
    //Update or insert
	public function save()
	{
		$result = false;
		if ($this->ma_bl >= 0) {
			$stmt = $this->db->prepare('update bienlai set id_nhanvien = :id_nhanvien, tinhtrang = 1
			where ma_bl = :ma_bl');
			$result = $stmt->execute([
			'id_nhanvien' => $this->id_nhanvien,
			'ma_bl' => $this->ma_bl]);
		} else {
			$stmt = $this->db->prepare(
			'insert into bienlai (id_benhnhan, ma_pk, tongtien, tinhtrang, ngaythu)
			values (:id_benhnhan, :ma_pk, :tongtien, 0, now())');
			$result = $stmt->execute([
			'id_benhnhan' => $this->id_benhnhan,
			'ma_pk' => $this->ma_pk,
			'tongtien' => $this->tongtien]);
			if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		} return $result;
	}
	public function find($ma_bl)
	{
		$stmt = $this->db->prepare('select * from bienlai where ma_bl = :ma_bl');
		$stmt->execute(['ma_bl' => $ma_bl]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} else return null;
	}
	
	public function bienlai_by_date_range($start_date, $end_date){
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));
		$stmt = $this->db->prepare('SELECT * FROM bienlai WHERE ngaythu >= :start_date AND ngaythu <= :end_date');
		$stmt->execute(['start_date' => $start_date, 'end_date' => $end_date]);
		if($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			// var_dump($this);
			return $this;
		} else {
			return null;
		}
	}
	public function bienlai_by_year($year){
		$stmt = $this->db->prepare('SELECT * FROM bienlai WHERE YEAR(ngaythu) = :year');
		$stmt->execute(['year' => $year]);
		if($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			// var_dump($this);
			return $this;
		} else {
			return null;
		}
	}


	public function update(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save();
		} return false;
	}
	
	public function countBienlai(){
		$stmt = $this->db->prepare("select count(*) as count_BienLai from bienlai");
		$stmt->execute();
		$row = $stmt->fetch();
		return $row["count_Bienlai"];
	}
}
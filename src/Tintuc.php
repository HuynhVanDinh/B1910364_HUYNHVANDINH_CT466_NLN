<?php 
namespace ct466\Nhakhoa;


use PDO;

class TinTuc{
    private PDO $db;
    private $id = -1;
    public $hinhanh;
    public $noidung, $tieude;

    public function layID(){
        return $this->id;
    }
    public function setID($id){
        return $this->id = $id;
    }
    public function __construct(PDO $pdo){
        $this->db = $pdo;
    }
    
    protected function fillFromDB(array $row){
		[
			'id' => $this->id,
			'hinhanh' => $this->hinhanh,
			'noidung' => $this->noidung,
			'tieude' => $this->tieude,
			
		] = $row;
	    return $this;
	}

	public function fill(array $data, $file){
		if(isset($data['txtTieuDe'])){
			$this->tieude = trim($data['txtTieuDe']);
		}
		if(isset($data['txtNoiDung'])){
			$this->noidung = trim($data['txtNoiDung']);
		}
        if(isset($file)){
            $this->hinhanh = ($file['fileToUpload']['name']);
        }
		return $this;
	}


    public function getValidationErrors()
	{
		return $this->errors;
	}

    
    public function validate()
	{
		if (!$this->tieude) {
			$this->errors['txtTieuDe'] = 'Tiêu đề không hợp lệ.';
		}
        if (!$this->hinhanh) {
			$this->errors['fileToUpload'] = 'Ảnh không hợp lệ.';
		}
        if (!$this->noidung) {
			$this->errors['txtNoiDung'] = 'Nội dung không hợp lệ.';
		}
		return empty($this->errors);
	}
    public function all(){
		$Array = [];
		$stmt = $this->db->prepare('select * from tintuc');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
            $Tintuc = new TinTuc($this->db);
            $Tintuc->fillFromDB($row);
            $Array[] = $Tintuc;
		}
		return $Array;
	}

    public function find($id)
	{
		$sql = $this->db->prepare('select * from tintuc where id = :id');
		$sql->execute(['id' => $id]);
		if ($row = $sql->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}

	public function save(){
        $result = false;
        if ($this->id >=0){
            $sql = $this->db->prepare('update tintuc 
            set tieude = :td, hinhanh = :ha, noidung = :nd
            where id = :id');
            $result = $sql->execute([
                'td' => $this->tieude,
                'ha' => $this->hinhanh,
                'nd' => $this->noidung,
                'id' => $this->id
            ]);
            $imgname = $this->hinhanh;
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'],__DIR__.'/../public/img/upload/'.$imgname);
        } else {
            $sql = $this->db->prepare('insert into tintuc
            (tieude, hinhanh, noidung)
			values (:td, :ha, :nd)');
            $result = $sql->execute([
                'td' => $this->tieude,
                'ha' => $this->hinhanh,
                'nd' => $this->noidung
               
            ]);
            if($result){
                $this->id = $this->db->lastInsertId();
            }
            $imgname = $this->hinhanh;
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'],__DIR__.'/../public/img/upload/'.$imgname);
        }
        return $result;
    }
	public function update(array $data, $file)
	{

		$this->fill($data,$file);
		if ($this->validate()) {
			return $this->save();
		} return false; 
	}


    public function delete()
	{
		$sql = $this->db->prepare('delete from tintuc where id = :id');
		return $sql->execute(['id' => $this->id]);
	}


    public function fillImage($data){
		if (isset($data)) {
			$this->hinhanh = $data;
		}
		
		return $this;
	}

	public function search($key)
	{
		$tintucs = [];
		$stmt = $this->db->prepare("select * from tintuc where tieude LIKE '%" . $key . "%'");
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$tintuc = new Tintuc($this->db);
			$tintuc->fillFromDB($row);
			$tintucs[] = $tintuc;
		} return $tintucs;
	}
}
?>
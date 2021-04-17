<?php
include("DBConnection.php");
class Student 
{
  private $db;
  public $_id;
  public $_name;
  public $_surname;
  public $_sidiCode;
  public $_taxCode;

  public function __construct() {
    $this->db = new DBConnection();
    $this->db = $this->db->returnConnection();
  }

  public function find($id){
		$sql = "SELECT * FROM student WHERE id=:id";
		$stmt = $this->db->prepare($sql);
		$data = ['id' => $id];
		$stmt->execute($data);
		$result = $stmt->fetch(\PDO::FETCH_ASSOC);
		return $result;
	}
  public function all(){
		$sql = "SELECT * FROM student";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}
  public function insert(array $input){
		$sql = "INSERT INTO student (name, surname, sidiCode, taxCode) VALUES (:name, :surname, :sidiCode, :taxCode);";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array('name' => $input['name'], 'surname'  => $input['surname'], 'sidiCode' => $input['sidiCode'], 'taxCode' => $input['taxCode']));
		return $stmt->rowCount();
	}
  public function update($id, Array $input){
		$sql = "UPDATE student SET name = :name, surname  = :surname, sidiCode = :sidiCode, taxCode = :taxCode WHERE id = :id;";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array('id' => (int) $id, 'name' => $input['name'], 'surname' => $input['surname'], 'sidiCode' => $input['sidiCode'], 'taxCode' => $input['taxCode']));
		return $stmt->rowCount();
	}
public function delete($id){
        $sql = "DELETE FROM student WHERE id = :id;";
		$stmt = $this->db->prepare($sql);
		$stmt->execute(array('id' => $id));
		return $stmt->rowCount();
	}
?>
<?php
$method = $_SERVER["REQUEST_METHOD"];
include('./class/Student.php');
$student = new Student();

switch($method) {
  case 'GET':
    $id = $_GET['id'];
    if (isset($id)){
      $student = $student->find($id);
      $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    }else{
      $students = $student->all();
      $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
    }
    header("Content-Type: application/json");
    echo($js_encode);
    break;

  case 'POST':
	$body = file_get_contents("php://input");
	$js_decoded = json_decode($body, true);
	$add = $this->insert(array $insert);
	$js_encode = json_encode(array('state'=>TRUE, 'student'=>$student), true);
	header("Content-Type: application/json");
	echo($js_encode);
	
    break;

  case 'DELETE':
    $result = $this->db->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $this->db->delete($id);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    break;

  case 'PUT':
    $result = $this->db->find($id);
        if (! $result) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validatePerson($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->personGateway->update($id, $input);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    break;
	
	
  default:
    break;
}

function getID() {
    return explode('/', getenv('REQUEST_URI'))[4];
}


?>

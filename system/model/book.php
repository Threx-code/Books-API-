<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once "../inc/classesholder.php";

$data = json_decode(file_get_contents("php://input"));


if(isset($_GET['id']) || !empty($data->id)){
	if(!empty($data->id)){
		echo $id = $data->id;
	}
	else{
		$id = $_GET['id'];
	}

	if($validator->onlyNumber($id, 'id')){
		$data = $FormProcessor->readOneProduct($id);
		$response = http_response_code(200);
		echo json_encode(array("success code"=>$response, 'status'=>'success','data'=>$data), JSON_PRETTY_PRINT);
	}
}
else{
	$data = [];
	$response = http_response_code(400);
		echo json_encode(array("success code"=>$response, 'status'=>'bad request','data'=>$data), JSON_PRETTY_PRINT);
}

  



?>
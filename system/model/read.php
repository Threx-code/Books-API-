<?php	
header("Access-Control-Allow-Origin: *");
header("Content-Type: text; charset=UTF-8");

require_once "../inc/classesholder.php";

$data = $FormProcessor->readProduct();

$response = http_response_code(200);


echo json_encode(array("success code"=>$response, 'status'=>'success','data'=>$data), JSON_PRETTY_PRINT);
?>



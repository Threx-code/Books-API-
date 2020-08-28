<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-with");

require_once "../inc/classesholder.php";





$data = json_decode(file_get_contents("php://input"));


if(isset($_GET['name']) || !empty($data->search)){
	if(!empty($_GET['name'])){
		$search = $_GET['name'];
	}
	else{
		$search = $data->search;
	}


	$search =  trim(preg_replace('/\s+/', '', $search));

	$url = "https://www.anapioficeandfire.com/api/books?name:$search";
	$params = "1";
	$request_url = $url.$params;

	/*initializing the CURL*/
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	 if ($err) {
	    echo "cURL Error #:" . $err;
	} 
	else{
	    if ($response){
	 		$result = json_decode($response,true);

	 		$code = http_response_code(200);
	 		echo json_encode(array("success code"=>$code, 'status'=>'success', 
	 			'data'=>[
					"name"=>$result[0]['name'], 
					"isbn"=>$result[0]['isbn'],
					"authors"=>[$result[0]['authors']],
					"number_of_pages"=>$result[0]['numberOfPages'],
					"publisher"=>$result[0]['publisher'],
					"country"=>$result[0]['country'],
					"released"=>$result[0]['released'],
				]
			), JSON_PRETTY_PRINT);
	 	}
	}
}
else{
	echo json_encode(array('message'=>'Please enter search'));
}



?>
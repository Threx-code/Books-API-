<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// add the database
require_once "../config/database.php";
// add the product class file
require_once "../object/product.php";


//create object of database
$database = new Database();
$db = $database->getConnection();


// create object of Product
$product = new Product($db);
$stmt = $product->read();
$num = $stmt->rowCount();


if($num > 0){
	$product_array = array();
	$product_array['records'] = array();

	    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($rows);
		$product_item = array(
				"id"=>$id,
				"name"=>$name,
				"price"=>$price,
				"description" =>html_entity_decode($description),
				"category_id" =>$category_id,
				"category_name" =>$category_name,
				"created"=>$created
		);
		array_push($product_array['records'], $product_item);
	}

		http_response_code(200);
		echo json_encode($product_array);
}
else{
	http_response_code(400);
	$message = "No product to display yet";
	echo json_encode(array("message"=>$message));
}





?>
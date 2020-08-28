<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text; charset=UTF-8");

require_once "../inc/classesholder.php";

$data = $FormProcessor->getCategory();
echo "<option></option>";
foreach ($data as $value):
	

	echo "<option>".$value->category."</option>";
endforeach;

		


?>
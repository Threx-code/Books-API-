<?php
class Product{
	private $connection;
	private $table_name = "products";
	public $stmt;

	public $id;
	public $name;
	public $price;
	public $created;
	public $description;
	public $category_id;
	public $category_name;


	public function __construct($db){
		$this->connection = $db;
	}

	

	public function read(){
		$query = "SELECT c.name AS category_name, p.id, p.name, p.price, p.description, p.created, p.category_id FROM $this->table_name p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created DESC";
		$this->stmt = $this->connection->prepare($query);
		$this->stmt->execute();

		return $this->stmt;
	}

	public function create(){
		$query = "INSERT INTO $this->table_name ()"
	}

}



?>
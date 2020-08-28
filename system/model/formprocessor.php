<?php
class FormProcessor{
	private $db;

	public function __construct(){
		$this->db = new Database();
	}

	/*checking if product category already exist*/
	public function categoryExist($data){
		$data = ltrim(rtrim($data));
		$this->db->query("SELECT count(*)  FROM categories WHERE category = :category ");
		$this->db->bindStatement(':category', $data);
		$num=$this->db->numCounter();
		if(empty($num)){
			return $data;
		}
		else{
			echo json_encode(array("message"=>"Sorry category already exist"));
		}
	}




	/*creating category*/
	public function createCategory($data){
		$this->db->query("INSERT INTO categories (category, created)
			VALUES(:category, :created)");
		$this->db->bindStatement(":category", $data->category);
		$this->db->bindStatement(":created", $data->created);
		if($this->db->execute()){
			echo json_encode(array("message"=>"Category Created"));
		}
		else{
			echo json_encode(array("message"=>"Sorry Unable to Create Category"));
		}
	}


	
	public function getCategory(){
		$this->db->query("SELECT * FROM categories ORDER BY category DESC");
		$data = $this->db->fetchAll();
		return $data;
	}


	/*checking if product category already exist*/
	public function categoryIsValid($data){
		$data = ltrim(rtrim($data));
		$this->db->query("SELECT count(*)  FROM categories WHERE category = :category ");
		$this->db->bindStatement(':category', $data);
		$num=$this->db->numCounter();
		if($num){
			return $data;
		}
		else{
			echo json_encode(array("message"=>"Sorry invalid category"));
		}
	}


	/*book checking if it exist*/


	public function bookExist($data){
		$data = ltrim(rtrim($data));
		$this->db->query("SELECT count(*)  FROM books WHERE isbn = :isbn ");
		$this->db->bindStatement(':isbn', $data);
		$num=$this->db->numCounter();
		if(!$num){
			return $data;
		}
		else{
			echo json_encode(array("message"=>"Sorry book already exist"));
		}
	}


	public function editBookExist($data){
		$data = ltrim(rtrim($data));
		$this->db->query("SELECT count(*)  FROM books WHERE id = :id");
		$this->db->bindStatement(':id', $data);
		$num=$this->db->numCounter();
		if($num){
			return $data;
		}
		else{
			echo json_encode(array("message"=>"Sorry book does not exist"));
		}
	}

	
		/*INSERTING PRODUCT INTO THE DATABASE*/
 	
	public function newProductCreator($data){
		/*SELECTING CATEGORY ID*/
		$this->db->query("SELECT id FROM categories WHERE category = :category");
		$this->db->bindStatement(":category", $data->category);
		$cat_id = $this->db->fetchSingle();

		/*INSERTING PRODUCT INTO THE DATABASE*/
		$this->db->query("INSERT INTO books (name, isbn, author, country, publisher, number_of_pages, category_id, release_date)

			VALUES(:name, :isbn, :author, :country, :publisher, :number_of_pages, :category_id, :release_date)");

		$this->db->bindStatement(":name", $data->name);
		$this->db->bindStatement(":isbn", $data->isbn);
		$this->db->bindStatement(":author", $data->author);
		$this->db->bindStatement(":country", $data->country);
		$this->db->bindStatement(":publisher", $data->publisher);
		$this->db->bindStatement(":number_of_pages", $data->pages);
		$this->db->bindStatement(":release_date", $data->date);
		$this->db->bindStatement(":category_id", $cat_id->id);


		if($this->db->execute()){
			$response = http_response_code(200);
			echo json_encode(array("message"=>"Product Successfully Posted", "success"=>$response));
		}
		else{
			echo json_encode(array("message"=>"Sorry Unable to Post Product"));
		}
	}

	public function readProduct(){
		$this->db->query("SELECT bn.category 
					AS book_category, b.id, b.name, b.isbn, b.author, b.country, b.publisher, b.number_of_pages, b.category_id, b.release_date FROM books b LEFT JOIN categories bn ON b.category_id = bn.id ORDER BY b.id DESC");
		$data = $this->db->fetchAll();
		return $data;
	}


	public function readOneProduct($id){
		$this->db->query("SELECT bn.category 
					AS book_category, b.id, b.name, b.isbn, b.author, b.country, b.publisher, b.number_of_pages, b.category_id, b.release_date FROM books b LEFT JOIN categories bn ON b.category_id = bn.id
					WHERE b.id = :id
					 ORDER BY b.id DESC");
		$this->db->bindStatement(":id", $id);
		$data = $this->db->fetchAll();
		return $data;
	}


	


	/*updating books*/

	public function updateBook($data){
		$this->db->query("UPDATE books SET name = :name WHERE id = :id");
		$this->db->bindStatement(":name", $data->name);
		$this->db->bindStatement(":id", $data->id);
		$this->db->execute();

		$this->db->query("UPDATE books SET isbn = :isbn WHERE id = :id");
		$this->db->bindStatement(":isbn", $data->isbn);
		$this->db->bindStatement(":id", $data->id);
		$this->db->execute();


		$this->db->query("UPDATE books SET author = :author WHERE id = :id");
		$this->db->bindStatement(":author", $data->author);
		$this->db->bindStatement(":id", $data->id);
		$this->db->execute();

		$this->db->query("UPDATE books SET country = :country WHERE id = :id");
		$this->db->bindStatement(":country", $data->country);
		$this->db->bindStatement(":id", $data->id);
		$this->db->execute();

		$this->db->query("UPDATE books SET publisher = :publisher WHERE id = :id");
		$this->db->bindStatement(":publisher", $data->publisher);
		$this->db->bindStatement(":id", $data->id);
		$this->db->execute();

		$this->db->query("UPDATE books SET number_of_pages = :pages WHERE id = :id");
		$this->db->bindStatement(":pages", $data->pages);
		$this->db->bindStatement(":id", $data->id);
		$this->db->execute();

		$this->db->query("UPDATE books SET release_date = :dates WHERE id = :id");
		$this->db->bindStatement(":dates", $data->date);
		$this->db->bindStatement(":id", $data->id);
		$this->db->execute();

		return true;
	}



	/*updating books*/

	public function deleteBook($data){
		$this->db->query("DELETE FROM books WHERE id = :id");
		$this->db->bindStatement(":id", $data->id);
		$this->db->execute();
		return true;
	}



	









}

?>
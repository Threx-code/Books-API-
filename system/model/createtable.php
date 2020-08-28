<?php

/*
- BEFORE YOU RUN THIS CODE, PLEASE FOLLOW THE BELOW EASY STEPS


1. RUN COMMAND PROMPT ON YOUR SYSTEM IF YOU AARE WORKING ON LOCAL SERVER
2. TYPE xampp\mysql\bin\mysql -u root
3. CREATE DATABASE (PLEASE ENTER THE NAME OF THE DATABASE YOU WISH)
4. USE (ENTER NAME OF THE DATABASE YOU CREATED)
4. GRANT ALL ON (NAME OF THE DATABASE YOU CREATE) .* TO 'ENTER THE NAME OF THE user'@'localhost' IDENTIFIED BY 'ENTER PASSWORD FOR THE user'


*/
class CreateTable{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

/*

TO CREATE NEW TABLE(S) PLEASE FOLLOW THE FORMAT BELLOW
*/
	public function createTable(){
		try {

			$query =$this->db->query("CREATE TABLE books(
			id INT(11) NOT NULL AUTO_INCREMENT,
			name VARCHAR (255) NOT NULL,
			isbn VARCHAR (60) NOT NULL,
			author VARCHAR (255) NOT NULL,
			country VARCHAR(255) NOT NULL,
			publisher VARCHAR(255) NOT NULL,
			number_of_pages INT(11) NOT NULL,
			category_id INT(11) NOT NULL,
			release_date VARCHAR(20) NOT NULL,
			INDEX(name(6)),
			INDEX(isbn(6)),
			INDEX(author(6)),
			INDEX(publisher(6)),
			INDEX(country(6)),
			PRIMARY KEY (id)) ENGINE MyISAM DEFAULT CHARSET= latin1 AUTO_INCREMENT=1");
			$this->db->execute($query);
		} 
		catch (PDOException $e) {
			echo  "Table books error: ".$e->getMessage();
		}

		try {

			$query =$this->db->query("CREATE TABLE categories(
			id INT(11) NOT NULL AUTO_INCREMENT,
			category VARCHAR (255) NOT NULL,
			created VARCHAR(20) NOT NULL,
			INDEX(category(6)),
			PRIMARY KEY (id)) ENGINE MyISAM DEFAULT CHARSET= latin1 AUTO_INCREMENT=1");
			$this->db->execute($query);
		} 
		catch (PDOException $e) {
			echo  "Table categories error: ".$e->getMessage();
		}
	}
}
?>

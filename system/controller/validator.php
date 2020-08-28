<?php
class Validator{
	private $db;

	public function __construct(){
		$this->db = new Database();
	}

	/*session Id*/
	public function sessionId(){
		$this->db->sameSessionId();
	}

	/*security token*/
	public function crfToken(){
		return $this->db->crfToken();
	}

	public function selfURL(){
		return $this->db->selfURL();
	}

	/*security token exprire time*/
	public function tokenTime(){
		return $this->db->tokenTime();
	}

	public function checkToken($var){
		return $this->sanitizeString($this->db->checkToken($var));
	}

	/*sanitizing user input*/
	public function sanitizeString($var){
		return $this->db->sanitizeString($var);
	}

	/*empty variable*/
	public function isEmpty($string, $attribute){
		return $this->sanitizeString($this->db->isEmpty($string, $attribute));
	}


	
	/*name validation*/
	public function inputChecker($name, $attribute){
		return $this->sanitizeString($this->db->inputChecker($name, $attribute));
	}

	

	/*surname validation*/
	public function allNameChecker($name, $attribute){
		return $this->sanitizeString($this->db->allNameChecker($name, $attribute));
	}

	

	/*date validation*/

	public function alphaDate($date, $attribute){
		return $this->sanitizeString($this->db->alphaDate($date, $attribute));
	}

	/*textarea validation*/
	public function textArea($string, $attribute){
		return $this->sanitizeString($this->db->textArea($string, $attribute));
	}



	public function selectChecker($string, $attribute){
		return $this->sanitizeString($this->db->selectChecker($string, $attribute));
	}



	/*only number*/
	public function onlyNumber($var, $attribute){
		return $this->sanitizeString($this->db->onlyNumber($var, $attribute));
	}

	

	/*alphaNumeric checker*/
	public function alphaNumeric($var, $attribute){
		return $this->sanitizeString($this->db->alphaNumeric($var, $attribute));
	}



	/*getting mime types*/
	public function mimeType($fileTemName, $fileUrl, $FileType){
		return $this->sanitizeString($this->db->mimeType($fileTemName, $fileUrl, $FileType));
	}

	public function unlinkFile($fileUrl){
		return $this->sanitizeString($this->db->unlinkFile($fileUrl));
	}


	/*THIS METHODS ARE FOR IMAGE*/
	public function imageValidation($imageType, $imageURL, $tempName, $imageSize, $pngSize, $attribute){
		return $this->sanitizeString($this->db->imageValidation($imageType, $imageURL, $tempName, $imageSize,$pngSize, $attribute));
	}


	/*END OF METHODS FOR IMAGES*/









}


?>
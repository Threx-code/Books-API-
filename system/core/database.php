<?php
/*using PDO to connection to the database*/

class Database{
	private $db_host = DB_HOST;
	private $db_name = DB_NAME;
	private $db_user = DB_USER;
	private $db_pass = DB_PASS;


	private $stmt;
	private $error;
	private $db_conn;


	protected static $crf_token = NULL;
	protected static $token_time = NULL;

	/*DATABASE CONNECTION START*/
	public function __construct(){
		$dsn = 'mysql:host='.$this->db_host.';dbname='.$this->db_name;

		$options = array(
						PDO::ATTR_PERSISTENT=>TRUE,
						PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
					);
		// CONNECTING TO THE DATABASE
		try{
		$this->db_conn = new PDO($dsn, $this->db_user, $this->db_pass, $options);
		}
		catch(PDOException $e){
			//$this->error = $e->getMessage();
			exit("Sorry database connection lost");
		}
	}
	/*DATABASE CONNECTION END*/


	/*DATABASE QUERY SETUP*/
	public function query($query){
		$this->stmt = $this->db_conn->prepare($query);
	}
	/*DATABASE QUERY SETUP*/



	/*DATABASE BIND THE STATEMENT*/

	public function bindStatement($param, $value, $type=NULL){
		if(is_null($type)){
			switch (TRUE) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;

				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;

				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				
				default:
					$type = PDO::PARAM_STR;
					break;
			}
		}

	$this->stmt->bindValue($param, $value, $type);
	}

	/*DATABASE BIND THE STATEMENT*/


	/*EXECUTING THE STATEMENT*/
	 public function execute(){
	 	return $this->stmt->execute();
	 }
	/*EXECUTING THE STATEMENT*/



	/*FETCHING ALL DATA AT ONCE*/

	public function fetchAll(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	/*FETCHING ALL DATA AT ONCE*/



	/*FETCH ONLY A SINGLE DATA*/

	public function fetchSingle(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	public function numCounter(){
		$this->execute();
		$num = $this->stmt->fetchColumn();
		return $num;

	}


	// creating crf token

	public function crfToken(){
		if(empty($_SESSION['crf_token'])){
			$_SESSION['crf_token'] = bin2hex(random_bytes(32));
			htmlentities($_SESSION['crf_token'], ENT_QUOTES | ENT_HTML5, 'UTF-8'); 
		}

		return $_SESSION['crf_token'];
	}


	public function tokenTime(){
		if(empty($_SESSION['token_time'])){
			$_SESSION['token_time'] = time() + 3600;
		}
		return $_SESSION['token_time'];
	}

	public function checkToken($var){
		if(!empty($var) && time() < $this->tokenTime()){
		if(hash_equals($var, $this->crfToken())){
		return $this->crfToken();
		return $this->tokenTime();
	}
	else{
		echo "You need to refresh this page <a href=''>Click here</a>";
	}
	}
	else{
		unset($_SESSION['token_time']);
		unset($_SESSION['crf_token']);
		echo "Page expired, click here to <a href=''>Refresh</a>";
	}
	}


			
	//generating session ID
	public function sameSessionId(){
	session_id();
	session_regenerate_id();
	}

	// sanitizing user input
	public function sanitizeString($var){	
	$var = strip_tags($var);
	$var= htmlentities($var);
	$var= stripslashes($var);
	$var = filter_var($var, FILTER_SANITIZE_STRING);
	return $var;
	}


/*INPUT SANITIZERS*/

/*if variable is empty*/
public function isEmpty($string, $attribute){
	if(!empty($string)){
		return $string;
	}
	else{
		echo json_encode(array("message"=>"Please enter $attribute"));
	}
}




/*empty value checker*/

	public function inputChecker($name, $attribute){
		$name_expression = "/^[ A-Za-z._-]+$/";
	if(!empty($name)){
	if(preg_match($name_expression, $name)){

		$name = preg_replace('!\s+!', ' ', $name);
		return $name;
	}else{
		echo json_encode(array("message"=>"Invalid character in the $attribute field"));
	}
	}
	else{
		echo json_encode(array("message"=>"Please enter your $attribute"));
	}
	}


	public function allNameChecker($name, $attribute){
		$name_expression = "/^[ A-Za-z._-]+$/";
	if(!empty($name)){
	if(preg_match($name_expression, $name)){
		$name = preg_replace('!\s+!', '', $name);
		return $name;
	}else{
		echo json_encode(array("message"=>"Invalid character in the $attribute field"));
	}
	}
	else{
		echo json_encode(array("message"=>"Please enter your $attribute"));
	}
	}


	/*textarea checker*/

	public function textArea($string, $attribute){
	if(!empty($string)){
	if(strlen($string) > 10){

		return $string;

	}
	else{
		echo json_encode(array("message"=>"$attribute too short"));
	}
	}
	else{
		echo json_encode(array("message"=>"Please enter $attribute"));
	}
	}



	/*empty checker*/
	public function selectChecker($string, $attribute){
	if(!empty($string)){
	return $string;
	}
	else{
		echo json_encode(array("message"=>"Please select $attribute"));
	}
	}


	/*only number method*/
	public function onlyNumber($var, $attribute){
	$var = preg_replace('!\s+!', '', $var);
	if(!empty($var)){
	if(is_numeric($var)){
	return $var;
	}
	else{
		echo json_encode(array("message"=>"Sorry only numbers allowed in $attribute field"));
	}
	}
	else{
		echo json_encode(array("message"=>"Please enter $attribute"));
	}
	}



	/*address checker*/
	public function alphaNumeric($var, $attribute){
		$alphaNumeric = "/^[ A-Za-z0-9()._-]+$/";
		if(!empty($var)){
		if(preg_match($alphaNumeric, $var)){
			return $var;
		}
		else{
			echo json_encode(array("message"=>"Invalid $attribute entered"));
		}
		}
		else{
			echo json_encode(array("message"=>"Please enter $attribute"));
		}
		}


		public function alphaDate($var, $attribute){
		$alphaDate = "/^[0-9-]+$/";
		if(!empty($var)){
		if(preg_match($alphaDate, $var)){
			return $var;
		}
		else{
			echo json_encode(array("message"=>"Invalid $attribute entered"));
		}
		}
		else{
			echo json_encode(array("message"=>"Please enter $attribute"));
		}
		}




		public function dateOption($date, $attribute){
		$date_of_birth_expression ="/^[0-9]+\/[0-9]+\/[0-9]{2,4}$/";
		if(!empty($date)){
			if(preg_match($date_of_birth_expression, $date)){

				$dateChecker = $date;

				$dateChecker = explode("/", $date);
				$day = $dateChecker[0];
				$month = $dateChecker[1];
				$year = $dateChecker[2];
				if($day > 0 && $day <=31 && strlen($day) ==2){
					if($month > 0 && $month <=12 && strlen($month) ==2){
						if($year > 1900 && strlen($year) ==4){
							return $date;
						}
						else{
							echo "Invalid $attribute year entered (year should be greater than 1900)";
						}
					}
					else{
						echo "Invalid $attribute month entered (month should be between 01 - 12)";
					}
				}
				else{
					echo "Invalid $attribute day entered (day should be between 01 - 31)";
				}
			}
			else{
				echo "Invalid $attribute entered (dd/mm/yyyy)";
			}
		}
		else{
			echo "Please enter $attribute";
		}
	}



	/*image methods*/

	public function imageValidation($imageType, $imageURL, $tempName, $imageSize, $pngSize, $attribute){
		/*first check the type of the image submitted*/
		if(($imageType =="image/jpeg")||
		   ($imageType =="image/png") ||
		   ($imageType =="image/jpg") ||
		   ($imageType =="image/gif") ||
		   ($imageType =="image/tif")){

			/*create a link where the image should be saved*/
		   	$imageURL = $imageURL;

		   	/* move the temporary file name to the folder to be saved*/
		   move_uploaded_file($tempName, $imageURL);

		   /*theres a need to check the mime type*/
		   if(function_exists('finfo_open')){
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mtype = finfo_file($finfo, $imageURL);
			finfo_close($finfo);
		}
		elseif (function_exists('mime_content_type')) {
			$mtype = mime_content_type($imageURL);
		}

		if(($mtype =="image/jpg")|| ($mtype =="image/jpeg")	|| 
		($mtype =="image/png")||($mtype =="image/tif") ||($mtype =="image/gif")){

			$typeOk = True;

		switch($mtype) {
		case "image/gif": $src = imagecreatefromgif($imageURL); break;
		case "image/jpeg": 
		case "image/pjpeg": $src = imagecreatefromjpeg($imageURL); break;
		case "image/png": $src = imagecreatefrompng($imageURL); break;

		default: 			$typeOk = FALSE; break; 
		}

		if($typeOk){

		list($width, $height) = getimagesize($imageURL);

		$max = $imageSize;
		$newheight = $height;
		$newwidth = $width;


	if($width > $height && $max <$width){
		$newheight = $max / $width * $height;
		$newwidth = $max;
	}

	elseif($height >$width && $max < $height){
		$newwidth = $max / $height * $width;
		$newheight = $max;
	}

	elseif ($max < $width) {
		$newwidth = $newheight = $max;
	}



	$image_type  = $mtype;

	if($image_type =='image/png' && filesize($imageURL) >$pngSize){
  $tmp = imagecreatetruecolor($newwidth, $newheight);
  imagealphablending($tmp, FALSE);
  imagesavealpha($tmp, TRUE);
  imagefill($tmp, 0, 0, imagecolorallocatealpha($src, 0, 0, 0, 127));
  imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imageconvolution($tmp, array(array(-1, -1, -1,), array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
  imagepng($tmp, $imageURL);
  imagedestroy($tmp);
  imagedestroy($src);
  }
  elseif($image_type =='image/png' && filesize($imageURL) <$pngSize){
  $tmp = imagecreatetruecolor($newwidth, $newheight);
  imagealphablending($tmp, FALSE);
  imagesavealpha($tmp, TRUE);
  imagefill($tmp, 0, 0, imagecolorallocatealpha($src, 0, 0, 0, 127));
  imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imageconvolution($tmp, array(array(-1, -1, -1,), array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
  imagedestroy($tmp);
  imagedestroy($src);
  }

  else{
  
  $tmp = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
  imageconvolution($tmp, array(array(-1, -1, -1,), array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
  imagejpeg($tmp, $imageURL);
  imagedestroy($tmp);
  imagedestroy($src);
  }

  return 	true;
 }
else{
		echo "Invalid $attribute";
	}
}
	else{
		unlink($imageURL); // this will remove the image if its not the type accepted
		echo "Invalid $attribute";
		}
		}
	else{
		echo "Invalid $attribute";
}
}


}
?>
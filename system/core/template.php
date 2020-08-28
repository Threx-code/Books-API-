<?php

/*
======================================================================================================================================================================================================================

THIS WILL SERVE AS THE TEMPLATE FOR ALL THE PAGES OF THE APP

======================================================================================================================================================================================================================
*/


class Template{
	protected $template;
	protected $vars = array();

	public function __construct($template){
		$this->template = $template;
	}


	public function __get($key){
		return $this->vars[$key];
	}

	public function __set($key, $value){
		$this->vars[$key] = $value;
	}


	public function __toString(){
		extract($this->vars);

		chdir(dirname($this->template));

		ob_start();

		include basename($this->template);

		return ob_get_clean();

	}
}


/*
======================================================================================================================================================================================================================

PLEASE ENSURE ONLY CERTIFIED ADMINISTRATOR OPENS THIS FILE, ELSE THERE IS NO NEED TO CHANGE ANY INFORMATION IN THIS FILE. 

======================================================================================================================================================================================================================
*/
?>
<?php
require_once "syspath.php";
require_once SYS_PATH."/config/config.php";

date_default_timezone_set(APP_TIMEZONE);

spl_autoload_register("class_autoloader");

$uri_array = parse_uri();
$class_name = get_controller_classname($uri_array);


/*start of templates for the pages

if you are creating a multiple pages application, you can declare the name of the page and the page template here 
*/
if($class_name == "Home"){
    $template = new Template(SYS_PATH."/view/homepage.php");
}

/*end of templates for the pages*/


/*if classes are empty it returns to default class*/
if(empty($class_name)){
    $class_name = "Home";
    $template = new Template(SYS_PATH."/view/homepage.php");
}




try {
    $controller = new $class_name();
} catch (Exception $e) {
 echo $e->getMessage();
}


/*initialiing the app*/

$validator = new Validator();
$template->crfToken = $validator->crfToken();




require_once SYS_PATH.'/inc/style_script.php';
require_once SYS_PATH.'/inc/header.php';
echo $template;
require_once SYS_PATH.'/inc/footer.php';


?>
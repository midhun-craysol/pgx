<?php
require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

//Defining allowed routes 


if ((isset($uri[2]) && array_key_exists($uri[2],$routes))) {
    $route = preg_split("#/#", $routes[$uri[2]]); 
    
    if(!empty($route) && $route[0]!='' && $route[1] !=''){        
        $fileName = ($route[2]!='')?PROJECT_ROOT_PATH."/controllers/".$route[0]."/".$route[1]."Controller.php":PROJECT_ROOT_PATH."/Controllers/".$route[0]."Controller.php";
        define("CURRENT_ROUTE",$uri[2]);
        if(file_exists($fileName)){
            require($fileName);
            $controller = ($route[2]!='')?$route[1]."Controller":$route[0]."Controller";
            $objFeedController = new $controller();
            $strMethodName = ($route[2]!='')?$route[2].'Action':$route[1].'Action';
            $objFeedController->{$strMethodName}();
        }
        else{            
            header("HTTP/1.1 404 Not Found");
        exit();
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
        exit();
    }

}
else {
    header("HTTP/1.1 404 Not Found");
    exit();
}
 


?>
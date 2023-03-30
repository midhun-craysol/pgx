<?php
require_once  MODEL_PATH."LoginModel.php";
// require_once  MODEL_PATH."HelperModel.php";
class LoginController  extends  BaseController
{  
    public function __construct(){ 
        $this->crudModel = new CrudModel();
        $this->loginModel = new LoginModel();  
        $this->companyuser_m = $this->crudModel->getPageTableName("companyuser_m");
    }

    public function loginAction(){   
        $this->loadView("login/header");   
        $this->loadView("login/index"); 
        $data["scripts"] = ["login"];  
        $this->loadView("login/footer",$data);    
    }

    public function verifyLoginAction(){ 
            $requestMethod = $_SERVER["REQUEST_METHOD"]; 
            if($requestMethod != 'POST'){                    
                $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));
            } else {                    
                $errors = [];                  
                $fields = ["UserName","UserPassword"]; 
                $optionalFields = [];
                $values = [];
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    foreach ($fields as $field) {
                        if (empty($_POST[$field]) && !in_array($field, $optionalFields)) {
                            $errors[] = $field;
                        }
                        else {                        
                            $values[$field] = $_POST[$field];                        
                        }
                    } 
                    if(!empty($errors)){      
                            $responseData = json_encode(array("Status"=>0,"Message"=>"Please enter all fields","fields"=>$errors)); 
                    } 
                    else {    
                            $responseData = $this->loginModel->verifyLogin($values);
                    } 
                    $this->sendOutput(
                        $responseData,
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                }
            } 
    }

}
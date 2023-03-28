<?php
require_once  MODEL_PATH."system/LoginModel.php";
// require_once  MODEL_PATH."HelperModel.php";
class LoginController  extends  BaseController
{  
    //login
    public function __construct(){ 
        $this->crudModel = new CrudModel();
        $this->loginModel = new LoginModel();  
    }

    public function loginAction(){   
        $this->loadView("login/header");   
        $this->loadView("login/index"); 
        $data["scripts"] = ["system/login"];  
        $this->loadView("login/footer",$data);    
    }

    public function verifyLoginAction(){
        
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if($requestMethod != 'POST'){                    
            $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));
        } 
        else {                    
            $errors = [];                    
            $fields = ["UserName","UserPassword","userType"]; 
            $optionalFields = ["userType"];
            $values = [];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                
                foreach ($fields as $field) {
                    if (empty($_POST[$field]) && !in_array($field, $optionalFields)) {
                        $errors[] = $field;
                    } else {                        
                        $values[$field] = $_POST[$field];                        
                    }
                }
               
                
               $tableName ="sysusers";
                
                $UserPassword=$values['UserPassword'];                    
                if(!empty($errors)){                    
                    $this->sendOutput(
                        json_encode(array("Status"=>0,"Message"=>"Please enter all fields","fields"=>$errors)),
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                } 
                else {
                    
                    $UserPassword=md5($values['UserPassword']);
                    
                   if($tableName=="sysusers"){
                    $condition = " WHERE BINARY `SysUserLoginID`='".$values['UserName']."' AND `SysUserPswd`='".$UserPassword."' AND `Status`='1'"; 
                   }

                    $responseData = $this->loginModel->verifyLogin($tableName,$condition);
                
                    $this->sendOutput(
                        $responseData,
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                }



            }
        }
    }

}
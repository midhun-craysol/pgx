<?php
session_start();
require_once  MODEL_PATH."system/LoginModel.php";
class UserController  extends  UserBaseController
{  
  
    public function __construct(){
                  
        $this->crudModel = new CrudModel();
        $this->LoginModel = new LoginModel();
        $this->table = "user";

    }

    public function LogoutAction(){  
        if(!empty($_SESSION['pgx'])){
            session_unset();
            session_destroy();
            header('Location: login');
        }   
    }

    public function themeAction(){  
        $_SESSION["pgx"]["css"]=""; 
        unset($_SESSION["pgx"]["css"]);
        $theme=$_POST["theme"];
        if(isset($theme)&& $theme!=""){
            $_SESSION["pgx"]["css"]="$theme";
            echo "1";

         }else{
            echo "2";
         }
  
      
    }

    
    public function dashboardAction()
    {   
        if(isset($_SESSION['pgx']["loggedIn"])&&$_SESSION['pgx']["UserLoginID"]){ 
            $menuData['breadhome'] = 'General';
            $menuData['breadpage'] = '';
            $layout=true;
            if($_SERVER["REQUEST_METHOD"] == 'POST')
            {    
                if( $_POST['dAccess'] =="dashboard") { 
                    $layout =false;
                }         
            }
            if($layout){      
                $this->loadView("parts/header",[],$menuData);
            }         
            $data =[];
            $this->loadView("system/pages/dashboard",$data);   
            
            if($layout){   
                $data["scripts"] = ["system/chooseoffice"];            
                $this->loadView("parts/footer",$data); 
            }
        } else { 
                $this->loadView("login/header");   
                $this->loadView("login/index"); 
                $data["scripts"] = ["system/login"];  
                $this->loadView("login/footer",$data);  
        }
    }

}
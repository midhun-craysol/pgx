<?php
session_start();
require_once  MODEL_PATH."LoginModel.php";
class UserController  extends  UserBaseController
{  
  
    public function __construct(){
                  
        $this->crudModel = new CrudModel();
        $this->LoginModel = new LoginModel();
        $this->table = "user";

    }

    // public function LogoutAction(){  
    //     if(!empty($_SESSION['pgx'])){
    //         session_unset();
    //         session_destroy();
    //         header('Location: login');
    //     }   
    // }
    public function LogoutAction(){
        session_start();  
        unset($_SESSION['pgx']);  
        // echo "1"; 
        header('Location: login');         
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
            // print_r($_SESSION['pgx']); die();
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
            $this->loadView("pages/dashboard",$data);   
            
            if($layout){   
                $data["scripts"] = ["chooseoffice"];            
                $this->loadView("parts/footer",$data); 
            }
        } else { 
                print_r($_SESSION['pgx']);
                $this->loadView("login/header");   
                $this->loadView("login/index"); 
                $data["scripts"] = ["login"];  
                $this->loadView("login/footer",$data);  
        }
    }
    public function setSessionAction(){
        $UserDetails    = $_POST['resultData']['data']['UserDetails'][0];
        $OfficeLIst     = $_POST['resultData']['data']['OfficeLIst'];
        $PaygList       = $_POST['resultData']['data']['PaygList'];
        session_start();  
        $_SESSION['pgx']["loggedIn"]            ="1"; 
        $_SESSION['pgx']["CompanyUserID"]       = $UserDetails['CompanyUserID'];
        $_SESSION['pgx']["CompanyID"]           = $UserDetails['CompanyID'];
        $_SESSION['pgx']["UserName"]            = $UserDetails['UserName'];
        $_SESSION['pgx']["UserLoginID"]         = $UserDetails['UserLoginID'];
        $_SESSION['pgx']["CompUserEmail"]       = $UserDetails['CompUserEmail'];
        $_SESSION['pgx']["PhoneNumber"]         = $UserDetails['PhoneNumber'];
        $_SESSION['pgx']["UserPswd"]            = $UserDetails['UserPswd'];
        $_SESSION['pgx']["PswdChangeFlg"]       = $UserDetails['PswdChangeFlg'];
        $_SESSION['pgx']["RootUserFlg"]         = $UserDetails['RootUserFlg']; 

        $_SESSION['pgx']["CompanyOfficeList"]   = $OfficeLIst;  
        $_SESSION['pgx']["PaygList"]            = $PaygList; 
        echo 1;
    } 
    public function setOfficeSessionAction()
	{
		$_SESSION['pgx']["CompanyOfficeID"]     =   $_POST['CompanyOfficeID']; 
		$_SESSION['pgx']["CompanyOfficeName"]   =   $_POST['CompanyOfficeName'];   
        unset($_SESSION['pgx']["CompanyOfficeList"]);
	}
    public function setPayGateSessionAction()
	{
		$_SESSION['pgx']["PayGateID"]            =   $_POST['PayGateID']; 
		$_SESSION['pgx']["PaymentGatewayName"]   =   $_POST['PaymentGatewayName']; 
		$_SESSION['pgx']["PayGateDateDetails"]   =   $_SESSION['pgx']['payGateDet'][$_POST['PayGateID']];   
	        unset($_SESSION['pgx']["PaygList"]); 
	        unset($_SESSION['pgx']["payGateDet"]);  

	}
}
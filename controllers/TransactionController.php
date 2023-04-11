<?php
require_once  MODEL_PATH."TransactionModel.php";
require_once  MODEL_PATH."HelperModel.php";
class TransactionController  extends  UserBaseController
{  
    public function __construct(){
        $this->crudModel = new CrudModel();
        $this->TransactionModel = new TransactionModel();
        $this->helperModel = new HelperModel();        
        
    }
    public function tranStatusAction(){
     
      
    }
    public function newTranAction(){
        $timeStart = microtime(true);   
        $data['loadTimeStart'] =  microtime(true); 
        $data['pageID'] =  "0005"; 
        $menuData['breadhome'] = 'Craysol Pay';
        $menuData['breadpage'] = 'Make Payment';
        if( $_SERVER["REQUEST_METHOD"] == 'POST' && $_POST['dAccess'] =="dashboard" )
        {
            $vars = [
                "pageName" => "Craysol Pay" ,
                "pageTitle" =>"Make Payment"  
                ]; 
            $this->loadView("pages/transactionForm",[],$vars);  
            $starttime = microtime(true);      
            $data["scripts"] = ["transaction"];        
            $this->loadView("parts/plain",$data,$menuData); 
            $endtime = microtime(true); 
            echo("<span  class='loadTimeRoad'; > #0004 - <lable>".round(($endtime - $starttime),4)." Sec </label>".round((microtime(true) - $timeStart),4)." Sec </span>");                  
                
        }
        else{            
            header("HTTP/1.1 404 Not Found");
            exit();
        }
      
    }  
  
        
}
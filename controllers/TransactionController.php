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
       
        
        $timeStart = microtime(true);   
        $data['loadTimeStart'] =  microtime(true); 
        $data['pageID'] =  "0002"; 
        $menuData['breadhome'] = 'General';
        $menuData['breadpage'] = 'Transactions';
        if( $_SERVER["REQUEST_METHOD"] == 'POST' && $_POST['dAccess'] =="dashboard" )
        {
        $vars = [
            "pageName" => "TransactionList" ,
            "pageTitle" =>"Transactions" ,      
            
            "dataTable" =>[
                "Id" =>"TransactionTable",
                "fields" => [
                                ["th"=>"Sl No.","width"=>"50"],
                                ["th"=>"Transaction ID","width"=>"130"],
                                ["th"=>"Razorpay Payment ID","width"=>"130"], 
                                ["th"=>"Total Amount","width"=>"130"],                                       
                                ["th"=>"Actions","width"=>"80"],
                                ["th"=>""],
                            ]
                ]
            ];
        

            // $vars['filterHtml'] = '<div class="form-group row" id="FilterChild"><div class="col-7 StatusMain"><select class="form-select" name="StatusFilter" id="StatusFilter" style=""><option value="1">Authorized</option><option value="0">Failed</option></select></div></div>';  
            $vars['filterHtml'] = '<div class="form-group row" id="FilterChild"><div class="col-7 StatusMain"><select class="form-select" name="StatusFilter" id="StatusFilter" style="width:150px;"><option value="1">Authorized</option><option value="0">Failed</option></select></div></div>';  
            // $vars['filterHtml'] = '<div class="form-group row" id="FilterChild"><div class="col-7 StatusMain"><select class="form-select" name="StatusFilter" id="StatusFilter" style="width:150px;"><option value="1">Authorized</option><option value="0">Failed</option></select></div><div class="col-5 FilterMain"><select name="TPFilterIDSrch" class="form-select" id="TPFilterIDSrch" autocomplete="off" style=""><option value="">-Search Filter-</option><option value="TransactionID">Transaction ID</option><option value="RazorpayPaymentId">Razorpay Payment ID</option></select></div></div>';  

        $this->loadView("parts/dataTable",[],$vars);   

        $this->loadView("popups/transaction_Form");   
        $starttime = microtime(true);      
        $data["scripts"] = ["transaction","helper/table","helper/form"];        
        $this->loadView("parts/plain",$data,$menuData);
        $endtime = microtime(true); 
        echo("<span  class='loadTimeRoad'; > #0002 - <lable>".round(($endtime - $starttime),4)." Sec </label> ".round((microtime(true) - $timeStart),4)." Sec </span>");              

                
        }
       else{            
            header("HTTP/1.1 404 Not Found");
            exit();
        }       
    }

    // public function transactionListAction(){
         // }
        public function loadTableAction()
        {
            
            $TransactionID = $_POST['TransactionID'];
            $draw = $_POST['draw'];
            $row = $_POST['start'];
            $rowperpage = $_POST['length']; 
            $columnIndex = $_POST['order'][0]['column']; 
            // $columnName = $_POST['columns'][$columnIndex]['data']; 
            $columnName = "TransactionID"; 
            $columnSortOrder = $_POST['order'][0]['dir'];         
            $searchValue = $_POST['search']['value']; // Search value
            $searchColumns =["TransactionID"]; 
            // $searchColumns =[$_POST['searchColumn']]; 
            if(isset($_POST['filter']['Status']) && $_POST['filter']['Status']!="" && $_POST['filter']['Status']!="-1"){
                $Status = $_POST['filter']['Status'];
            }else{
                $Status = '1';
            }  
            $page=$this->TransactionModel->paginate($TransactionID,$searchValue,$searchColumns,$columnName,$columnSortOrder,$draw,$row,$rowperpage,$Status);
            echo(json_encode($page));
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
<?php
require_once  MODEL_PATH."SysUserModel.php";
require_once  MODEL_PATH."HelperModel.php";
// include_once  BASE_URL."razorpay_php/src/Api.php";
use Api;
// print_r(BASE_URL."razorpay_php/src/Api.php");
// include 'razorpay-php/src/Api.php';
class PaymentController  extends  UserBaseController
{  
    public function __construct(){
        $this->crudModel = new CrudModel();
        $this->SysUserModel = new SysUserModel();
        $this->helperModel = new HelperModel();        
        // $this->api = new Api('rzp_test_f0Naiu31auHzo1', 'iZZNgJMoHldx0E5VNsdsy8oP');
        // $this->table = "payment";
       $this->table = $this->crudModel->getPageTableName("payments");

        
    }
    public function addpaymentAction(){
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if($requestMethod != 'POST'){     
            $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));
        }
        else
        {        
            $errors = [];
            $fields = ["RazorpayPaymentId","TotalAmount","ProductId","CompanyOfficeID","TransactionID"]; 
            $optionalFields = [];
            $values = [];                    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                foreach ($fields as $field) {
                    if (empty($_POST[$field]) && !in_array($field, $optionalFields)) {
                        $errors[] = $field;
                    } else {
                            $values[$field] = $this->helperModel->InputStringFormat($_POST[$field]);                           
                    }
                }
                // $values['TransactionID'] = $this->crudModel->getRandom(10);
                $values["Status"]=1; 
                if($_POST['PaymentStatus']=='Failed'){
                    $values["Status"]='0'; 
                }
                if($_POST['PaymentStatus']=='Created'){
                    // echo "Created"; die();
                    $values["Status"]='3'; 
                }
                            
                if(!empty($errors)){
                    $this->sendOutput(
                        json_encode(array("Status"=>0,"Message"=>"Please enter all fields","fields"=>$errors)),
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                }
                else{                    
                        $responseData = $this->crudModel->add($this->table,$values);
                        if($responseData){
                            echo "1";
                        }                       
                        // $this->sendOutput(
                        //     $responseData,
                        //     array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                        // );
                }
            }
        }        
    }
    public function makePayAction(){
     
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
            $this->loadView("pages/payment",[],$vars);  
            $starttime = microtime(true);      
            $data["scripts"] = ["payment"];        
            $this->loadView("parts/plain",$data,$menuData); 
            $endtime = microtime(true); 
            echo("<span  class='loadTimeRoad'; > #0004 - <lable>".round(($endtime - $starttime),4)." Sec </label>".round((microtime(true) - $timeStart),4)." Sec </span>");                  
                
        }
        else{            
            header("HTTP/1.1 404 Not Found");
            exit();
        }
    }  
    public function getProductListsAction(){
    	if(isset($_POST['yes'])){ 
	    	$responseData = $this->helperModel->getProductLists( );
	    	$this->sendOutput(
	            $responseData,
	            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
	        );  
    	}
    }

    // public function checkoutdetailsAction(){
        //  echo "Here : checkoutdetails";
        //  var_dump($_POST); 
        //  print_r(BASE_URL."razorpay-php/src/Api.php"); die();
        // include 'razorpay-php/src/Api.php';
        //use Razorpay\Api\Api;
        // $api = new Api('Secret ID', 'Secret Key');
        // $api = new Api('rzp_test_f0Naiu31auHzo1', 'iZZNgJMoHldx0E5VNsdsy8oP');
        // print_r($this->api); 
        //         $payment = $api->payment->fetch($_REQUEST['billno']);
        //         echo $payment->amount;
        //         print_r($payment->notes);
    // }
    public function checkoutdetailsAction(){ 
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if($requestMethod != 'POST'){                    
            $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));
        }
        else
        {                    
        $errors = [];                   
        $fields = ['TransactionID']; 
        $optionalFields = [];
        $values = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            foreach ($fields as $field) {
                if (empty($_POST[$field]) && !in_array($field, $optionalFields)) {
                    $errors[] = $field;
                } else {
                    $values[$field] = $this->helperModel->InputStringFormat(trim($_POST[$field]));
                }
            }            
                
            if(!empty($errors)){
                //echo json_encode($errors);
                $this->sendOutput(
                    json_encode(array("Status"=>0,"Message"=>"Please enter all fields","fields"=>$errors)),
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            }
            else{
                $conditions= "WHERE TransactionID = '".$values['TransactionID']."'"; 
                $responseData = $this->crudModel->details($this->table,$conditions);

                $this->sendOutput($responseData,array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
                }
        }
        }        


     }

        
}
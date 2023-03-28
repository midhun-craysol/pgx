
<?php
require_once  MODEL_PATH . "api/ApiModel.php";
class VahanController extends BaseController
{  
   
    public function __construct(){
        $this->ApiModel = new ApiModel(); 
        $this->crudModel = new CrudModel();
        $this->paramTable = $this->crudModel->getPageTableName("param");
        $this->stateTable = $this->crudModel->getPageTableName("state");
        $this->rtoTable = $this->crudModel->getPageTableName("ais140_rto");
    } 
    public function loadStatesAction(){
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if($requestMethod != 'POST'){ 
            $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));
        }
        else
        {                    
           $ApiKey = $this->ApiModel->getApiKey();
            if($_POST['ApiKey'] == $ApiKey){   
               //create
                $condition = " WHERE `".$this->stateTable."`.`Status` = '1'";
                if((isset($_POST['SearchVal']) && !empty($_POST['SearchVal'])) && (empty($_POST['UpdateID']))){
                   $condition .= "  AND (`".$this->stateTable."`.`StateName` like '%".$_POST['SearchVal']."%' )";
                   $result = $this->ApiModel->StateList($condition); 
                   $this->sendOutput($result,array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
                //update
                else if((isset($_POST['UpdateID']) && !empty($_POST['UpdateID'])) && (empty($_POST['SearchVal']))){
                    $condition .= "  AND (`".$this->stateTable."`.`StateID` = '".$_POST['UpdateID']."' )";
                    $result = $this->ApiModel->StateList($condition);
                    $this->sendOutput($result,array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
                else{
                    $this->sendOutput(
                        json_encode(array("Status"=>0,"Message"=>"Invalid Parameters")),
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                }
                
            }
            else{
                $this->sendOutput(
                    json_encode(array("Status"=>0,"Message"=>"Invalid API Key")),
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            }
           
        }
        
    }
    public function loadRTOListAction(){
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if($requestMethod != 'POST'){ 
            $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));
        }
        else
        {                    
           $ApiKey = $this->ApiModel->getApiKey();
            if($_POST['ApiKey'] == $ApiKey){   
               //create
                $condition = " WHERE `".$this->rtoTable."`.`Status` = '1'";
                if((isset($_POST['SearchVal']) && !empty($_POST['SearchVal'])) && (empty($_POST['UpdateID']))){
                   $condition .= "  AND (`".$this->rtoTable."`.`RtoName` like '%".$_POST['SearchVal']."%' OR`".$this->rtoTable."`.`RtoRegCode` like '%".$_POST['SearchVal']."%' )";
                   $result = $this->ApiModel->RTOList($condition);             
                   $this->sendOutput($result,array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
                //update
                else if((isset($_POST['UpdateID']) && !empty($_POST['UpdateID'])) && (empty($_POST['SearchVal']))){
                    $condition .= "  AND (`".$this->rtoTable."`.`RtoID` = '".$_POST['UpdateID']."' )";
                    $result = $this->ApiModel->RTOList($condition);
                    $this->sendOutput($result,array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
                }
                else{
                    $this->sendOutput(
                        json_encode(array("Status"=>0,"Message"=>"Invalid Parameters")),
                        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                }
                
            }
            else{
                $this->sendOutput(
                    json_encode(array("Status"=>0,"Message"=>"Invalid API Key")),
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            }
           
        }
        
    }
        

}

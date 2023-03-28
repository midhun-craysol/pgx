<?php 
require_once  MODEL_BASE_PATH."Database.php";
require_once  MODEL_BASE_PATH."CrudModel.php"; 
class  ApiModel extends Database
{
    function __construct(){
        $this->crudModel = new CrudModel();
        $this->db = new Database();
        $this->stateTable = $this->crudModel->getPageTableName("state");
        $this->rtoTable = $this->crudModel->getPageTableName("ais140_rto");
        $this->paramTable = $this->crudModel->getPageTableName("param");
    }

    public function getApiKey(){
        $sqlQuery = "SELECT `".$this->paramTable."`.`ApiKey` FROM `".$this->paramTable."` ";
        $result = $this->db->executeQuery($sqlQuery);
        return($result[0]['ApiKey']);
    }
    public function StateList($condition){
        $sqlQuery = "SELECT `".$this->stateTable."`.`StateID`,`".$this->stateTable."`.`StateAbbr`,`".$this->stateTable."`.`StateName` FROM `".$this->stateTable."` ".$condition;
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
            return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
            }
        else {
            return(json_encode(array( "Status"=>0,"Message"=>"List fetching failed")));
            }
    }
    public function RTOList($condition){
        $sqlQuery = "SELECT `" . $this->rtoTable . "`.`RtoID`,`" . $this->rtoTable . "`.`RtoName`,`" . $this->rtoTable . "`.`RtoRegCode`,`" . $this->stateTable . "`.`StateName` FROM `" . $this->rtoTable . "` ";
        $sqlQuery .= " INNER JOIN `".$this->stateTable."` ON `".$this->rtoTable."`.`StateID` = `".$this->stateTable."`.`StateID` ".$condition;;
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
            return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
            }
        else {
            return(json_encode(array( "Status"=>0,"Message"=>"List fetching failed")));
            }
    }
    
   
}
?>
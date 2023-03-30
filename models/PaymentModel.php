<?php 
require_once  MODEL_BASE_PATH."Database.php";
require_once  MODEL_BASE_PATH."CrudModel.php"; 
class  SysUserModel extends Database
{
    function __construct(){
        $this->CrudModel = new CrudModel();
        $this->db = new Database();
        $this->table = $this->CrudModel->getPageTableName("SysUsers");
       
    }
    public function userTypeIdByCompany($table,$ID,$Name)
    {     
        $sqlQuery = "SELECT  FROM ".$tablename." WHERE Status = '1' AND UserOrgType='Company'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("qry"=>$result, "Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("qry"=>$result, "Status"=>0,"Message"=>"List fetching failed")));
        }
    }
}
<?php
require_once  MODEL_BASE_PATH."Database.php"; 
require_once  MODEL_BASE_PATH."CrudModel.php"; 
require_once  MODEL_BASE_PATH."ACCDatabase.php";
require_once  MODEL_BASE_PATH."ERPDatabase.php";
require_once  MODEL_API_PATH . "ERPAccountsDBCrudModel.php";
class HelperModel extends Database
{
    function __construct(){ 
        $this->db = new Database();
        $this->crudModel = new CrudModel();  
        $this->ERPAccountsDBCrudModel = new ERPAccountsDBCrudModel();
        $this->SysUsersTable = $this->crudModel->getPageTableName("SysUsers");   
    }

    public function nameByID($table,$ID,$Name)
    {   

        $tablename=$this->crudModel->getPageTableName($table); 
        $sqlQuery = "SELECT ".$ID.",".$Name." FROM ".$tablename." WHERE Status = '1' order by ".$Name." ASC"; 
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }
    } 
    public function nameSelectByVal($table,$ID,$Name,$fieldname,$fieldval)
    {   

      $tablename=$this->crudModel->getPageTableName($table); 
      $sqlQuery = "SELECT ".$ID.",".$Name." FROM ".$tablename." WHERE Status = '1' AND ".$fieldname."='".$fieldval."'"; 
      $result = $this->db->executeQuery($sqlQuery);
      if(!empty($result)){            
            return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
      }
      else {
            return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
      }
  } 
    public function nameByIDWithSearch($table,$ID,$Name,$Searchvalue,$Searchitem)
    {

        $tablename=$this->crudModel->getPageTableName($table);
        $sqlQuery = "SELECT ".$ID.",".$Name." FROM ".$tablename." WHERE Status = '1' AND `".$Searchitem."`='".$Searchvalue."'"; 
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }
    }  
//new modification here...... 
      public function InputStringFormat($InputText){
            return $this->db->htmlRealEscapeString($InputText);
      }  
      public function getUserOffices($companyoffice_m,$ID,$Name,$SearchCondition){
            $this->BaseDB = new ERPDatabase(); 
            $selQ = "SELECT ".$companyoffice_m.".`".$ID."`,".$companyoffice_m.".`".$Name."` FROM ".$companyoffice_m;
            $selQ .=" WHERE ".$companyoffice_m.".`Status` ='1' ".$SearchCondition;
            // die($selQ);
            $result = $this->BaseDB->executeQuery($selQ); 
            if(!empty($result)){            
                  return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
            }
            else {
                  return(json_encode(array("Status"=>0,"Message"=>"List fetching Failed")));
            }
      }
      public function setOfficeName($companyoffice_m,$ID,$Name,$SearchCondition){
            $this->BaseDB = new ERPDatabase(); 
            $selQ = "SELECT ".$companyoffice_m.".`".$ID."`,".$companyoffice_m.".`".$Name."` FROM ".$companyoffice_m;
            $selQ .=" WHERE ".$companyoffice_m.".`Status` ='1' ".$SearchCondition;
            // die($selQ);
            $result = $this->BaseDB->executeQuery($selQ); 
            if(!empty($result)){            
                  return($result);
            } 
      }
      public function loadPaygateByOffice($smsgatewayofficelink,$paygate_m,$officeID){
            $this->AccDB = new ACCDatabase();  
            $query = 'SELECT `' .$paygate_m. '`.* FROM `' .$paygate_m. '`';
            $query .=" INNER JOIN  `".$smsgatewayofficelink."` ON `".$paygate_m."`.PayGateID =`".$smsgatewayofficelink."`.PayGateID";
            $query .=" WHERE `".$paygate_m."`.`Status` ='1' AND `".$smsgatewayofficelink."`.CompanyOfficeID  ='".$officeID."' "; 
            $result = $this->AccDB->executeQuery($query); 
            if(!empty($result)){            
                  return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
            }
            else {
                  return(json_encode(array("Status"=>0,"Message"=>"List fetching Failed")));
            }
      }
      public function setPayGateName($paygate_m,$ID,$Name,$SearchCondition){
            $this->AccDB = new ACCDatabase();
            $selQ = "SELECT ".$paygate_m.".`".$ID."`,".$paygate_m.".`".$Name."` FROM ".$paygate_m;
            $selQ .=" WHERE ".$paygate_m.".`Status` ='1' ".$SearchCondition; 
            $result = $this->AccDB->executeQuery($selQ); 
            if(!empty($result)){            
                  return($result);
            } 
      }

}


?>
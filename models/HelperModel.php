<?php
require_once  MODEL_BASE_PATH."Database.php"; 
require_once  MODEL_BASE_PATH."CrudModel.php"; 
require_once  MODEL_BASE_PATH."ACCDatabase.php";
// require_once  MODEL_BASE_PATH."ERPDatabase.php";
require_once  MODEL_API_PATH . "ERPAccountsDBCrudModel.php";
class HelperModel extends Database
{
    function __construct(){ 
      $this->db = new Database();
      $this->crudModel = new CrudModel();  
      $this->ERPAccountsDBCrudModel = new ERPAccountsDBCrudModel();  
      $this->paymentgatewayoffice_link = $this->ERPAccountsDBCrudModel->getPageTableName("paymentgatewayoffice_link"); 
      $this->paygate_m = $this->ERPAccountsDBCrudModel->getPageTableName("paygate_m");  
    }

    public function loadPaygateByOffice( ){      
      $this->AccDB = new ACCDatabase();  
      session_start();
      $query = 'SELECT `' .$this->paygate_m. '`.* FROM `' .$this->paygate_m. '`';
      $query .=" INNER JOIN  `".$this->paymentgatewayoffice_link."` ON `".$this->paygate_m."`.PayGateID =`".$this->paymentgatewayoffice_link."`.PayGateID";
      $query .=" WHERE `".$this->paygate_m."`.`Status` ='1' AND `".$this->paymentgatewayoffice_link."`.CompanyOfficeID  ='".$_SESSION['pgx']['CompanyOfficeID']."' "; 
      // print_r($query); die();
      $result = $this->AccDB->executeQuery($query); 
      if(!empty($result)){            
            return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
      }
      else {
            return(json_encode(array("Status"=>0,"qr"=>$_SESSION, "Message"=>"List fetching Failed")));
      }      
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
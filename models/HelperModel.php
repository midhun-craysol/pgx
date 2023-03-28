<?php
require_once  MODEL_BASE_PATH."Database.php"; 
require_once  MODEL_BASE_PATH."CrudModel.php"; 
 
class HelperModel extends Database
{
    function __construct(){ 
        $this->db = new Database();
        $this->crudModel = new CrudModel();  
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
    
    
public function nameByDealerID($table,$ID,$Name)
    {   

        $tablename=$this->crudModel->getPageTableName($table); 
        $sqlQuery = "SELECT ".$ID.",".$Name.",`CompanyDlrFlg` FROM ".$tablename." WHERE Status = '1'"; 
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }
    }

   
    public function twoFldNameByID($table,$ID,$Name1,$Name2)
    {   

        $tablename=$this->crudModel->getPageTableName($table); 
        $sqlQuery = "SELECT ".$ID.",".$Name1.",".$Name2." FROM ".$tablename." WHERE Status = '1'"; 
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
    public function nameByIDbyRefID($table,$ID,$Name,$RefPKtable,$refPKID,$refPKVal)
    {   

        $tablename=$this->crudModel->getPageTableName($table);
        $reftablename=$this->crudModel->getPageTableName($RefPKtable);
        $sqlQuery = "SELECT `".$tablename."`.`".$ID."`,`".$tablename."`.`".$Name."` FROM `".$tablename."`";
        $sqlQuery .= " WHERE `".$tablename."`.`Status` = '1' AND `".$reftablename."`.`".$refPKID."`='".$refPKVal."' "; 
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
    public function nameByIDWithNonSessionD($table,$ID,$Name,$Searchvalue,$Searchitem,$sessionID)
    {

        $tablename=$this->crudModel->getPageTableName($table);
        $sqlQuery = "SELECT ".$ID.",".$Name." FROM ".$tablename." WHERE Status = '1' AND `".$Searchitem."`='".$Searchvalue."' AND ".$ID."!='".$sessionID."'"; 
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }
    }
    
    public function nameBySearchCondition($t1id,$tab1name,$t2id,$tab2name,$name,$Searchitem,$Searchvalue)
    {
      $tablename1=$this->crudModel->getPageTableName($tab1name);
      $tablename2=$this->crudModel->getPageTableName($tab2name);
      $sqlQuery = "SELECT `".$tablename1."`.`".$name."`,`".$tablename1."`.* FROM ".$tablename1."";
      $sqlQuery .=" INNER JOIN ".$tablename2." ON `".$tablename1."`.`".$t2id."` = `".$tablename2."`.`".$t2id."` WHERE `".$tablename1."`.`Status`='1' AND `".$tablename2."`.`".$Searchitem."`='".$Searchvalue."'";
       $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed","Qry"=>$sqlQuery)));
        }
    }

    public function nameBySearchConditionIDAndName($t1id,$tab1name,$t2id,$tab2name,$name,$Searchitem,$Searchvalue)
    {
      $tablename1=$this->crudModel->getPageTableName($tab1name);
      $tablename2=$this->crudModel->getPageTableName($tab2name);
      $sqlQuery = "SELECT `".$tablename2."`.`".$name."`,`".$tablename1."`.* FROM ".$tablename1."";
      $sqlQuery .=" INNER JOIN ".$tablename2." ON `".$tablename1."`.`".$t2id."` = `".$tablename2."`.`".$t2id."` WHERE `".$tablename1."`.`Status`='1' AND `".$tablename1."`.`".$Searchitem."`='".$Searchvalue."'";
       $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed","Qry"=>$sqlQuery)));
        }
    }
//new modification here......
    public function nameBySearchConditionAndName($t1id,$tab1name,$t2id,$tab2name,$name)
    {
      $tablename1=$this->crudModel->getPageTableName($tab1name);
      $tablename2=$this->crudModel->getPageTableName($tab2name);
      $sqlQuery = "SELECT `".$tablename2."`.`".$name."`,`".$tablename1."`.* FROM ".$tablename1."";
      $sqlQuery .=" INNER JOIN ".$tablename2." ON `".$tablename1."`.`".$t2id."` = `".$tablename2."`.`".$t2id."` WHERE `".$tablename1."`.`Status`='1'";
       $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed","Qry"=>$sqlQuery)));
        }
    }
    
    public function InputStringFormat($InputText){
      return $this->db->htmlRealEscapeString($InputText);
    }
    
    public function nameByIDLink($id,$fid,$fname,$sid,$sname,$tab1name,$tab2name,$maintable)
    {   

        $tablename1=$this->crudModel->getPageTableName($tab1name);
        $tablename2=$this->crudModel->getPageTableName($tab2name);
        $tablename3=$this->crudModel->getPageTableName($maintable);
        $sqlQuery = "SELECT `".$tablename3."`.`".$id."`,`".$tablename3."`.`".$fid."`,`".$tablename3."`.`".$sid."`,`".$tablename1."`.`".$fname."`,`".$tablename2."`.`".$sname."` FROM ".$tablename3."";
        $sqlQuery .=" INNER JOIN ".$tablename1." ON `".$tablename3."`.`".$fid."` = `".$tablename1."`.`".$fid."`";
        $sqlQuery .=" INNER JOIN ".$tablename2." ON `".$tablename3."`.`".$sid."` = `".$tablename2."`.`".$sid."` WHERE ".$tablename3.".Status = '1' AND ".$tablename3.".Status = '1' AND  ".$tablename2.".Status = '1'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed","query"=>$sqlQuery)));
        }
    } 
    public function name2FromDiffTablesByID($id,$fid,$fname,$sid,$sname,$tab1name,$tab2name,$otherfld1,$maintable)
    {   

        $tablename1=$this->crudModel->getPageTableName($tab1name);
        $tablename2=$this->crudModel->getPageTableName($tab2name);
        $tablename3=$this->crudModel->getPageTableName($maintable);
        $sqlQuery = "SELECT `".$tablename3."`.`".$id."`,`".$tablename3."`.`".$otherfld1."`,`".$tablename3."`.`".$fid."`,`".$tablename3."`.`".$sid."`,`".$tablename1."`.`".$fname."`,`".$tablename2."`.`".$sname."` FROM ".$tablename3."";
        $sqlQuery .=" INNER JOIN ".$tablename1." ON `".$tablename3."`.`".$fid."` = `".$tablename1."`.`".$fid."`";
        $sqlQuery .=" INNER JOIN ".$tablename2." ON `".$tablename3."`.`".$sid."` = `".$tablename2."`.`".$sid."` WHERE ".$tablename3.".Status = '1' AND ".$tablename3.".Status = '1' AND  ".$tablename2.".Status = '1'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed","query"=>$sqlQuery)));
        }
    }


    public function nameByRefIDLink($id,$fid,$fname,$sid,$sname,$tab1name,$tab2name,$maintable,$RefPKtable,$refPKID,$refPKVal)
    {   

        $tablename1=$this->crudModel->getPageTableName($tab1name);
        $tablename2=$this->crudModel->getPageTableName($tab2name);
        $tablename3=$this->crudModel->getPageTableName($maintable);
        $reftablename=$this->crudModel->getPageTableName($RefPKtable);
        $sqlQuery = "SELECT `".$tablename3."`.`".$id."`,`".$tablename3."`.`".$fid."`,`".$tablename3."`.`".$sid."`,`".$tablename1."`.`".$fname."`,`".$tablename2."`.`".$sname."` FROM `".$tablename3."`";
        $sqlQuery .=" INNER JOIN `".$tablename1."` ON `".$tablename3."`.`".$fid."` = `".$tablename1."`.`".$fid."`";
        $sqlQuery .=" INNER JOIN `".$tablename2."` ON `".$tablename3."`.`".$sid."` = `".$tablename2."`.`".$sid."` WHERE `".$tablename3."`.`Status` = '1' AND `".$tablename3."`.`Status` = '1' AND  `".$tablename2."`.`Status` = '1' AND `".$reftablename."`.`".$refPKID."`='".$refPKVal."'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed","query"=>$sqlQuery)));
        }
    }
    public function twonameByRefIDLink($id,$fid,$fname,$sid,$sname,$tab1name,$tab2name,$maintable,$RefPKtable,$refPKID,$refPKVal)
    {   
      $tablename1=$this->crudModel->getPageTableName($tab1name);
      $tablename2=$this->crudModel->getPageTableName($tab2name);
      $tablename3=$this->crudModel->getPageTableName($maintable);
      $reftablename=$this->crudModel->getPageTableName($RefPKtable);

      $sqlQuery = "SELECT `".$tablename3."`.`".$id."`,`".$tablename3."`.`".$fid."`,`".$tablename3."`.`".$sid."`,`".$tablename1."`.`".$fname."`,`".$tablename2."`.`".$sname."` FROM ".$tablename3."";
      $sqlQuery .=" INNER JOIN ".$tablename1." ON `".$tablename3."`.`".$fid."` = `".$tablename1."`.`".$fid."`";
      $sqlQuery .=" INNER JOIN ".$tablename2." ON `".$tablename3."`.`".$sid."` = `".$tablename2."`.`".$sid."`";
      $sqlQuery .=" INNER JOIN ".$reftablename." ON `".$reftablename."`.`".$refPKID."` = `".$tablename1."`.`".$refPKID."`";
      $sqlQuery .=" WHERE ".$tablename3.".Status = '1' AND ".$tablename3.".Status = '1' AND  ".$tablename2.".Status = '1' AND `".$reftablename."`.`Status`='1'";
      
      $result = $this->db->executeQuery($sqlQuery);
      if(!empty($result)){            
            return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
      }
      else {
            return(json_encode(array("Status"=>0,"Message"=>"List fetching failed","query"=>$sqlQuery)));
      }
 
    }

    

    public function nameByIDLinkWithSearch($id,$fid,$fname,$sid,$sname,$tab1name,$tab2name,$maintable,$Searchitem,$Seachvalue)
    {   

        $tablename1=$this->crudModel->getPageTableName($tab1name);
        $tablename2=$this->crudModel->getPageTableName($tab2name);
        $tablename3=$this->crudModel->getPageTableName($maintable);
        $sqlQuery = "SELECT `".$tablename3."`.`".$id."`,`".$tablename3."`.`".$fid."`,`".$tablename3."`.`".$sid."`,`".$tablename1."`.`".$fname."`,`".$tablename2."`.`".$sname."` FROM ".$tablename3."";
        $sqlQuery .=" INNER JOIN ".$tablename1." ON `".$tablename3."`.`".$fid."` = `".$tablename1."`.`".$fid."`";
        $sqlQuery .=" INNER JOIN ".$tablename2." ON `".$tablename3."`.`".$sid."` = `".$tablename2."`.`".$sid."` WHERE ".$tablename3.".Status = '1' AND ".$tablename3.".Status = '1' AND  ".$tablename2.".Status = '1' AND `".$tablename1."`.`".$Searchitem."`='".$Seachvalue."'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed","query"=>$sqlQuery)));
        }
    } 
    public function getOneAndTwoNames($id,$fid,$fname,$ftablename,$sid,$stablename,$sid1,$sname1,$stablename1,$sid2,$sname2,$stablename2,$tablename){
        $tablename=$this->crudModel->getPageTableName($tablename);

        $ftablename=$this->crudModel->getPageTableName($ftablename);
        $stablename=$this->crudModel->getPageTableName($stablename);

        $stablename1=$this->crudModel->getPageTableName($stablename1);
        $stablename2=$this->crudModel->getPageTableName($stablename2);

        $sqlQuery = "SELECT `".$ftablename."`.`".$fname."`,`".$stablename1."`.`".$sname1."`,`".$stablename2."`.`".$sname2."`, `".$tablename."`.`".$id."`  FROM `".$tablename."`";

        $sqlQuery .=" INNER JOIN `".$ftablename."` ON `".$tablename."`.`".$fid."` = `".$ftablename."`.`".$fid."`";
        $sqlQuery .=" INNER JOIN `".$stablename."` ON `".$tablename."`.`".$sid."` = `".$stablename."`.`".$sid."`";
       
        $sqlQuery .=" INNER JOIN `".$stablename1."` ON `".$stablename."`.`".$sid1."` = `".$stablename1."`.`".$sid1."`";
        
        $sqlQuery .=" INNER JOIN `".$stablename2."` ON `".$stablename."`.`".$sid2."` = `".$stablename2."`.`".$sid2."`";
        $sqlQuery .=" WHERE `".$ftablename."`.`Status` = '1' AND `".$stablename."`.`Status` = '1' AND  `".$stablename1."`.`Status` = '1' AND  `".$stablename2."`.`Status` = '1' AND  `".$tablename."`.`Status` = '1'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }

    }
    public function getTwoByFourNames($id,$fid,$tabname1,$sid,$tabname2,$fid1,$fname1,$ftabname1,$sid1,$sname1,$stabname1,$fid2,$fname2,$ftabname2,$sid2,$sname2,$stabname2,$tablename){
        $tablename=$this->crudModel->getPageTableName($tablename);
        $tabname1=$this->crudModel->getPageTableName($tabname1);
        $tabname2=$this->crudModel->getPageTableName($tabname2);
        $ftabname1=$this->crudModel->getPageTableName($ftabname1);
        $ftabname2=$this->crudModel->getPageTableName($ftabname2);
        $stabname1=$this->crudModel->getPageTableName($stabname1);
        $stabname2=$this->crudModel->getPageTableName($stabname2);

        $sqlQuery = "SELECT `".$ftabname1."`.`".$fid1."`, `".$ftabname1."`.`".$fname1."`, `".$stabname1."`.`".$sid1."`, `".$stabname1."`.`".$sname1."`, `".$ftabname2."`.`".$fid2."`, `".$ftabname2."`.`".$fname2."`, `".$stabname2."`.`".$sid2."`, `".$stabname2."`.`".$sname2."`, `".$tablename."`.`".$id."`  FROM `".$tablename."`";
        $sqlQuery .=" INNER JOIN `".$tabname1."` ON `".$tablename."`.`".$fid."` = `".$tabname1."`.`".$fid."`";
        $sqlQuery .=" INNER JOIN `".$tabname2."` ON `".$tablename."`.`".$sid."` = `".$tabname2."`.`".$sid."`";
        $sqlQuery .=" INNER JOIN `".$ftabname1."` ON `".$tabname1."`.`".$fid1."` = `".$ftabname1."`.`".$fid1."`";
        $sqlQuery .=" INNER JOIN `".$stabname1."` ON `".$tabname1."`.`".$sid1."` = `".$stabname1."`.`".$sid1."`";
        $sqlQuery .=" INNER JOIN `".$ftabname2."` ON `".$tabname2."`.`".$fid2."` = `".$ftabname2."`.`".$fid2."`";
        $sqlQuery .=" INNER JOIN `".$stabname2."` ON `".$tabname2."`.`".$sid2."` = `".$stabname2."`.`".$sid2."`";
        $sqlQuery .=" WHERE `".$tabname1."`.`Status` = '1' AND `".$tabname2."`.`Status` = '1' AND  `".$stabname1."`.`Status` = '1' AND  `".$stabname2."`.`Status` = '1' AND  `".$tablename."`.`Status` = '1'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }

    }

    public function getTwoByFourNamesbyRefID($id,$fid,$tabname1,$sid,$tabname2,$fid1,$fname1,$ftabname1,$sid1,$sname1,$stabname1,$fid2,$fname2,$ftabname2,$sid2,$sname2,$stabname2,$tablename,$RefPKtable,$refPKID,$refPKVal){
      $tablename=$this->crudModel->getPageTableName($tablename);
      $tabname1=$this->crudModel->getPageTableName($tabname1);
      $tabname2=$this->crudModel->getPageTableName($tabname2);
      $ftabname1=$this->crudModel->getPageTableName($ftabname1);
      $ftabname2=$this->crudModel->getPageTableName($ftabname2);
      $stabname1=$this->crudModel->getPageTableName($stabname1);
      $stabname2=$this->crudModel->getPageTableName($stabname2);
      $reftablename=$this->crudModel->getPageTableName($RefPKtable);


      $sqlQuery = "SELECT `".$ftabname1."`.`".$fid1."`, `".$ftabname1."`.`".$fname1."`, `".$stabname1."`.`".$sid1."`, `".$stabname1."`.`".$sname1."`, `".$ftabname2."`.`".$fid2."`, `".$ftabname2."`.`".$fname2."`, `".$stabname2."`.`".$sid2."`, `".$stabname2."`.`".$sname2."`, `".$tablename."`.`".$id."`  FROM `".$tablename."`";
      $sqlQuery .=" INNER JOIN `".$tabname1."` ON `".$tablename."`.`".$fid."` = `".$tabname1."`.`".$fid."`";
      $sqlQuery .=" INNER JOIN `".$tabname2."` ON `".$tablename."`.`".$sid."` = `".$tabname2."`.`".$sid."`";
      $sqlQuery .=" INNER JOIN `".$ftabname1."` ON `".$tabname1."`.`".$fid1."` = `".$ftabname1."`.`".$fid1."`";
      $sqlQuery .=" INNER JOIN `".$stabname1."` ON `".$tabname1."`.`".$sid1."` = `".$stabname1."`.`".$sid1."`";
      $sqlQuery .=" INNER JOIN `".$ftabname2."` ON `".$tabname2."`.`".$fid2."` = `".$ftabname2."`.`".$fid2."`";
      $sqlQuery .=" INNER JOIN `".$stabname2."` ON `".$tabname2."`.`".$sid2."` = `".$stabname2."`.`".$sid2."`";
      $sqlQuery .=" WHERE `".$tabname1."`.`Status` = '1' AND `".$tabname2."`.`Status` = '1' AND  `".$stabname1."`.`Status` = '1' AND  `".$stabname2."`.`Status` = '1' AND  `".$tablename."`.`Status` = '1'  AND `".$reftablename."`.`".$refPKID."`='".$refPKVal."'";
      
      $result = $this->db->executeQuery($sqlQuery);
      if(!empty($result)){            
            return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
      }
      else {
            return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
      }

  }

    public function nameByThreeIDLink($id,$fid,$fname,$sid,$sname,$tid,$tname,$tab1name,$tab2name,$tab3name,$maintable)
    {   

        $tablename1=$this->crudModel->getPageTableName($tab1name);
        $tablename2=$this->crudModel->getPageTableName($tab2name);
        $tablename3=$this->crudModel->getPageTableName($tab3name);
        $tablename4=$this->crudModel->getPageTableName($maintable);
        $sqlQuery = "SELECT `".$tablename4."`.`".$id."`,`".$tablename4."`.`".$fid."`,`".$tablename4."`.`".$sid."`,`".$tablename4."`.`".$tid."`,`".$tablename1."`.`".$fname."`,`".$tablename2."`.`".$sname."`,`".$tablename3."`.`".$tname."` FROM ".$tablename4."";
        $sqlQuery .=" INNER JOIN ".$tablename1." ON `".$tablename4."`.`".$fid."` = `".$tablename1."`.`".$fid."`";
        $sqlQuery .=" INNER JOIN ".$tablename2." ON `".$tablename4."`.`".$sid."` = `".$tablename2."`.`".$sid."`";
        $sqlQuery .=" INNER JOIN ".$tablename3." ON `".$tablename4."`.`".$tid."` = `".$tablename3."`.`".$tid."` WHERE ".$tablename4.".Status = '1' AND ".$tablename3.".Status = '1' AND  ".$tablename2.".Status = '1' AND  ".$tablename1.".Status = '1'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }
    }


    public function oneNameByID($table,$id,$name,$idval){
        $table=$this->crudModel->getPageTableName($table);
        $sqlQuery = "SELECT `".$table."`.`".$id."`,`".$table."`.`".$name."` FROM ".$table." WHERE `".$table."`.`".$id."`='".$idval."'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }
     } 
 
 
    public function TakeJsonToString($MsgTargetID)
    {
     $arr =  explode(",",$MsgTargetID);
     $str = implode("',",$arr);
     $arrStr ='';
     foreach($arr as $arrSingle)
       { 
             $arrStr .=  $arrSingle.",";
       }
      return(substr_replace($arrStr ,"",-1));
    } 
 


public function getSearch($condition)
{
      $sqlQuery = "SELECT `VehID`,`VehRegNum` FROM ".$this->vehicleTable." ".$condition; 
      $result = $this->db->executeQuery($sqlQuery); 
      if(!empty($result)){            
            return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"Details fetched successfully")));
      }
      else {
            return(json_encode(array("Status"=>0,"Message"=>"Details fetching failed")));
      }
}

}


?>
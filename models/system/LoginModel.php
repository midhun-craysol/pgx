<?php require_once  MODEL_BASE_PATH."CrudModel.php"; 
class  LoginModel extends Database
{
    function __construct(){ 
        $this->crudModel = new CrudModel();
        $this->db = new Database();
        $this->logActivity = $this->crudModel->getPageTableName("loginactivity"); 
        $this->table = $this->crudModel->getPageTableName("sysuser_m");
        $this->compuserTable = $this->crudModel->getPageTableName("companyuser_m");
        $this->compTable = $this->crudModel->getPageTableName("company_m");
        $this->usertypecompuserlink = $this->crudModel->getPageTableName("usertypecompuserlink");
        $this->dbserverTable = $this->crudModel->getPageTableName("dbserver_m");
        $this->usertype_m = $this->crudModel->getPageTableName("usertype_m");
        $this->erpmodule_m = $this->crudModel->getPageTableName("erpmodule_m");
        $this->systemupdatestatusTable = $this->crudModel->getPageTableName("systemupdatestatus");
        $this->companyerpmodule_link = $this->crudModel->getPageTableName("companyerpmodule_link");
        $this->usertypemenu_link = $this->crudModel->getPageTableName("usertypemenu_link");
        $this->menu_m = $this->crudModel->getPageTableName("menu_m");
        $this->ledgergroup_m = $this->crudModel->getPageTableName("ledgergroup_m");
        $this->country_m = $this->crudModel->getPageTableName("country_m");

    }

    public function verifyLogin($values)
    {    
        session_start();    
        //ERP MODULE LINK ?
        $erpAbbr = "SELECT `".$this->erpmodule_m."`.`ERPModuleID` FROM `".$this->erpmodule_m."` WHERE `".$this->erpmodule_m."`.`moduleAbbrevation` = 'ACCT' AND `".$this->erpmodule_m."`.`Status`='1' ";
        $Abbrresult = $this->db->executeQuery($erpAbbr); 
        if(!empty($Abbrresult)){
            $_SESSION['pgx']["AcERPModuleID"]=$Abbrresult[0]['ERPModuleID'];  
            // //ROOT FLAG CHECK
            // $rootFlgQuery = "SELECT `".$this->compuserTable."`.RootUserFlg FROM `".$this->compuserTable."` ";
            // $rootFlgQuery .= " INNER JOIN `".$this->compTable."` ON `".$this->compTable."`.`CompanyID`= `".$this->compuserTable."`.`CompanyID` ";
            // $rootFlgQuery .= "INNER JOIN `".$this->country_m."` ON `".$this->country_m."`.`CountryID`= `".$this->compTable."`.`CountryID`";
            // $rootFlgQuery .= " WHERE `UserLoginID`='".$values['UserName']."' AND `UserPswd` = '".md5($values['UserPassword'])."' AND `".$this->compuserTable."`.`Status`='1' AND `".$this->compTable."`.`Status`='1' AND `".$this->country_m."`.`Status`='1'";  
            // $rootFlgResult = $this->db->executeQuery($rootFlgQuery); 
            // if(!empty($rootFlgResult[0])){
            //     $rootFlag = $rootFlgResult[0]['RootUserFlg']; 
            // }else{
            //     return(json_encode(array("Status"=>0,"Message"=>"Login failed"))); 
            // }  
            // if($rootFlag ==1){
                $_SESSION['pgx']["RootUserFlg"]=1;  

                $sqlQuery = "SELECT `".$this->compuserTable."`.*, `".$this->compTable."`.* ,`".$this->dbserverTable."`.* FROM `".$this->compuserTable."` ";
                $sqlQuery .= " INNER JOIN `".$this->compTable."` ON `".$this->compTable."`.`CompanyID`= `".$this->compuserTable."`.`CompanyID` ";
                $sqlQuery .= " INNER JOIN `".$this->dbserverTable."` ON `".$this->dbserverTable."`.`DBServerID`= `".$this->compTable."`.`DBServerID`"; 
                $sqlQuery .= " WHERE `".$this->compuserTable."`.`UserLoginID`='".$values['UserName']."' AND `".$this->compuserTable."`.`UserPswd` = '".md5($values['UserPassword'])."' AND `".$this->compuserTable."`.`Status`='1' AND `".$this->compTable."`.`Status`='1' "; 
                $result = $this->db->executeQuery($sqlQuery); 

                //checking accounting module link for root user
                $compIDSql = "SELECT `".$this->compuserTable."`.*, `".$this->compTable."`.* FROM `".$this->compuserTable."` ";
                $compIDSql .= " INNER JOIN `".$this->compTable."` ON `".$this->compTable."`.`CompanyID`= `".$this->compuserTable."`.`CompanyID` ";   
                $compIDSql .= " WHERE `".$this->compuserTable."`.`UserLoginID`='".$values['UserName']."' AND `".$this->compuserTable."`.`UserPswd` = '".md5($values['UserPassword'])."' AND `".$this->compuserTable."`.`Status`='1' AND `".$this->compTable."`.`Status`='1'"; 
                $compIDRes = $this->db->executeQuery($compIDSql); 

                $modLinkCheck = "SELECT `".$this->companyerpmodule_link."`.`CompanyERPModuleLinkID` FROM `".$this->companyerpmodule_link."` ";
                $modLinkCheck .= " INNER JOIN `".$this->erpmodule_m."` ON `".$this->erpmodule_m."`.`ERPModuleID`= `".$this->companyerpmodule_link."`.`ERPModuleID` AND `".$this->companyerpmodule_link."`.`CompanyID`='".$compIDRes[0]['CompanyID']."' AND `".$this->erpmodule_m."`.`ERPModuleID` = '".$_SESSION['pgx']["AcERPModuleID"]."' AND `".$this->companyerpmodule_link."`.`Status`='1'"; 
                $compErpModLinkRes = $this->db->executeQuery($modLinkCheck); 
                if(empty($compErpModLinkRes)){
                    unset($_SESSION['pgx']);
                    return(json_encode(array("Status"=>0,"Message"=>"Login failed 1")));
                } 
                // ***********************************************
            // }
            // else{ 
            //     $sqlQuery = "SELECT `".$this->compuserTable."`.*, `".$this->compTable."`.*,`".$this->dbserverTable."`.*, `".$this->usertype_m."`.`UserTypeName`,`".$this->usertype_m."`.`UserTypeID` FROM `".$this->compuserTable."` ";
            //     $sqlQuery .= " INNER JOIN `".$this->compTable."` ON `".$this->compTable."`.`CompanyID`= `".$this->compuserTable."`.`CompanyID` ";
            //     $sqlQuery .= " INNER JOIN `".$this->usertypecompuserlink."` ON `".$this->usertypecompuserlink."`.`CompUserID`= `".$this->compuserTable."`.`CompanyUserID` ";
            //     $sqlQuery .= " INNER JOIN `".$this->usertype_m."` ON `".$this->usertype_m."`.`UserTypeID`= `".$this->usertypecompuserlink."`.`UserTypeID` ";


            //     $sqlQuery .= " INNER JOIN `".$this->erpmodule_m."` ON `".$this->erpmodule_m."`.`ERPModuleID`= `".$this->usertype_m."`.`ERPModuleID` ";

            //     $sqlQuery .= " INNER JOIN `".$this->dbserverTable."` ON `".$this->dbserverTable."`.`DBServerID`= `".$this->compTable."`.`DBServerID`"; 
            //     $sqlQuery .= " WHERE `".$this->compuserTable."`.`UserLoginID`='".$values['UserName']."' AND `".$this->compuserTable."`.`UserPswd` = '".md5($values['UserPassword'])."' AND `".$this->compuserTable."`.`Status`='1' AND `".$this->compTable."`.`Status`='1' AND `".$this->usertypecompuserlink."`.`Status`='1' AND `".$this->erpmodule_m."`.`ERPModuleID` = '".$_SESSION['pgx']["AcERPModuleID"]."' AND `".$this->usertype_m."`.`Status`='1'";  
            //     $result = $this->db->executeQuery($sqlQuery);  
            // }    
            if(!empty($result[0])){   
                date_default_timezone_set('Asia/Kolkata');
                $sqlqry1 = "SELECT `".$this->companyerpmodule_link."`.`CompanyERPModuleLinkID` FROM `".$this->companyerpmodule_link."` ";
                $sqlqry1 .= " INNER JOIN `".$this->erpmodule_m."` ON `".$this->erpmodule_m."`.`ERPModuleID`= `".$this->companyerpmodule_link."`.`ERPModuleID` AND `".$this->companyerpmodule_link."`.`CompanyID`='".$result[0]['CompanyID']."' AND `".$this->erpmodule_m."`.`ERPModuleID` = '".$_SESSION['pgx']["AcERPModuleID"]."' AND `".$this->companyerpmodule_link."`.`Status`='1'"; 
                $compErpModLinkRes = $this->db->executeQuery($sqlqry1); 
                if(empty($compErpModLinkRes)){
                    unset($_SESSION['pgx']);
                    return(json_encode(array("Status"=>0,"Message"=>"Login failed 2")));
                } 
                $loginTime = date("d/m/y h:i:s");   
                $_SESSION['pgx']["loggedIn"]=1;
                $_SESSION['pgx']["CompanyUserID"]=$result[0]['CompanyUserID']; 
                $_SESSION['pgx']["UserLoginID"]=$result[0]['UserLoginID']; 
                if($compErpModLinkRes[0]['CompanyERPModuleLinkID']!=""){$_SESSION['pgx']['CompanyERPModuleLinkID']=$compErpModLinkRes[0]['CompanyERPModuleLinkID'];}
                else{$_SESSION['pgx']['CompanyERPModuleLinkID']='';}

                if($result[0]['UserName']!=""){$_SESSION['pgx']["UserName"]=$result[0]['UserName'];}
                else{$_SESSION['pgx']["UserName"]=$result[0]['UserLoginID'];}

                //Vipins Code//
                if($result[0]['CompUserEmail']!=""){$_SESSION['pgx']["CompUserEmail"]=$result[0]['CompUserEmail'];}

                if($result[0]['PhoneNumber']!=""){$_SESSION['pgx']["PhoneNumber"]=$result[0]['PhoneNumber'];}

                //Vipins Code//

                if($result[0]['SysUserName']!=""){$_SESSION['pgx']["SysUserName"]=$result[0]['SysUserName'];}
                else{$_SESSION['pgx']["SysUserName"]=$result[0]['UserName'];}

                $_SESSION['pgx']["AccessLevel"]=$result[0]['AccessLevel']; 
                $_SESSION['pgx']["LoginTime"]= $loginTime; 

                if($result[0]['CompanyID']!=""){$_SESSION['pgx']['CompanyID']=$result[0]['CompanyID'];}
                else{$_SESSION['pgx']['CompanyID']='';}

                if($result[0]['DBServerIP']!=""){$_SESSION['pgx']['compDB_HOST']=$result[0]['DBServerIP'];}
                else{$_SESSION['pgx']['compDB_HOST']='';}

                if($result[0]['DBUserID']!=""){$_SESSION['pgx']['compDB_USERNAME']=$result[0]['DBUserID'];}
                else{$_SESSION['pgx']['compDB_USERNAME']='';}

                if($result[0]['DBPswd']!=""){$_SESSION['pgx']['compDB_PASSWORD']=$result[0]['DBPswd'];}
                else{$_SESSION['pgx']['compDB_PASSWORD']='';}

                if($result[0]['DBName']!=""){$_SESSION['pgx']['compDB_DATABASE_NAME']=$result[0]['DBName'];}
                else{$_SESSION['pgx']['compDB_DATABASE_NAME']='';}

                // if($result[0]['CountryID']!=""){$_SESSION['pgx']['CountryID']=$result[0]['CountryID'];}
                // else{$_SESSION['pgx']['CountryID']='';}

                // if($result[0]['CompanyName']!=""){$_SESSION['pgx']['CompanyName']=$result[0]['CompanyName'];}
                // else{$_SESSION['pgx']['CompanyName']='';}

                // if($result[0]['UserTypeName']!=""){$_SESSION['pgx']['UserTypeName']=$result[0]['UserTypeName'];}
                // else{$_SESSION['pgx']['UserTypeName']='';}
                // ------------------------------
                //TABLE CREATION COMPLETED CHECK  
                $Newconn =new mysqli($_SESSION['pgx']['compDB_HOST'],$_SESSION['pgx']['compDB_USERNAME'],$_SESSION['pgx']['compDB_PASSWORD'],$_SESSION['pgx']['compDB_DATABASE_NAME']); 
                $checkExistance="SHOW TABLES LIKE '%000_tables%';";
                $allready = $Newconn->query($checkExistance);
                $tableExist = mysqli_fetch_assoc($allready); 
                if($tableExist==false || $tableExist=="" ||empty($tableExist) )
                { 
                    unset($_SESSION['pgx']);
                    return(json_encode(array("Status"=>0,"Message"=>"Login failed 3")));
                }
                // --------------- 
                return(json_encode(array("Status"=>1,"Message"=>"Login Success")));
            }
            else {
                unset($_SESSION['pgx']);
                return(json_encode(array("Status"=>0,"Message"=>"Login failed 4")));
            }
        }
        else{
            unset($_SESSION['pgx']);
            return(json_encode(array("Status"=>0,"Message"=>"Login failed 5")));
        }  
    }

   


}
?>
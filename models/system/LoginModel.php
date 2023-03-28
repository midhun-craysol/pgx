<?php require_once  MODEL_BASE_PATH."CrudModel.php"; 
class  LoginModel extends Database
{
    function __construct(){ 
        $this->crud = new CrudModel();
        $this->db = new Database();
        $this->logActivity = $this->crud->getPageTableName("loginactivity"); 


    }

    public function verifyLogin($table,$condtion)
    {    
        session_start();
        $tableName = $this->crud->getPageTableName($table);
        $sqlQuery = "SELECT * FROM `".$tableName."` ".$condtion; 

        
        $result = $this->db->executeQuery($sqlQuery);

       
        if(!empty($result[0])){ 
            $values=[];
            date_default_timezone_set('Asia/Kolkata');
               
            if($table=='sysusers')
            {  
                $_SESSION['pgx']["UserID"]=$result[0]["SysUserLoginID"];                
                $_SESSION['pgx']["UserName"]=$result[0]["SysUserName"];
                $_SESSION['pgx']['UserRole']=$result[0]["UserRole"];
                if($result[0]["UserRole"]=='root')
                {
                    $_SESSION['pgx']["UserName"]='Administrator';
                    $_SESSION['pgx']['rootsts']="Root";
                    $_SESSION['pgx']["NavTitle"]="System"; 
                    $_SESSION['pgx']["TypeRep"]="S";  
    
                }
                else if($result[0]["UserRole"]=='sales-admin'){
                    $_SESSION['pgx']["NavTitle"]="System"; 
                    $_SESSION['pgx']["TypeRep"]="SA";  
    
                    $_SESSION['pgx']['rootsts']="NonRootSysUser";

                }
                else{
                    $_SESSION['pgx']['rootsts']="NonRootSysUser";
                    $_SESSION['pgx']["NavTitle"]="System"; 
                    $_SESSION['pgx']["TypeRep"]="CU";  
    
                }
                $_SESSION['pgx']["UserMainID"]=$result[0]["SysUserID"]; 
                $_SESSION['pgx']["PasswordChangeFlg"]=$result[0]['PasswordChangeFlg'];   
               
              
            }
          
            $values["UserID"]=$_SESSION['pgx']["UserMainID"];
            $values["type"]="$table";
            $values["Status"]="OK";
            $Prim=$this->crud->createRow($this->logActivity,$values);
            $condtion1="WHERE `logID`='".$Prim."'";
            $sqlQuery1 = "SELECT * FROM `".$this->logActivity."` ".$condtion1;

            $result1 = $this->db->executeQuery($sqlQuery1);
            if(!empty($result1))
            {
                $_SESSION['pgx']["lastlogin"]=$result1[0]["lastlogin"];

            }


          
          
            return(json_encode(array("Status"=>1,"Message"=>"Login Success")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"Login failed")));
        }
    }

   


}
?>
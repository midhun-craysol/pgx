<?php
require_once  MODEL_PATH."SysUserModel.php";
require_once  MODEL_PATH."HelperModel.php";
class SysUserController  extends  UserBaseController
{  
    public function __construct(){
        $this->crudModel = new CrudModel();
        $this->SysUserModel = new SysUserModel();
        $this->helperModel = new HelperModel();
        $this->table = $this->crudModel->getPageTableName("SysUsers");
        $this->usertypeTable = $this->crudModel->getPageTableName("usertype");
        
        
    }
    public function userTypeIdByCompanyAction()
    {
    	if(isset($_POST['ID']) && isset($_POST['Names']) && isset($_POST['TabName'])){
    		$ID=$_POST['ID'];
    		$Name=$_POST['Names'];
    		$TableName=$_POST['TabName'];
            
            $responseData = $this->SysUserModel->userTypeIdByCompany($TableName,$ID,$Name);
	    	$this->sendOutput(
	            $responseData,
	            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
	        );  
    	}
    	
    }
    public function changePasswordAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
         
        if($requestMethod != 'POST'){                    

            $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));

        }
        else
        {                    
            $errors = [];                   
            $fields = ['SysUserID','SysUserPswd']; 
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
                    $conditions= "WHERE SysUserID = '".$values['SysUserID']."'"; 
                    $values['PasswordChangeFlg']=1;
                    $values['SysUserPswd']=md5($values['SysUserPswd']);
                    $responseData = $this->crudModel->update($this->table,$values,$conditions);

                    $this->sendOutput($responseData,array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                    );
                    
                
            }
        }
    	
    }
   public function listAction()
    {
        $timeStart = microtime(true);   
        $data['loadTimeStart'] =  microtime(true); 
        $data['pageID'] =  "0004"; 
        $menuData['breadhome'] = 'General';
        $menuData['breadpage'] = 'Craysol Users';
        if( $_SERVER["REQUEST_METHOD"] == 'POST' && $_POST['dAccess'] =="dashboard" )
        {
        $vars = [
            "pageName" => "craysolUserList" ,
            "pageTitle" =>"Craysol Users" ,           
            "popupBtn" =>"addSysUser",
            "dataTable" =>[
                "Id" =>"SysUserTable",
                "fields" => [
                                ["th"=>"Sl No.","width"=>"80"],
                                ["th"=>"Name","width"=>"150"],
                                ["th"=>"Role","width"=>"170"],
                                ["th"=>"Email","width"=>"170"],
                                ["th"=>"Phone Number","width"=>"170"],
                                ["th"=>"Login ID","width"=>"120"],
                                ["th"=>"Actions","width"=>"180"],
                                ["th"=> ""],
                            ]
                ]
            ];


        $vars['filterHtml'] = '<div class="form-group row" id="FilterChild"><div class="col-7 StatusMain"><select class="form-select" name="StatusFilter" id="StatusFilter" style=""><option value="1">Active</option><option value="0">Inactive</option><option value="2">Deleted</option></select></div><div class="col-5 FilterMain"><select name="TPFilterIDSrch" class="form-select" id="TPFilterIDSrch" autocomplete="off" style=""><option value="null">-Search Filter-</option><option value="SysUserName">Name</option><option value="UserRole">Role</option><option value="SysUserLoginID">Login ID</option></select></div></div>'; 

        
        $this->loadView("parts/dataTable",[],$vars);    
        $this->loadView("popups/sys_user_Form"); 
        $starttime = microtime(true);      
        $data["scripts"] = ["sysuser","helper/table","helper/form"];        
        $this->loadView("parts/plain",$data,$menuData); 
        $endtime = microtime(true); 
        echo("<span  class='loadTimeRoad'; > #0004 - <lable>".round(($endtime - $starttime),4)." Sec </label>".round((microtime(true) - $timeStart),4)." Sec </span>");                  
            
        }
        else{            
            header("HTTP/1.1 404 Not Found");
            exit();
        }  

    }

    public function loadTableAction()
    {
       

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; 
        $columnIndex = $_POST['order'][0]['column']; 
        $columnName = $_POST['columns'][$columnIndex]['data']; 
        $columnSortOrder = $_POST['order'][0]['dir'];         
        $searchValue = $_POST['search']['value']; // Search value
        $searchColumns =[$_POST['searchColumn']]; 
        if(isset($_POST['filter']['Status']) && $_POST['filter']['Status']!="" && $_POST['filter']['Status']!="-1"){
            $Status = $_POST['filter']['Status'];
        }else{
            $Status = '1';
        } 
        $page=$this->SysUserModel->paginate($searchValue,$searchColumns,$columnName,$columnSortOrder,$draw,$row,$rowperpage,$Status);
        echo(json_encode($page));
    }

    public function detailsAction()
        { 
        
        $requestMethod = $_SERVER["REQUEST_METHOD"];
         
                if($requestMethod != 'POST'){                    

                    $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));

                }
                else
                {                    
                    $errors = [];                   
                    $fields = ['SysUserID']; 
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
                        
                         
                        if(!empty($errors)){
                            //echo json_encode($errors);
                            $this->sendOutput(
                                json_encode(array("Status"=>0,"Message"=>"Please enter all fields","fields"=>$errors)),
                                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                            );
                        }
                        else{
                            $conditions= "WHERE SysUserID = '".$values['SysUserID']."'"; 
                            $responseData = $this->crudModel->details($this->table,$conditions);

                            $this->sendOutput($responseData,array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                            );
                            
                        }
                }
            }        
       
        
    }

    public function deleteAction()
        {      
        
        $requestMethod = $_SERVER["REQUEST_METHOD"];
         
                if($requestMethod != 'POST'){                    

                    $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));

                }
                else
                {                    
                   $errors = [];
                   $fields = ['SysUserID'];                    
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
                        
                        if(!empty($errors)){
                            $this->sendOutput(
                                json_encode(array("Status"=>0,"Message"=>"Please enter all fields","fields"=>$errors)),
                                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                            );
                        }
                        else{                            
                            $whereCondition ="WHERE SysUserID = '".$values['SysUserID']."'";
                            $responseData = $this->crudModel->deleteStatus($this->table,$whereCondition);
                            echo json_encode($responseData);
                            
                        }
                }
            }
                 
    }

    public function createAction()
        {                 
        
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        
 
                if($requestMethod != 'POST'){                    

                    $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));

                }
                else
                {        
                    $errors = [];
                    $fields = ["SysUserName","UserRole","SysUserLoginID","SysUserPswd","Email","PhoneNumber"]; 
                    $optionalFields = ["PasswordChangeFlg","UserRole"];
                    $values = [];                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        foreach ($fields as $field) {
                            if (empty($_POST[$field]) && !in_array($field, $optionalFields)) {
                                $errors[] = $field;
                            } else {
                                    $values[$field] = $this->helperModel->InputStringFormat($_POST[$field]);
                                    if($field =="SysUserPswd"){
                                        $values[$field]=md5($_POST[$field]);
                                    }
                            }
                        }
                        if(isset($_POST['PasswordChangeFlg'])) {
                            $values["PasswordChangeFlg"]=1; 
                        } else {
                            $values["PasswordChangeFlg"]=0; 
                        }                      
                        if(!empty($errors)){
                            $this->sendOutput(
                                json_encode(array("Status"=>0,"Message"=>"Please enter all fields","fields"=>$errors)),
                                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                            );
                        }
                        else{
                            $conditions1 = " WHERE `SysUserName` = '".$values['SysUserName']."' AND `Status`!='2' ";
                            $duplicates1 = $this->crudModel->checkDuplicates($this->table,$conditions1);
                            
                            $conditions2 = " WHERE `SysUserLoginID` = '".$values['SysUserLoginID']."' AND `Status`!='2' ";
                            $duplicates2 = $this->crudModel->checkDuplicates($this->table,$conditions2);
                                                   
                            if($duplicates1===true) {
                                $this->sendOutput(
                                json_encode(array("Status"=>2,"Message"=>"Username already exists. ")),
                                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                                );
                            }
                            elseif($duplicates2===true) {
                                $this->sendOutput(
                                json_encode(array("Status"=>2,"Message"=>"User Login ID already exists. ")),
                                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                                );
                            }
                              else {
                                $responseData = $this->crudModel->add($this->table,$values);
                                $this->sendOutput(
                                    $responseData,
                                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                                );
                            }                      
                            
                        }
                }
            }
          
    }

    public function updateAction()
        {
      
        
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        
 
                if($requestMethod != 'POST'){
                    $this->sendOutput('', array('HTTP/1.1 400 Bad Request'));
                }
                else
                {                    
                    $errors = [];
                    $fields = ["SysUserID","SysUserName","UserRole","Eamil","PhoneNumber","SysUserLoginID","Status"]; 
                    $optionalFields = ["SysUserPswd","UserRole","Status","PasswordChangeFlg"];
                    $values = [];
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        foreach ($fields as $field) {
                            if (empty($_POST[$field]) && !in_array($field, $optionalFields)) {
                                $errors[] = $field;
                            } else {
                                $values[$field] = $this->helperModel->InputStringFormat($_POST[$field]);
                                
                            }
                        }
                        if(isset($_POST['PasswordChangeFlg'])) {
                            $values["PasswordChangeFlg"]=1; 
                        } else {
                            $values["PasswordChangeFlg"]=0; 
                        }
                        if(isset($_POST['Status'])) {
                            $values["Status"]=1; 
                        } else {
                            $values["Status"]=0; 
                        }
                        if(!empty($errors)){
                            $this->sendOutput(
                                json_encode(array("Status"=>0,"Message"=>"Please enter all fields","fields"=>$errors)),
                                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                            );
                        }
                        else{      
                            $conditions1 = " WHERE `SysUserName` ='".$values['SysUserName']."' AND `SysUserID` !='".$values['SysUserID']."'AND `Status` !='2'";
                            $duplicates1 = $this->crudModel->checkDuplicates($this->table,$conditions1);

                            $conditions2 = " WHERE `SysUserLoginID` ='".$values['SysUserLoginID']."' AND `SysUserID` !='".$values['SysUserID']."'AND `Status` !='2'";
                            $duplicates2 = $this->crudModel->checkDuplicates($this->table,$conditions2);

                            if($duplicates1===true) {
                                $this->sendOutput(
                                json_encode(array("Status"=>2,"Message"=>"Company User name already exists")),
                                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                                );
                            }
                            elseif($duplicates2===true) {
                                $this->sendOutput(
                                json_encode(array("Status"=>2,"Message"=>" User Login ID already exists")),
                                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                                );
                            } else {
                                $whereCondition ="WHERE SysUserID ='".$values['SysUserID']."'";
                                $responseData = $this->crudModel->update($this->table,$values,$whereCondition);
                                $this->sendOutput(
                                    $responseData,
                                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                                );
                            } 
                        }
                }
            }
       
        
    }
   
 }
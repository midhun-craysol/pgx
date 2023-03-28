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
    public function paginate( $searchValue,$columnsToSearch,$sortColumn,$sortOrder,$draw,$row,$rowperpage,$Status)
    {
        ## Total number of records without filtering
        $selQ = "select count(*) as allcount from `".$this->table."`";
        $selQ .= " WHERE `".$this->table."`.Status='".$Status."'";
         
        $sel =  $this->db->select($selQ);
        $totalRecords = (!empty($sel))? $sel[0]['allcount']:0;
        $searchQuery = "";
        
        if(!empty($columnsToSearch) && ($totalRecords != 0)){
            if($searchValue != ''){
                $searchQuery .= " and ( ";    
                if(stripos("Active", $searchValue) !==false ){                    
                    $searchQuery .= $this->table.".Status like '%1%' or ";
                } 
                if(stripos("Inactive", $searchValue) !==false ){                    
                    $searchQuery .= $this->table.".Status like '%0%' or ";
                }
                if(stripos("Active", $searchValue) !==false ){                    
                    $searchQuery .= $this->table.".PasswordChangeFlg like '%1%' or ";
                } 
                if(stripos("Inactive", $searchValue) !==false ){                    
                    $searchQuery .= $this->table.".PasswordChangeFlg like '%0%' or ";
                }              
                foreach ($columnsToSearch as $key=> $column) { 
                    $searchQuery .= $column." like '%".$searchValue."%' ";    

                    if((count($columnsToSearch)-1) != $key){                    
                        $searchQuery .=" or ";
                    }else {
                        $searchQuery .=") ";
                    }
                    
                }
             }
        }

      
         ## Total number of record with filtering 
         $sel2 = $this->db->select($selQ." ".$searchQuery);
         $totalRecordwithFilter = (!empty($sel2))? $sel2[0]['allcount']:0;

        $query = "select `".$this->table."`.* from `".$this->table."`";
        $query .= " WHERE `".$this->table."`.`Status`='".$Status."'";
        $query .= " ".$searchQuery." order by ".$sort." ".$sortColumn." ".$sortOrder." limit ".$row.",".$rowperpage;
        $resultRecords =  $this->db->select($query);
         
        
        $data = array();
        foreach ($resultRecords as $key => $row) {  
            
           if($row['Status']=='1'){
                $Status='<div class="text-center"><i title="Active" class="fa fa-check-circle StatusActive" aria-hidden="true"></i>
                </div>';
                $colorclass='';
            }
            else if($row['Status']=='2'){
                $Status='<div class="text-center"><i title="Active" class="fa fa-check-circle StatusActive" aria-hidden="true"></i>
                </div>';
                $colorclass='colorrow';
            }
            else{
                $colorclass='inactivecolorrow';
                $Status='<div class="text-center"><i title="Inactive" class="fa fa-exclamation-triangle StatusInactive" aria-hidden="true"></i>
                </i></div>';
            }
           
            if($row['SysUserName']=='Root' && $row['SysUserLoginID']=='root')
            {
                $actions ='';
            }
            else
            {
                $actions ='<button type="button" class="btn  btn-icon  btn-sm" onclick="editSysUser(\''.$row['SysUserID'].'\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button type="button" class="btn  btn-icon  btn-sm '.$colorclass.'" onclick="changePassword(\''.$row['SysUserID'].'\')"><i class="fa fa-lock" title="Change Password"></i></button><button type="button" onclick="delSysUser(\''.$row['SysUserID'].'\')" class="btn  btn-icon  btn-sm delCrBtn"><i class="fa fa-trash" title="Delete"></i></button>' ;
            }     
            if($row['SysUserName']=='Root' || $row['Status']==2)
            {
               $actions ='<span class="'.$colorclass.'">--</span>';
            }
             $data[] = array( 
                "SysUserID"=>$key+1,
                "SysUserName"=>$row['SysUserName'],
                "UserRole"=>'<div class="text-center">'.$row['UserRole'].'
                </div>',
                "SysUserLoginID"=>$row['SysUserLoginID'],
                "SysUserPswd"=>$row['SysUserPswd'],
                "Email"=>$row['Email'],
                "PhoneNumber"=>$row['PhoneNumber'],
                'Actions' => '<div class="text-center">'.$actions.'</div>',
                'ExtraPadding' => "&nbsp"
            );
        }

        $response = array(
              "draw" => intval($draw),
              "iTotalRecords" => $totalRecords,
              "iTotalDisplayRecords" => $totalRecordwithFilter,
              "aaData" => $data
        );

        return($response);

    }
    public function userTypeIdByCompany($table,$ID,$Name)
    {   
        $tablename=$this->CrudModel->getPageTableName($table);
        
        $sqlQuery = "SELECT ".$ID.",".$Name." FROM ".$tablename." WHERE Status = '1' AND UserOrgType='Company'";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("qry"=>$result, "Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("qry"=>$result, "Status"=>0,"Message"=>"List fetching failed")));
        }
    }
    
}
?>
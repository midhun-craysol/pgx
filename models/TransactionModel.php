<?php 
require_once  MODEL_BASE_PATH."Database.php";
require_once  MODEL_BASE_PATH."CrudModel.php"; 
class  TransactionModel extends Database
{
    function __construct(){
        $this->CrudModel = new CrudModel();
        $this->db = new Database();
        $this->table = $this->CrudModel->getPageTableName("payments");
       
    }

    public function paginate($PaymentID,$searchValue,$columnsToSearch,$sortColumn,$sortOrder,$draw,$row,$rowperpage,$Status)
    {
       
        $selQ = "select count(*) as allcount from `".$this->table."` WHERE `".$this->table."`.`Status`='".$Status."' ";
        $sel =  $this->db->select($selQ);
        $totalRecords = (!empty($sel))? $sel[0]['allcount']:0;
        $searchQuery = "";
        // if($sortColumn=='TransactionID'){ $sortColumn='TransactionID';}
        if(!empty($columnsToSearch) && ($totalRecords != 0)){
            if($searchValue != ''){
                $searchQuery .= " and ( ";  
                
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
        // print_r($selQ." ".$searchQuery);        
        $sel2 = $this->db->select($selQ." ".$searchQuery);
        $totalRecordwithFilter = (!empty($sel2))? $sel2[0]['allcount']:0;

        $query = "select `".$this->table."`.*   from `".$this->table."` WHERE `".$this->table."`.`Status`='".$Status."'";
        $query .= " ".$searchQuery." order by ".$sortColumn." ".$sortOrder." limit ".$row.",".$rowperpage;
        // print_r($query);
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

            // $actions ='<button type="button" class="btn  btn-icon  btn-sm btn-sm '.$colorclass.'" onclick="editTransaction(\''.$row['PaymentID'].'\')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>' ;

            // $actions .='<button type="button" onclick="delTransaction(\''.$row['PaymentID'].'\')" class="btn  btn-icon  btn-sm btn-sm delCrBtn"><i class="fa fa-trash" title="Delete"></i></button>' ;
      
             
                $actions ='<span class="'.$colorclass.'">'.$Status.'</span>';
            
            $data[] = array( 
                "PaymentID"=>$key+1,
                "TransactionID"=>$row['TransactionID'], 
                "RazorpayPaymentId" => $row['RazorpayPaymentId'], 
                'TotalAmount' => '<div class="text-center">'.$row['TotalAmount'].'</div>',                 
                'Actions' => '<div class="text-center">'.$actions.'</div>',
                'ExtraPadding' => "&nbsp"
            );
        }

        $response = array(
              "draw" => intval($draw),
              "iTotalRecords" => $totalRecords,
              "iTotalDisplayRecords" => $totalRecordwithFilter,
              "aaData" => $data,
        );

        return($response);

    }
    
}
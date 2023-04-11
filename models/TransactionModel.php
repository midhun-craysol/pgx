<?php 
require_once  MODEL_BASE_PATH."Database.php";
require_once  MODEL_BASE_PATH."CrudModel.php"; 
class  TransactionModel extends Database
{
    function __construct(){
        $this->CrudModel = new CrudModel();
        $this->db = new Database();
        $this->table = $this->CrudModel->getPageTableName("pgsystran");
       
    }
    
}
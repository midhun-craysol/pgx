<?php         
require_once  MODEL_BASE_PATH."Database.php";
require_once  MODEL_PATH."HelperModel.php"; 
require_once  MODEL_API_PATH . "ERPAccountsDBCrudModel.php";
require_once  MODEL_API_PATH . "ERPmainDBCrudModel.php";
class HelperController  extends  BaseController
{
    public function __construct(){  
        $this->db = new Database();
        $this->crudModel = new CrudModel();
        $this->ERPAccountsDBCrudModel = new ERPAccountsDBCrudModel();
        $this->ERPmainDBCrudModel = new ERPmainDBCrudModel();
        $this->helperModel = new HelperModel();
		$this->usercompanyoffice_link = $this->ERPAccountsDBCrudModel->getPageTableName("usercompanyoffice_link");    
		$this->paygate_m = $this->ERPAccountsDBCrudModel->getPageTableName("paygate_m");    
		$this->companyoffice_m = $this->ERPmainDBCrudModel->getPageTableName("companyoffice_m");   
    }

    public function nameByIDAction()
    {
    	if(isset($_POST['ID']) && isset($_POST['Names']) && isset($_POST['TabName'])){
    		$ID=$_POST['ID'];
    		$Name=$_POST['Names'];
    		$TableName=$_POST['TabName'];

	    	$responseData = $this->helperModel->nameByID($TableName,$ID,$Name);
	    	$this->sendOutput(
	            $responseData,
	            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
	        );  
    	}
    	
    }
    
	public function nameByFIDAction()
    {
    	if(isset($_POST['ID']) && isset($_POST['Names']) && isset($_POST['TabName']) && isset($_POST['Fid']) && isset($_POST['FldName'])){
    		$ID=$_POST['ID'];
    		$Name=$_POST['Names'];
    		$TableName=$_POST['TabName'];
    		$FID=$_POST['Fid'];
    		$FldName=$_POST['FldName'];

	    	$responseData = $this->helperModel->nameSelectByVal($TableName,$ID,$Name,$FldName,$FID);
	    	$this->sendOutput(
	            $responseData,
	            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
	        );  
    	}
    	
    }


    public function nameByIDWithSearchAction()
    {
    	if(isset($_POST['ID']) && isset($_POST['Names']) && isset($_POST['TabName'])){
    		$ID=$_POST['ID'];
    		$Name=$_POST['Names'];
    		$TableName=$_POST['TabName'];
    		$Searchvalue=$_POST['Searchvalue'];
    		$Searchitem=$_POST['Searchitem'];

	    	$responseData = $this->helperModel->nameByIDWithSearch($TableName,$ID,$Name,$Searchvalue,$Searchitem);
	    	$this->sendOutput(
	            $responseData,
	            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
	        );  
    	}
    	
    }  
	public function getProductListsAction()
	{
		$_SESSION['pgx']["PayGateID"]=$_POST['PayGateID']; 
		$SearchCondition ="AND PayGateID ='".$_POST['PayGateID']."'";
		$responseData = $this->helperModel->setPayGateName($this->paygate_m,'PayGateID','PaymentGatewayName',$SearchCondition); 
		$_SESSION['pgx']["PaymentGatewayName"]= $responseData[0]['PaymentGatewayName']; 
		echo $responseData[0]['PaymentGatewayName'];

	}
	
}
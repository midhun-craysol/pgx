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
	public function userOfficeListAction()
	{  
		$whereCondition ="WHERE UserID ='".$_SESSION['pgx']["CompanyUserID"]."' AND Status='1'";
		$responseData = $this->ERPAccountsDBCrudModel->listRows($this->usercompanyoffice_link,['CompanyOfficeID'],$whereCondition);
		$officeIds ='';
		if(!empty($responseData)){
			$officeIds = implode("','" ,array_column($responseData,'CompanyOfficeID')); 
		} 
		$ID='CompanyOfficeID';
		$Name='CompanyOfficeName';
		$SearchCondition = " AND CompanyOfficeID IN ('".$officeIds."')";
		$offices = $this->helperModel->getUserOffices($this->companyoffice_m,$ID,$Name,$SearchCondition);
		$this->sendOutput(
			$offices,
			array('Content-Type: application/json', 'HTTP/1.1 200 OK')
		);
	
	}
	public function setOfficeSessionAction()
	{
		$_SESSION['pgx']["CompanyOfficeID"]=$_POST['userOfficeLinkID']; 
		$SearchCondition ="AND CompanyOfficeID ='".$_POST['userOfficeLinkID']."'";
		$responseData = $this->helperModel->setOfficeName($this->companyoffice_m,'CompanyOfficeID','CompanyOfficeName',$SearchCondition); 
		$_SESSION['pgx']["CompanyOfficeName"]= $responseData[0]['CompanyOfficeName']; 
		echo $responseData[0]['CompanyOfficeName'];

	}
	public function loadPaygateByOfficeAction()
    { 
    	if(isset($_POST['yes'])){ 
	    	$responseData = $this->helperModel->loadPaygateByOffice( );
	    	$this->sendOutput(
	            $responseData,
	            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
	        );  
    	}
    	
    }
	public function setPayGateSessionAction()
	{
		$_SESSION['pgx']["PayGateID"]=$_POST['PayGateID']; 
		$SearchCondition ="AND PayGateID ='".$_POST['PayGateID']."'";
		$responseData = $this->helperModel->setPayGateName($this->paygate_m,'PayGateID','PaymentGatewayName',$SearchCondition); 
		$_SESSION['pgx']["PaymentGatewayName"]= $responseData[0]['PaymentGatewayName']; 
		echo $responseData[0]['PaymentGatewayName'];

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
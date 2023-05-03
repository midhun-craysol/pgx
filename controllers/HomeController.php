<?php

class HomeController  extends  BaseController
{  
    public function __construct(){ 
        // $this->crudModel = new CrudModel();
        // $this->loginModel = new LoginModel();  
        // $this->companyuser_m = $this->crudModel->getPageTableName("companyuser_m");
    }

   
    public function webMasterAction(){   
        $this->loadView("home/header");   
        $this->loadView("home/index"); 
       // $data["scripts"] = ["login"];  
        $this->loadView("home/footer",$data);    
    }

   

}
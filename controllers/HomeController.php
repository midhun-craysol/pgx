<?php

class HomeController  extends  BaseController
{  
    public function __construct(){ 
        // $this->crudModel = new CrudModel();
        // $this->loginModel = new LoginModel();  
        // $this->companyuser_m = $this->crudModel->getPageTableName("companyuser_m");
    }

    public function termsAndConditionsAction(){   
        $this->loadView("login/header");   
        $this->loadView("login/termsAndConditions"); 
        // $data["scripts"] = ["login"];  
        $this->loadView("login/footer");    
    }

   

}
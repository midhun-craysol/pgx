<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?php echo(ASSETS_URL); ?>images/favicon.png">
    <script src="<?php echo(ASSETS_URL); ?>js/jquery.js" ></script>  
    <script src="<?php echo(ASSETS_URL); ?>js/jquery-3.6.0.min.js" ></script>  
  
    <script src="<?php echo(ASSETS_URL); ?>jquery-validation-1.19.3/lib/jquery.js" ></script>
    <script src="<?php echo(ASSETS_URL); ?>jquery-validation-1.19.3/dist/jquery.validate.js" ></script>
    
    <!-- Bootstrap CSS -->
    

    <link rel="stylesheet" href="<?php echo(ASSETS_URL); ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo(ASSETS_URL); ?>bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo(ASSETS_URL); ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo(ASSETS_URL); ?>css/dashboard/header.css">
    <link rel="stylesheet" href="<?php echo(ASSETS_URL); ?>css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo(ASSETS_URL); ?>bootstrap/css/bootstrap-select.min.css"  > 
    <script src="<?php echo(BASE_URL."/assets/js/bootbox.min.js"); ?>" ></script>
    <script src="<?php echo(ASSETS_URL); ?>vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?php echo(ASSETS_URL); ?>vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?php echo(ASSETS_URL); ?>js/jquery-ui.min.js" ></script>  
     <title>SLD- Payment Gateway</title>
  
  <link rel="stylesheet" href="<?php echo(ASSETS_URL); ?>css/dashboard/main.css">
  
  
  <link rel="stylesheet" href="<?php echo(ASSETS_URL); ?>css/dashboard/blue.css">

  </head>
  <script>
    BASEURL="<?php echo(BASE_URL); ?>";
    ASSETURL="<?php echo(ASSETS_URL); ?>";
    ERP_BASE_URL="<?php echo(ERP_BASE_URL); ?>";
    document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
      
      element.addEventListener('click', function (e) {

        let nextEl = element.nextElementSibling;
        let parentEl  = element.parentElement;	

            if(nextEl) {
                e.preventDefault();	
                let mycollapse = new bootstrap.Collapse(nextEl);
                
                if(nextEl.classList.contains('show')){
                  mycollapse.hide();
                } else {
                    mycollapse.show();
                    // find other submenus with class=show
                    var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                    // if it exists, then close all of them
                    if(opened_submenu){
                      new bootstrap.Collapse(opened_submenu);
                    }
                }
            }
        }); 
      }) 
    }); 
  </script>


<body>    
  <div id ="appendScript" class="hide"></div>
    <?php 
      if(empty($_SESSION['pgx']["CompanyUserID"]))
      {
        header("Location:".BASE_URL."login"); 
      } 
    ?>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap shadow"> 
 
      <a class="col-md-2 col-lg-2 nav-title" href="#"> 
        <nav class="navbar navbar-dark bg-dark">
            <div class="row tgNav">
              <div class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent"  aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation" style="border:none;">
             <img src="<?php echo(BASE_URL."/assets/images/test2.png");  ?>" alt="logo" style="width:50%;" onclick="location.href = '';">  
              <span class="navbar-toggler-icon pgx_btn1" style="margin-left:25%;"></span>
                </div>

            </div>
        </nav>      
        </a>
      <div class="navbar-nav col-md-10 col-lg-10 " > 
          <div class="row" >
            <div class="col-lg-6 col-md-6 col-sm-8 col-7">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6">              

                  <!-- <h5 class="breadHead" style="font-size: 14px"><?php echo strtoupper($_SESSION['pgx']["NavTitle"]); ?> <?php echo $_SESSION['RepName']; ?></h5> -->
                </div>
                <div class="col-lg-12 col-md-10 col-sm-10">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                          <a href="#" id="breadHome" class="nav-title" ><?php echo $_SESSION['pgx']["NavTitle"]; ?></a>
                        </li>
                        <li id="breadPage" class="breadcrumb-item active" aria-current="page">Dashboard</li>
                      </ol>
                    </nav>
                </div>          
              </div>
            </div>


            <div class="col-lg-4 col-md-4 col-sm-1 col-1 pt-2" id="activitylog"> 
              <div class=" breadHead"  ><div class="float-right btn btn-danger context-menu pointerView pgx_btn" id="typ" >
            <?php echo $_SESSION['pgx']["TypeRep"];?></div>  
            <div class="breadHead">
                <?php
                    if($_SESSION['pgx']["CompanyOfficeID"] =='') {  ?>
                        <p class="officeUserLink" style="width: 168px;">
                          <!-- <span class="officeLabel">
                            Office
                          </span> -->
                          <span class="officeSelect flash blink" id="offSpan">
                            <select class="form-select tableinput_fields changefilter" id="userOfficeLink" name="userOfficeLink" style="width: 120px;border: 2px solid #eaa73a;border-radius: .25rem;">
                                <option value=''>Select Office</option>
                            </select>
                          </span>
                        </p>
                        <span class="officeName"></span> 

                <?php }else{ ?>
                            <span id="offName" class="OfficeModule"><?php echo($_SESSION['pgx']["CompanyOfficeName"]); ?> 
                            </span>
                      </span>
                        
                <?php }  
                  // <!-- SELECT PAYMENT GATEWAY  -->
                  if($_SESSION['pgx']["PayGateID"] =='') {  ?>
                  <p class="pgy" style="width: 168px;">
                    <!-- <span class="">
                    Payment Gateway 
                    </span> -->
                    <span>
                      <select class="form-select tableinput_fields changefilter" id="paymentGateway" name="paymentGateway" style="width: 120px;border: 2px solid #eaa73a;border-radius: .25rem;">
                        <option value=''>Select Payment Gateway</option>
                      </select>
                    </span>
                  </p>
                  <span class="paygateName"></span>
                  <?php }else{ ?>
                            <span id="offName" class="OfficeModule"><?php echo(" - ".$_SESSION['pgx']["PaymentGatewayName"]); ?> 
                            </span>  
                <?php } ?>
              </div> 
          </div>

            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-2 pt-2 ">

              <div class="text-left base d-none profileDiv" id="LogContent">
              

              <p class="pClass"> &nbsp; <img src="<?php echo(BASE_URL."/assets/images/alert-icons/download.png");  ?>" alt="logo" style="width: 11%;"> &nbsp;<?php echo "".$_SESSION['pgx']["UserName"]; if(isset($_SESSION['pgx']["UserRole"])){?>(<?php echo strtoupper("".$_SESSION['pgx']["UserRole"]);?>)<?php } ?>&nbsp; </p>
              <p  class="pClass"> &nbsp; <img src="<?php echo(BASE_URL."/assets/images/alert-icons/images.png");  ?>" alt="logo" style="width: 8%;"></i>&nbsp;
              <?php $date=date_create($_SESSION['pgx']["lastlogin"]);
                echo date_format($date,"h:i:sa d-m-Y"); ?>&nbsp; </p>

          
              <p  class="pClass1"> &nbsp;<a href="javascript:void(0)" onclick="resetPwdDiv()"> &nbsp;<img src="<?php echo(BASE_URL."/assets/images/alert-icons/pwd1.jpg");  ?>" alt="logo" style="width: 8%;text-decoration: none;" id="resetPwdDiv"> 
                Change Password?</a>&nbsp; </p>
              <div id="pwdresetForm" class="col-12 d-none">
              <div class="row g-3 align-items-center">
                <form class="forms-sample" id="changePasswordForm1" content-type="multipart/form-data" method="POST">
                        <div class="container">
                          <div class="row">
                          <div class="col-12 showhide_eye">
                           <i class="fa fa-eye-slash" id="eye3"></i>
                              <input name="oldmPwd" type="password" style="border: 1px solid #014a5c;height: 15px;margin-bottom: 5px;" class="form-control inputPswd"  id="oldmPwd" autocomplete="off"  placeholder="Old Password"> 
                            </div>

                            <div class="col-12 showhide_eye">
                            <i class="fa fa-eye-slash" id="eye1"></i>
                              <input name="SysUserPswd" type="password" style="border: 1px solid #014a5c;height: 15px;margin-bottom: 5px;" class="form-control inputPswd"  id="SysUserPswd" autocomplete="off"  placeholder="New Password"> 
                              <input name="type" type="hidden" class="form-control border-0" id="type" autocomplete="off" value="<?php echo  $_SESSION['pgx']["NavTitle"];?>" placeholder="New Password">  
                            </div>
                            
                            <div class="col-12  showhide_eye" id="CnfrmLoginPswdDiv">
                              <i class="fa fa-eye-slash" id="eye2"></i>
                              <input name="ConfirmPswd" type="password" style="border: 1px solid #014a5c;height: 15px;margin-bottom: 5px;" class="form-control inputPswd"  id="ConfirmPswd" autocomplete="off"  placeholder="Confirm Password"> 
                            </div>
                    
                          
                            </div>
                            <div class="row text-right pb-2">
                            <div class="col-8">
                            <span id="passwordErrs" class="form-text" style="color:red"></span>
                            </div>
                            <div class="col-12">
                              <span id="passwordHelpInline" class="form-text">
                              <button type="button" id="CancelSubmit" class="btn btn-sm btn-primary" style="font-size: 10px;border-color: #ff2121 !important;background-color: #ff2121 !important; ">Cancel</button>

                              <button type="button" id="changePasswordSubmit" class="btn btn-sm btn-primary" style="font-size: 10px;">Save</button>
                              
                              </span>
                            
                            </div>
                            </div>
                        </div>

                    </form>
                </div>
              
              
              </div>

            
            
            </div>
            </div>
            <div class=" col-lg-1 col-md-1 col-sm-1 cls-col-2 shrink" >            
              <a class="logout" aria-hidden="true" onclick="LogOut()" style="font-size: 16px"><img src="<?php echo(BASE_URL."assets/images/alert-icons/out.png");  ?>" alt="logo" style="margin-top: 11px;width:28px;"> 
            </i></a>
            </div>
          </div>
      </div>
    </header>

    
    <?php
      if($_SESSION['pgx']["NavTitle"]=='System')
      {
        $restClss="";
        $menuConfig =
        [ 
          "Dashboard" =>[ "hasSub" => false ,"url" =>"../pgx"],
        ];
  
        if($_SESSION['pgx']['rootsts']=="NonRootSysUser"){
             if($_SESSION['pgx']['UserRole']=="sales-admin"){
                $restClss="";
               
            }
            else{              
                 $genSub = $menuConfig["General"]["subMenu"];
                 unset($genSub["Craysol Users"]);
                 $menuConfig["General"]["subMenu"] = $genSub;
            }

            if($_SESSION['pgx']["PasswordChangeFlg"]==1){
              $restClss="restPwdClass";
              $menuConfig =[ 
                "Reset Password" =>["hasSub" => false ,"url" =>"#"],
              ];
            }
      }
    }

    else if($_SESSION['pgx']["NavTitle"]=='Agent')
    {
   
      if($_SESSION['pgx']['rootsts']=="Agent"){
   
        if($_SESSION['pgx']["PasswordChangeFlg"]==1){
          $restClss="restPwdClass";
          $menuConfig =[ 
            "Reset Password" =>["hasSub" => false ,"url" =>"#"],
            ];
        }
        else
        {

          }
   
      }
 
    }
  ?>


  <div class="container-fluids" style="padding-left: 15px;">
  <div class="row" style="width: 100%;">
  <div class="collapse " id="navbarToggleExternalContent1">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 pt-19">
        <ul class="nav flex-column">
          <?php 
          if(!empty($menuConfig)){
            foreach($menuConfig as $menuKey =>$details){
              if($details["hasSub"] == false){
                echo('<li class="nav-item">
                <a class="nav-link '.$restClss.'" id="'.$restClss.'" href="'.BASE_URL.$details["url"].'">
                  <span data-feather="file"></span>
                 '.$menuKey.'
                </a>
              </li>');
              }
              else{
                if(!empty($details['subMenu'])){
                  echo'<li class="nav-item has-submenu">
                  <a class="nav-link" href="#"> '.$menuKey.' <i class="fa '.$details['icon'].'"></i></a>
                  <ul class="submenu collapse">';
                  foreach($details['subMenu'] as $subKey => $subMenuDetails){ 
                      echo'<li><a class="nav-link" href="'.$subMenuDetails['url'].'">'.$subKey.' <i class="fa '.$subMenuDetails['icon'].'"></i> </a></li>';
               


                  }
                  echo'</ul>
                </li>';
                }
              }
            }
          }
          
          ?>
        </ul>
        <br>
        <br>
        <br>
      </div>
    </nav> 
    </div> 
 
      
    <main class="col-md-12 ms-sm-auto col-lg-12 " id="mainContentArea" >
    
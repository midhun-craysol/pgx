<style>
@media only screen and (max-width: 992px) {   
  .auth-form-light
  {    
    padding-bottom: 100px !important;
  }
    .imageSec 
    {   
       display: none;
    }
 } 
 .customContainer{
    position: absolute; 
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    padding: 10px;
  }
  .pointer {cursor: pointer;}
  .err3  {
    color:red;
    font-size: 12px;
    margin-left: 5px;

  }
/* Color of the links BEFORE scroll */


</style>







<!-- LOGIN  -->
<div class="container customContainer">
  <div class="container-scroller">
    <div class="page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0" >
        <div class="row w-100 mx-0">
          <div class="col-lg-6 col-sm-12 col-md-12 mx-auto">
            <div class="row ">          
             
                <div class="auth-form-light1   imageSec text-left py-5 px-4   col-lg-6" >
                  <div class="brand-logo ">
                    <img src="<?php echo(BASE_URL); ?>assets/images/logo.png" alt="logo" style="width: 100%;">
                  </div>
                  
                </div>
              
              <div class="auth-form-light text-left py-3 px-4 px-sm-3 col-lg-6 ">
                <h5  class="text-center py-2">SIGN IN</h5>
                <form class="pt-3" id="loginForm" method="POST" action="" autocomplete="off">
                 <div class="w3-row w3-section">
                    <div class="w3-rest">
                    <div class="w3-rest">
                        <span><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Username</span>
                        <input class="w3-input w3-border" name="UserName" id="UserName" type="text" placeholder="User Name" style="border-radius: 5px;">
                        <span id="err1" class="err1" ></span>
                      </div>

                      <span><i class="fa fa-key" aria-hidden="true"></i>
                      Password &nbsp;<i class="fa fa-eye pointer" aria-hidden="true" id="showPass" onclick="myFunction()"></i></span>
                      <input class="w3-input w3-border" name="UserPassword" id="UserPassword" type="password" placeholder="Password" style="border-radius: 5px;">
                      <span id="err2" class="err2" ></span>
                  </div>
                 

                  </div>
                  <div class="text-center">
                       <br>
                          <span id="err3" class="err3" ></span>
                  </div>
                      <div class="text-center">
                      <button class="button" type="submit" style="vertical-align:middle"><span>LOGIN </span></button>
                      </div>

                      <!-- <div class="text-center">
                      <span id="err3" class="err2" ></span>
                      </div> -->
    
                </form>
              </div>
             
              
            </div>
          </div>

        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  </div>


 
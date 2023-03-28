<script>
  pageName ="stateList";
</script>

   <!-- Modal -->
   <div class="modal fade" id="customer_user_passwordResetFormModal" tabindex="-1" role="dialog" aria-hidden="true">       
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer User  </h5>
                <a type="button" class="close" id="btnModeClosePswdReset" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <div class="modal-body">               
              <div class="col-md-12 px-0 stretch-card">
                <div class="card">
                  <div class="card-body">

                    <form class="forms-sample" id="customer_user_passwordResetForm" content-type="multipart/form-data" method="POST">

                       <div class="form-group row">
                        <label for="CustUserPswd" class="col-sm-4 col-form-label"> New Password <i class="text-danger">*</i> </label>
                        <div class="col-sm-8" >
                          <input name="CustUserPswd" type="text" readonly class="form-control" id="CustUserPswd" autocomplete="off">
                        </div>
                        
                      </div>

                        
                       

                      

                       

                      <button type="submit" id="customerUserPswdReset" class="btn btn-primary btn-sm float-right" >Reset</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>



        <!-- Modal View -->

     <div class="modal fade" id="customerUserFormModalView" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title  ml-2" id="exampleModalLabel">Client Details</h5>
             <a type="button" class="close" id="btnModeClose2" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </a>
         </div>

        <div class="modal-body">               
            <div class="col-md-12 px-0 stretch-card">
                <div class="card">
                    <div class="card-body"> 
                    <div class="row">                    
                          <label class="col-sm-6 col-form-label">Customer Name<span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewCustomerName"></span>
                      </div>
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label">Customer User Type<span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewCustUserType"></span>
                      </div>
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label">Customer User Name <span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewCustUserName"></span>
                      </div>
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label"> Phone Number <span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewPhNumber"></span>
                      </div>
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label"> Phone Verify Code<span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewPhoneVerifyCode"></span>
                      </div>
                      
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label"> Phone Verify Code Generated Date<span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewPhVerifyGenDate"></span>
                      </div>
                      
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label">Phone Number Verify Status<span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewPhNumberVerifyStatus"></span>
                      </div>
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label">Email ID<span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewEmailID"></span>
                      </div>
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label">Login User ID<span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewLoginUserID"></span>
                      </div>
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label">Login Password<span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewLoginPassword"></span>
                      </div>
                      <div class="row">                    
                          <label class="col-sm-6 col-form-label">Status<span class="float-right">: </span></label>
                          <span class="col-sm-6 col-form-label" id="viewStatus"></span>
                      </div>
                      
                    </div>
                </div>
            </div>
        </div>


         
       </div>
     </div>
   </div>


        
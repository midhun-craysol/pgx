<script>
  pageName ="SysUserList";
</script>
   <div class="modal fade" id="SysUserModal" tabindex="-1" role="dialog" aria-hidden="true">       
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Craysol User</h5>
                <a type="button" class="close" id="btnModeClose" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <div class="modal-body">               
              <div class="col-md-12 px-0 stretch-card">
                <div class="card">
                  <div class="card-body">

                    <form class="forms-sample" id="SysUserForm" content-type="multipart/form-data" method="POST">
                   
                      <div class="form-group row">
                        <label for="SysUserName" class="col-sm-4 col-form-label "> Name <i class="text-danger">*</i> </label>
                        <div class="col-sm-8">
                          <input name="SysUserName" type="text" class="form-control text_field" id="SysUserName" autocomplete="off">
                        </div>
                      </div>      
                      <div class="form-group row">
                        <label for="UserRole" class="col-sm-4 col-form-label">User Role<i class="text-danger">*</i> </label>
                        <div class="col-sm-8">
                        <select name="UserRole" class="form-select text_field" id="UserRole" autocomplete="off">
                          <option value="">--Select--</option>
                          <option value="root">Root</option>
                          <option value="sales-admin">Sales Admin</option>
                          <option value="craysol-user">Craysol User</option>
                        </select>
                        </div>
                      </div>            
                      <div class="form-group row">
                        <label for="SysUserLoginID" class="col-sm-4 col-form-label">  Login  ID <i class="text-danger">*</i> </label>
                        <div class="col-sm-8">
                          <input name="SysUserLoginID" type="text" class="form-control valAlpNum text_field" id="SysUserLoginID" autocomplete="off">
                        </div>
                      </div> 
                
                      <div class="form-group row" id="UserPswdDiv">
                        <label for="SysUserPswd" class="col-sm-4 col-form-label">Password<i class="text-danger">*</i></label>
                        <div class="col-sm-8 showhide_eye">
                        <i class="fa fa-eye-slash" id="eye1"></i>
                          <input name="SysUserPswd" type="password" class="form-control" id="SysUserPswd1" autocomplete="off" data-id="0">
                          <span id="lblError" class="specialchar_error"></span>
                        </div>
                      </div>

                      <div class="form-group row" id="CnfrmLoginPswdDiv">
                        <label for="ConfirmPswd" class="col-sm-4 col-form-label">Confirm Password<i class="text-danger">*</i></label>
                        <div class="col-sm-8 showhide_eye">
                        <i class="fa fa-eye-slash" id="eye2"></i>
                          <input name="ConfirmPswd" type="password" class="form-control" id="ConfirmPswd" autocomplete="off" data-id="0">
                          <em id="ConfirmPswd-error" class="error help-block"></em>
                        </div>
                      </div>

                      <div class="form-group row">
                      <div class="col-sm-4"></div>
                 
                    </div>
                    <div id="Statusdiv">
                        <div class="form-group row">
                          
                          <!-- <div class="col-sm-4"> -->
                          <label class="col-sm-4 col-form-label pr-0"> Status</label>
                          <!-- </div>                           -->
                          <div class="col-sm-8">
                          <label class="switch">
                              <input id="Status" name="Status" type="checkbox" checked>
                              <span class="slider round"></span>
                           </label> 
                            <!-- <div class="custom-control custom-switch">
                              <input value="1" type="checkbox" name="Status" class="form-check-input" id="Status">
                              <span for="Status" class=" col-form-label">Status</span>
                            </div> -->
                          </div>
                        </div>
                        </div>
                      <button type="submit" id="SysUserSubmit" class="btn btn-sm btn-primary float-right" >Save</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">       
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <a type="button" class="close" id="btnModeClose1" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <div class="modal-body">               
              <div class="col-md-12 px-0 stretch-card">
                <div class="card">
                  <div class="card-body">

                    <form class="forms-sample" id="changePasswordForm2" content-type="multipart/form-data" method="POST">
                    
                      <div class="form-group row">
                        <label for="SysUserName" class="col-sm-4 col-form-label">New Password <i class="text-danger">*</i> </label>
                        <div class="col-sm-8" >
                          <input name="SysUserPswd" type="text" readonly class="form-control" id="SysUserPswd" autocomplete="off">
                        </div>
                        
                      </div>                      
                      <button type="submit" id="changePasswordSubmit" class="btn btn-sm btn-primary float-right" >Reset</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
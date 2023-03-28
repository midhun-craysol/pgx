<?php 

if(($_SESSION['pgx']["PasswordChangeFlg"]==1)&&($_SESSION['pgx']["NavTitle"]=='System')){
    ?>
<!-- </br>
</br>
    <form class="forms-sample" id="changePasswordForm2" content-type="multipart/form-data" method="POST">
        
            <div class="form-group row">
            <label for="SysUserName" class="col-sm-3 col-form-label"> Password <i class="text-danger">*</i> </label>
            <div class="col-sm-4" >
                <input name="SysUserPswd" type="text" class="form-control" id="SysUserPswd" autocomplete="off">
            </div>
            <div class="col-sm-4" >
            <button type="submit" id="changePasswordSubmit" class="btn btn-sm btn-primary" >Save</button>
            </div>
            </div>                      
            
        </form> -->
<?php }

else{?>
    <div class="mx-auto bg-info" style="margin-top:5%;width:150px;"></div>

<?php } ?>
  
tabx="Password reset " ;  
$(document).ready(function(){
    $("#changePasswordSubmit").attr("disabled",true);
    $("#CnfrmLoginPswdDiv").hide();
 
 $("#changePasswordSubmit").click(function(e){	
   
    $("#passwordErrs").html("");
    $("#changePasswordSubmit").attr("disabled=disabled");

        e.preventDefault();			
        if($( "#changePasswordForm1").valid()){	
            
            var message = " Updation"; 
            var formData = $("#changePasswordForm1").serialize(); 
            $(".modalLoader").show();
            $.ajax({
                type: 'POST',
                url:  BASEURL+"passwordUpdate",
                data: formData,
                dataType: "json",
                success: function(resultData) {   
                    imgStr = 'assets/images/alert-icons/infoAlert.png';
                    bootbox.alert({	
                        title:  "Alert :"+tabx,
                        backdrop : true,
                        message: "<div class='row'><div class='col-sm-2'><img src='"+imgStr+"' alt='Warning' width='50' height='50'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b>"+resultData.Message+"</b></div></span>"+"</div></div>"
                        
                    });
                    if(resultData.Status =='1'){
                        $("#passwordErrs").html("");


                        setTimeout(()=> {
                            window.location = BASEURL+"logout";
                        }
                         ,3000);
                    }
                    else if(resultData.Status =='3')
                    {
                        $("#passwordErrs").html("Invalid Old Password");
                        
                    }
                },
                error : function(error) {                 
                    message =  " Failed\n"; 
                    alertBox(resultData.Status,message,tabAlert);
                },
                complete : function(){
                    $(".modalLoader").hide();
                }
            });
        }
    });

    $.validator.addMethod("strong_password", function (value, element) {
        let password = value;
        if (!(/^(?=.*(?=.*[0-9]))(?=.*[@#$%&])(.{6,12}$)/.test(password))) {
            return false;
        }
         return true;
    }, function (value, element) {
        let password = $(element).val();
        if (!(/^(.{6,12}$)/.test(password))) {
            return 'Password must be between 6 to 12 characters.';
        }
        // else if (!(/^(?=.*[A-Z])/.test(password))) {
        //     return 'Password must contain at least one uppercase.';
        // }
        // else if (!(/^(?=.*[a-z])/.test(password))) {
        //     return 'Password must contain at least one lowercase.';
        // }
        else if (!(/^(?=.*[0-9])/.test(password))) {
            return 'Password must contain at least one digit.';
        }
        else if (!(/^(?=.*[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~])/.test(password))) {
            return "Password must contain special characters.";
        }
        return false;
    });
    $("#changePasswordForm1").validate({
        rules: {
            oldmPwd: {required:true},
            SysUserPswd: {required:true,strong_password:true},
            ConfirmPswd: {required:true,equalTo:'#SysUserPswd'},

			
        },
        messages: {
            SysUserPswd:{required:"Enter Password"},
            oldmPwd:{required:"Enter Old Password"},
            ConfirmPswd:{
                required: "Please confirm Your Password",
                equalTo:"Password is not Matching"
            }
        },
        errorElement: "em",
		errorPlacement: function ( error, element ) {
			
			error.addClass( "help-block" );

			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
		},
    });


  
    
});
$('#SysUserPswd').keyup(function () {
    if(this.value==""){
    
        $("#ConfirmPswd").val("");
        $("#CnfrmLoginPswdDiv").hide();
        $('#ConfirmPswd').removeClass('text_field');
       
           
    }
    else{
        $("#CnfrmLoginPswdDiv").show();
        $('#ConfirmPswd').addClass('text_field');


    }
 });

$("#eye1").on("click",function(){
    if($(this).hasClass('fa-eye-slash')){
        $("#SysUserPswd").attr('type','text');
    }else{
        $("#SysUserPswd").attr('type','password');
    }
    $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye');
    
});
$("#eye2").on("click",function(){
    if($(this).hasClass('fa-eye-slash')){
        $("#ConfirmPswd").attr('type','text');
    }else{
        $("#ConfirmPswd").attr('type','password');
    }
    $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye');
    
});
$("#eye3").on("click",function(){
    if($(this).hasClass('fa-eye-slash')){
        $("#oldmPwd").attr('type','text');
    }else{
        $("#oldmPwd").attr('type','password');
    }
    $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye');
    
});
$('#ConfirmPswd').keyup(function () {
    var pwdorg=$('#SysUserPswd').val();
    if(this.value!=pwdorg){
        $("#ConfirmPswd-error").css("display","block");
        $("#ConfirmPswd-error").html("Password Not Matching!");
        $("#changePasswordSubmit").attr("disabled",true);
    }
    else{
        $("#ConfirmPswd-error").html("");
        if($("#changePasswordForm1").valid()==true){
            $("#changePasswordSubmit").attr("disabled",false);

        }else{
            $("#changePasswordSubmit").attr("disabled",true);

        }

    }
 });
function resetPwdDiv()
{
    $("#changePasswordForm1")[0].reset();
    $(".help-block").hide();
    $("#pwdresetForm").toggleClass("d-none");
    $("#passwordErrs").html("");

}
  $( ".restPwdClass" ).on( "click", function() {
    $("#LogContent").toggleClass("d-none");
    $("#pwdresetForm").removeClass("d-none");
  });
  $( "#CancelSubmit" ).on( "click", function() {
    $("#changePasswordForm1")[0].reset();
    $(".help-block").hide();
    $("#pwdresetForm").toggleClass("d-none");
    $("#passwordErrs").html("");
  });

  
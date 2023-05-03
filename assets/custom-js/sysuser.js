
tabx = "Craysol pgx : General / Craysol Users";
IdField = "SysUserID";
pageTable ="SysUserTable";
ajaxUrl ="SysUserAjaxList";
formModalBox  = "SysUserModal";	
formModalBox1  = "changePasswordModal";	
addEditForm = "SysUserForm";
addUrl = "addSysUser";	
detailUrl = "SysUserDetails";
updateUrl = "updateSysUser"; 
delUrl = "delSysUser";

function delSysUser(id){
    delData = {SysUserID:id};
  handleDelete(delData,delUrl);
}


$('#Status').change(function() {  
    somethingChanged = true; 
    $("#SysUserSubmit").attr("disabled", false);
    var val=0;

    if ($('#Status').is(':checked')) {
        val=1;
        
        $('#Status').attr("checked","checked");
        $("#Status").attr("value",val);
    } else {
        
        $('#Status').removeAttr("checked");
        $("#Status").attr("value",val);								
    }
});
$('#PasswordChangeFlg').change(function() {  
    somethingChanged = true; 
    $("#SysUserSubmit").attr("disabled", false);
    var val=0;

    if ($('#PasswordChangeFlg').is(':checked')) {
        val=1;
        
        $('#PasswordChangeFlg').attr("checked","checked");
        $("#PasswordChangeFlg").attr("value",val);
    } else {
        
        $('#PasswordChangeFlg').removeAttr("checked");
        $("#PasswordChangeFlg").attr("value",val);								
    }
});  

    function editSysUser(SysUserID){
        $("#SysUserSubmit").attr("disabled", true);	
        $('#Statusdiv').show();
        $('#SysUserForm #SysUserID').remove();
        $('#UserPswdDiv').hide();
        $("#CnfrmLoginPswdDiv").hide();
        $(".new_login").hide();
        somethingChanged = false;
        $('#'+addEditForm)[0].reset();
        $("#SysUserForm #SysUserPswd1").removeClass("text_field");
        $("#SysUserForm #ConfirmPswd").removeClass("text_field");
        $("#SysUserForm #SysUserPswd1").attr("data-id","1");
        $(".help-block").hide();
        $.ajax({
            type: 'POST',
            url: BASE_URL+detailUrl,
            data: {SysUserID:SysUserID},
            dataType: "json",
            success: function(resultData) { 
        
                if (resultData){
                    $("#"+formModalBox).modal("show");
                    datas = resultData.data;	
                    	
                    $('#SysUserName').val(datas.SysUserName);
                    $('#SysUserLoginID').val(datas.SysUserLoginID);
                    $('#UserRole').val(datas.UserRole);
                    $('#SysUserPswd').val(datas.SysUserPswd);
                    $("#Email").val(datas.Email);
                    $("#PhoneNumber").val(datas.PhoneNumber);
                    var val=0;
                    if(datas.Status==1){
                    $("#Status").attr("checked","checked");
                        val =1;
                    }
                    else{
                        $("#Status").removeAttr("checked");   
                    }
                    $("#Status").attr("value",val);
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'SysUserID',
                        name: 'SysUserID',
                        value: SysUserID,
                    }).appendTo('#'+addEditForm);
                    
                }
            },
            error : function(error) {                 
            }
        });
    }

function changePassword(SysUserID){
   $("#"+formModalBox1).modal("show");
   $("#changePasswordForm2 #SysUserID").remove();
	$(".help-block").hide();
	somethingChanged = false;
	$('#changePasswordForm2')[0].reset();
    $('<input>').attr({
        type: 'hidden',
        id: 'SysUserID',
        name: 'SysUserID',
        value: SysUserID,
    }).appendTo('#changePasswordForm2');
    var length = 8,
    charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
    retVal = "";
for (var i = 0, n = charset.length; i < length; ++i) {
    retVal += charset.charAt(Math.floor(Math.random() * n));
}
// document.forms['changePasswordForm2']['SysUserPswd'].value = retVal;
$("#changePasswordForm2 #SysUserPswd").val(retVal);
}

 
$.validator.addMethod("strong_password", function (value, element) {
    let password = value;
    if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&*])(.{6,12}$)/.test(password))) {
        return false;
    }
     return true;
}, function (value, element) {
    let password = $(element).val();
    // if (!(/^(.{6,12}$)/.test(password))) {
    //     return 'Password must be between 6 to 12 characters.';
    // } 
    // else if (!(/^(?=.*[0-9])/.test(password))) {
    //     return 'Password must contain at least one digit.';
    // }
    // else if (!(/^(?=.*[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~])/.test(password))) {
    //     return "Password must contain special characters.";
    // }
    // return false;
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
$(document).ready( function () {
    $("#CnfrmLoginPswdDiv").hide();
    
  $('#StatusFilter').on('change',function(){ 
        var filterObj={};   
        var StatusFilter = $("#StatusFilter").val();
        filterObj = {
            filter :{               
                "Status":StatusFilter
            }
        };  
        filterObj['searchColumn']=$('#TPFilterIDSrch').val();
        if(StatusFilter != ''){  
            loadDataTableWithFilter(pageTable ,columnstoShow,ajaxUrl,[0,-1,-2],filterObj);
            DataTableFieldAligns([2,6]);
        }     
        if($('#TPFilterIDSrch').val()=="null"){        
            $("#SysUserTable_filter").addClass("d-none");
        }else{
            $("#SysUserTable_filter").removeClass("d-none");
        }
    }); 

    $("#changePasswordForm2").submit(function(e){	
         e.preventDefault();			
        if($( "#changePasswordForm2").valid()){				
            var msgResponse = " Updation";
            var url = BASE_URL+"changePassword";
            var formData = $("#changePasswordForm2").serialize();
            handleUpdatePassword(url,formData,msgResponse);
        }
    });
    function handleUpdatePassword(url,formData,msgResponse,parent=false){
        if(parent == true){
            tabAlert = parentTab;
        }
        else{
            tabAlert = tabx;
        }
        $(".modalLoader").show();
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: "json",
            success: function(resultData) { 
                if(resultData.Status == "1"){
                    alertBox(resultData.Status,resultData.Message,tabAlert);
                    if(typeof(noTable) !== 'undefined') {					
                        formResetChangePasswordModalReload(parent,false);	
                    }
                    else{					
                        formResetChangePasswordandClose(parent);	
                    }
                }  
                else if(resultData.Status == "2" || resultData.Status == "3" || resultData.Status == 2 || resultData.Status == 3){
                    alertBox(resultData.Status,resultData.Message,tabAlert);
                    if(typeof(noTable) !== 'undefined') {					
                        formResetChangePasswordModalReload(parent,false);	
                    }
                    else{					
                        formResetChangePasswordModalReload(parent);	 
                    }
                } 
                else if(resultData.Status == "0" || resultData.Status == 0){	
                    
                    message = msgResponse+" Failed\n";
                    message += (typeof(resultData.Message) !== 'undefined')?"\n"+resultData.Message:'';
                    message += (typeof(resultData.Required) !== 'undefined')?"\n"+resultData.Required :'';
                    alertBox(resultData.Status,message,tabAlert);
                }
                else{			
                    $msgRes = msgResponse+" Failed\n";	
                    alertBox(resultData.Status,$msgRes,resultData.Page);
                        
                }
            },
            error : function(error) { 
                
            },
            complete : function(){
                $(".modalLoader").hide();
            }
        });
    }
    function formResetChangePasswordModalReload(parent=false,tableReload=true){
       if(parent){
            $("#"+parentForm)[0].reset();
            $("#"+parentFormModalBox).modal("hide");
        }
        else{
            $("#changePasswordForm2")[0].reset();
            $("#changePasswordModal").modal("hide");
            if(tableReload === true){
                $("#"+pageTable).DataTable().ajax.reload( null, false );
            }
            if(typeof(pageReload) != 'undefined' && pageReload == true){
                location.reload();
            }
        }
    }
    function formResetChangePasswordandClose(parent=false,tableReload=true){
        if(parent){
            $("#"+parentForm)[0].reset();
            $("#"+parentFormModalBox).modal("hide");
        }
        else{
            $("#changePasswordForm2")[0].reset();
            $("#changePasswordModal").modal("hide");
            if(tableReload === true){
                $("#"+pageTable).DataTable().ajax.reload( null, false );
            }
            if(typeof(pageReload) != 'undefined' && pageReload == true){
                location.reload();
            }
        }
    }
    $("#SysUserForm").validate({
        rules: {
            
            SysUserName: {required:true,noSpace:true},
            UserRole:{required:true,noSpace:true},
            SysUserLoginID: {required:true,blankSpace:true},
            Email: {required:true,emailVal:true},
            PhoneNumber: {required:true,minlength:10,maxlength:13},
            // SysUserPswd: {required:true,strong_password:true},
            // ConfirmPassword: {required:true,equalTo:"#SysUserPswd"},
            SysUserPswd:{required: {
                depends: function () {
                  if ($('#SysUserPswd1').attr('data-id')=='0') {
                    return true;
                  } else {
                    return false;
                  }
                },
              },strong_password:true
            },
        },
        messages: {
            
            SysUserName:"Name Is Required",
            UserRole:"User Role Required",
            SysUserLoginID:"Login ID Is Required",
            SysUserPswd:{required:"Enter Password"},
            Email: {required:"Enter Email"},
            PhoneNumber: {required:"Enter Phone Number",minlength:"Please enter atleast 10 or 13 numbers"},
            // ConfirmPassword: {required:"Enter Password",equalTo:"Password and Confirm Password must be same"}
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
    $("#changePasswordForm2").validate({
        rules: {
            SysUserPswd: {required:true},
			
        },
        messages: {
            SysUserPswd1:"Enter Password",
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
    columnstoShow =  ['SysUserID','SysUserName','UserRole','SysUserLoginID','Email','PhoneNumber','Actions','ExtraPadding'];	
    $('#SysUserPswd1').keyup(function () {
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
    $('#ConfirmPswd').keyup(function () {
        var pwdorg=$('#SysUserPswd1').val();
        if(this.value!=pwdorg){
            $("#ConfirmPswd-error").css("display","block");
            $("#ConfirmPswd-error").html("Password Not Matching!");
            $("#SysUserSubmit").attr("disabled",true);
        }
        else{
            $("#ConfirmPswd-error").html("");
            $("#SysUserSubmit").attr("disabled",false);

        }
     });
    $("#eye1").on("click",function(){
        if($(this).hasClass('fa-eye-slash')){
            $("#SysUserPswd1").attr('type','text');
        }else{
            $("#SysUserPswd1").attr('type','password');
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
  
  
    $('select#TPFilterID').on('change ',function(){         
        $("#FilterSearchDiv").show(); 
        filterObj={}; 
        var StatusFilter = $("#StatusFilter").val();
        filterObj = {
            filter :{
                "Status":StatusFilter,
                
            }
        }; 
  
        $('#'+pageTable).DataTable().destroy(); 
        loadDataTableWithFilter(pageTable ,columnstoShow,ajaxUrl,[0,-1,-2],filterObj); 
        DataTableFieldAligns([2,6]);

        // $("#addrto").show();
        TPFilterID = $("#TPFilterID").val();
        if (TPFilterID == "") {
            $("#addrto").hide();
                //start
            $("#FilterChild").addClass("d-none");
            $("#SysUserTable_filter").addClass("d-none");
                // $('#Warningalert').html('<div class="alert alert-danger warningToast alert-dismissible fade show" role="alert">Please Select a Country.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                //end
          
        } 
         else {
            $("#SysUserTable_filter").removeClass("d-none");
            // $('#Warningalert').html("");
            // $("#addrto").show();
            //start
            $("#FilterChild").removeClass("d-none");
            $("#SysUserTable_filter").addClass("d-none");
            DataTableFieldAligns([2,6]);
                //start if add button 8% else 5%
            $(".tableActionBtns").css("right","114px");
            //$(".tableActionBtns").css("right","12%");
            $("#TPFilterIDSrch").val("null");
            if($('#TPFilterIDSrch').val()=="null"){        
                $("#SysUserTable_filter").addClass("d-none");
            }else{
                $("#SysUserTable_filter").removeClass("d-none");
            }

            //end
        }
     }); 
    loadDataTable(pageTable ,columnstoShow,ajaxUrl,[0,-1,-2]);
    DataTableFieldAligns([2,6]); 
    
    $('#TPFilterIDSrch').on('change',function(){ 
        if($('#TPFilterIDSrch').val()=="null"){
        
            $("#SysUserTable_filter").addClass("d-none");
            //start if add button 8% else 5%
        $(".tableActionBtns").css("right","12%");
        //end
        }
        else{
            $("#SysUserTable_filter").removeClass("d-none");

            //start 
            $(".tableActionBtns").css("right","385px");
             //end
            filterObj={}; 
            var StatusFilter = $("#StatusFilter").val();
            filterObj = {
                filter :{               
                    "Status":StatusFilter
                }
            };  
            filterObj['searchColumn']=$('#TPFilterID').val();

            $('#'+pageTable).DataTable().destroy(); 
            loadDataTableWithFilter(pageTable ,columnstoShow,ajaxUrl,[0,-1,-2],filterObj); 
            DataTableFieldAligns([2,6]); 
            if($('#TPFilterIDSrch').val()=="null"){        
                $("#SysUserTable_filter").addClass("d-none");
            }else{
                $("#SysUserTable_filter").removeClass("d-none");
            }
        }
        
    });
  
    $('#SysUserSubmit').click(function(e){
    var filterObj={}; 
    if(($('#SysUserID').length)){            
    }else{
        $("#StatusFilter").val("1");        
    }
    var StatusFilter = $("#StatusFilter").val();
    filterObj = {
        filter :{               
            "Status":StatusFilter,
           
        }
    };  
    filterObj['searchColumn']=$('#columnFilter').val();  
    loadDataTableWithFilter(pageTable ,columnstoShow,ajaxUrl,[0,-1,-2],filterObj); 
    DataTableFieldAligns([2,6])
    $('#StatusFilter').val(StatusFilter);
    if($('#TPFilterIDSrch').val()=="null"){        
        $("#SysUserTable_filter").addClass("d-none");
    }else{
        $("#SysUserTable_filter").removeClass("d-none");
    }
});
    $('#'+addUrl).click(function(e){
       
            $("#SysUserSubmit").attr("disabled", true);
            $('#SysUserForm #SysUserID').remove();
            $(".help-block").hide();
            $('#Statusdiv').hide();   
            $('.new_login').show();   
            $("#CnfrmLoginPswdDiv").hide();
            $("#SysUserLoginID").show();
            $('#'+addEditForm+' input[name="PasswordChangeFlg"]').removeAttr("checked");
            $('#'+addEditForm)[0].reset();
            $('#'+formModalBox).modal("show");
            $("#SysUserForm #SysUserPswd1").addClass("text_field");	
            $("#SysUserForm #SysUserPswd1").attr("data-id","0");	
            

    });

	$('#'+addEditForm).on('keyup', '#SysUserName', function(ev){
        var d=0;if(ev.ctrlKey || ev.keyCode == 17){d++;if(ev.keyCode == 17){d=1;}}
		if(d!=1){

        var curpos=caretPosition($(this));
        var titleChar = toTitleCase($('#'+addEditForm+' input[name="SysUserName"]').val());  
        $('#'+addEditForm+' input[name="SysUserName"]').val(titleChar);
        $('#'+addEditForm+' input[name="SysUserName"]').selectRange(curpos);   
       
        } 
    });
    
	
    $("#btnModeClose").on("click", function (e) {
        e.preventDefault();
        $("#SysUserModal").modal("hide");
        $('#SysUserModal').data("modal", null);
    }); 
    $("#btnModeClose1").on("click", function (e) {
        e.preventDefault();
        $("#changePasswordModal").modal("hide");
        $('#changePasswordModal').data("modal", null);
    }); 
	

	$(function () {
		$("#SysUserName").keypress(function (e) {
			var keyCode = e.keyCode || e.which; 
			$("#lblError").html("");
			//Regex for Valid Characters i.e. Alphabets and Numbers.
			var regex = /^[A-Z,a-z,0-9 ]+$/;
			var isValid = regex.test(String.fromCharCode(keyCode));
			if (!isValid) {             
				$("#lblError").html("No special characters allowed.");
			}
	
			return isValid;
		});
	});
	
} );

function passwordshow() {
   
    var x = document.getElementById("SysUserPswd1");
    if (x.type === "password") {
        x.type = "text";
    } else {
      x.type = "password";
    }
  }
  function passwordshow1() {
   
    var x = document.getElementById("ConfirmPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
      x.type = "password";
    }
  }
$(document).ready( function () {
    $("#CnfrmLoginPswdDiv").hide();
    
    $("#SysUserTable_filter").addClass("d-none");
    $(".tableActionBtns").css("right","114px");
  
   });

   $('#PhoneNumber').on('keypress',function(e)
   {
   var PhoneNumber =  $('#PhoneNumber').val();
   if(PhoneNumber.length >=13)
   {
    return false;
   }
   });

   



   
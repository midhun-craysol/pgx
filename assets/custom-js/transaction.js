
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

$(document).ready( function () {
 
    $('#TransactionSubmit').click(function(e){
        alert('here');
    });
	
} );

function payNow(){
    var amount = 100;
    var url = 'https://razorpay.me/@craysoltechnologiesipvtltd';
    //alert(amount);
    $.ajax({
        type: 'POST',
        url: url,
        data: {Amount:amount},
        dataType: "json",
        success: function(resultData) { 
            if(resultData){
                console.log(resultData);
            }          
          
        },
        error : function(error) { 
            
        },
        complete : function(){
            $(".modalLoader").hide();
        }
    });
 }
 

   



   
tabx = "Craysol pgx : General / Transactions";
IdField = "PaymentID";
pageTable ="TransactionTable";
ajaxUrl ="transactionList";
formModalBox  = "transactionModal";	
addEditForm = "transactionForm";
addUrl = "addTransaction";	
delUrl = "delTransaction";
detailUrl = "TransactionDetails"; 
updateUrl = "updateTransaction";

function delTransaction(id){
    delData = {PaymentID:id};
  handleDelete(delData,delUrl);
}


$(document).ready( function () {
    columnstoShow =  ['PaymentID','TransactionID','RazorpayPaymentId','TotalAmount','Actions','ExtraPadding'];	
    loadDataTableWithFilter(pageTable ,columnstoShow,ajaxUrl,[0,-2,-1,3],{});
    DataTableFieldAligns([2,3]);

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
            loadDataTableWithFilter(pageTable ,columnstoShow,ajaxUrl,[0,-2,-1,3],filterObj);
            DataTableFieldAligns([2,3]);
        } 
        $('#TPFilterIDSrch').val()= "TransactionID";    
        // if($('#TPFilterIDSrch').val()==""){        
        //     $("#TransactionTable_filter").addClass("d-none");
        // }else{
        //     $("#TransactionTable_filter").removeClass("d-none");
        // }
    }); 

	
} );

$(".paylink").click(function(e){
    var totalAmount = $(this).attr("data-amount");
    $("#TransactionAmount").val(totalAmount);
    $('#SendLinkModal').modal('show');
});

0

$("#sendLinkForm").submit(function(e){		
    e.preventDefault();	
    alert('here');
    // var customerName = document.getElementById("CustomerName").value;
    // var contactNo = document.getElementById("CustomerNumber").value;
    // var email = document.getElementById("CustomerEmail").value;
    // var transactionAmt = document.getElementById("TransactionAmount").value;
    //https://api.razorpay.com/v1/payment_links
    // https://dashboard.razorpay.com/app/paymentlinks/new

       
    //--------------------------------------------------------------------
    // $.ajax({
    //     type: 'POST',
    //     url: "https://dashboard.razorpay.com/app/paymentlinks/new",
    //     data: {},
    //     dataType: "json",
    //     success: function(resultData) {  
    //         console.log(resultData);				
    //         // if(resultData.Status == "1"){ 
    //         //     setSession(resultData);
    //         // } else { 
    //         //     document.getElementById("err3").innerHTML = "Invalid UserName/Password"; 
    //         // }
    //     },
    //     error : function(error) { 
            
    //     }
    // });	
    //------------------------------------------------



    // var paylink = {
    //     // "key": "rzp_test_f0Naiu31auHzo1",
    //     "accept_partial": true,
    //     "amount": 1000,
    //     "amount_paid": transactionAmt,
    //     "callback_method": "get",
    //     "callback_url": "https://example-callback-url.com/",
    //     "cancelled_at": 1591097270,
    //     "created_at": 1591097057,
    //     "currency": "INR",
    //     "customer": {
    //         "contact": contactNo,
    //         "email": email,
    //         "name": customerName
    //     },
    //     "description": "Payment for policy no #23456",
    //     "expire_by": 1691097057,
    //     "expired_at": 0,
    //     "first_min_partial_amount": 100,
    //     "id": "plink_Lnu3d8ZPEWKaPv",
    //     "notes": {
    //         "policy_name": "Jeevan Bima"
    //     },
    //     "notify": {
    //         "email": true,
    //         "sms": true
    //     },
    //     "payments": [],
    //     "reference_id": "TS1989",
    //     "reminder_enable": true,
    //     "reminders": {
    //         "status": "failed"
    //     },
    //     "short_url": "https://rzp.io/i/nxrHnLJ",
    //     "status": "cancelled",
    //     "updated_at": 1591097270,
    //     "user_id": ""
    // };
    // var rzp1 = new Razorpay(paylink);



    // lblNameError lblCustomerNumberError lblCustomerEmailError 
    // var api = 'erpx666';
    // if(uname=="")
    // {
    //     document.getElementById("lblNameError").innerHTML = "Please enter user name";
    // }
    // else{
    //     var msg1="OK";
    //     document.getElementById("lblNameError").innerHTML = " ";
    // }
    // if(pwdusr=="")
    // {
    //     document.getElementById("err2").innerHTML = "Please enter password";

    // }
    // else
    // {
    //     var msg2="OK";
    //     document.getElementById("err2").innerHTML = " ";
    // }
    //  if(msg1=="OK" && msg2=="OK")
    //  {
        // document.getElementById("err3").innerHTML = " ";
    
    // var formData = $("#loginForm").serialize();
    // $.ajax({
    //     type: 'POST',
    //     url: "http://localhost/erpx/Api_extUserLogin",
    //     data: {UserName:uname, UserPassword:pwdusr},
    //     dataType: "json",
    //     success: function(resultData) {  				
    //         if(resultData.Status == "1"){ 
    //             setSession(resultData);
    //         } else { 
    //             document.getElementById("err3").innerHTML = "Invalid UserName/Password"; 
    //         }
    //     },
    //     error : function(error) { 
            
    //     }
    // });			
// }	
});


              
          


   



   
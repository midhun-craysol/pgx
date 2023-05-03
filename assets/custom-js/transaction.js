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

// function payNow(amount){
//     // alert(amount);
//     // var amount = 100;
//     var url = 'https://razorpay.me/@craysoltechnologiesipvtltd';
    
//     //alert(amount);
//     $.ajax({
//         type: 'POST',
//         url: url,
//         data: {Amount:amount},
//         dataType: "json",
//         success: function(resultData) { 
//             if(resultData){
//                 console.log(resultData);
//             }          
          
//         },
//         error : function(error) { 
            
//         },
//         complete : function(){
//             $(".modalLoader").hide();
//         }
//     });
//  }
 

   



   
$( document ).ready(function() 
{ 
    function blink_text() {
        $('.blink').fadeOut(500);
        $('.blink').fadeIn(500);
    }
    setInterval(blink_text, 1000); 
    //userOfficeList();
    // if($('#paymentGateway').length){
    //     loadPayGs();  
    // }   
   
});
function loadPayGs(){
    $.ajax({
        type: 'POST',
        url: BASE_URL+'loadPaygateByOffice',
        data: {yes:1},
        dataType: "json",
        success: function(resultData) { 
            if(resultData.Status == "1"){
                var des=resultData.data;
                $('#paymentGateway').empty();
                let appentcontent="";
                appentcontent="<option value=''>Select Payment Gateway</option>";
                    $.each(des, function (i) { 
                        appentcontent =appentcontent+"<option value='"+des[i]['PayGateID']+"' >"+des[i]['PaymentGatewayName']+"</option>";
                    });                     
                $('#paymentGateway').append(appentcontent);  
            }
        },
        error : function(error) { 
            console.log(error);
        }
    });
}
function userOfficeList(){ 
    var url = BASE_URL+"userOfficeList";   
    $('#CompanyOfficeID').empty();
    $.ajax({
        type: 'POST',
        url: url,
        data: {},
        dataType: "json",
        success: function(resultData) {
            if(resultData.Status == "1"){
                var des=resultData.data; 
                let appentcontent="";
                $('#CompanyOfficeID').empty();
                appentcontent="<option value=''>Select Office</option>";
                    $.each(des, function (i) {
                        var sel="";
                        
                        appentcontent =appentcontent+"<option value='"+des[i]['CompanyOfficeID']+"'"+sel+">"+des[i]['CompanyOfficeName']+"</option>"
                    });                     
                $('#CompanyOfficeID').append(appentcontent);
                    
            }
            else{
                
                let appentcontent="";
                appentcontent="<option value=''>Please Link</option>";
                $('#CompanyOfficeID').append(appentcontent);
                $('#officeToast span').text('Please Link an Office');
            }
        },
        error : function(error) { 
            console.log(error);
        }
    });

        
}
    $('#CompanyOfficeID').click(function() 
    {    
        // $("#offSpan").removeClass("blink");  
    });
    $('#CompanyOfficeID').blur(function() 
    {    
        // $("#offSpan").addClass("blink");  
    });
    $('#CompanyOfficeID').change(function() 
    {   
        var CompanyOfficeID = document.querySelector("#CompanyOfficeID");
        var CompanyOfficeName = CompanyOfficeID.options[CompanyOfficeID.selectedIndex].getAttribute('data-name');
        var CompanyOfficeID = $(this).val(); 
        // var CompanyOfficeName = $(this).attr('data-name');
        //alert(CompanyOfficeName); 
        if(CompanyOfficeID=="") { 
                $(".submenuBar").hide();
                $("#siteTitle").hide();
                $("#sitePage").hide();
                $("#officeToast").show();
        }
        else{  
                $("#siteTitle").show();
                $("#sitePage").show();
                $(".submenuBar").show();
                $("#officeToast").hide();  

        }
        var url = BASE_URL+"setOfficeSession";   
        $('#CompanyOfficeID').empty();
        $.ajax({
            type: 'POST',
            url: url,
            data: {CompanyOfficeID:CompanyOfficeID,CompanyOfficeName:CompanyOfficeName},
            dataType: "text",
            success: function(resultData) { 
                location.reload();  
            },
            error : function(error) { 
                console.log(error);
            }
        });
        $.ajax({
            type: 'POST',
            url: BASE_URL+'getProductLists',
            data: {userOfficeLinkID:userOfficeLinkID},
            dataType: "json",
            success: function(resultData) { 
                if(resultData.Status == "1"){
                    var des=resultData.data;
                    $('#paymentGateway').empty();
                    let appentcontent="";
                    appentcontent="<option value=''>Select Payment Gateway</option>";
                        $.each(des, function (i) { 
                            appentcontent =appentcontent+"<option value='"+des[i]['PayGateID']+"' >"+des[i]['PaymentGatewayName']+"</option>";
                        });                     
                    $('#paymentGateway').append(appentcontent); 
                    $('#paymentAddForm').show(); 
                }
            },
            error : function(error) { 
                console.log(error);
            }
        });
    
    });


    $('#paymentGateway').change(function() 
    { 
        
        var PayGateID = $(this).val(); 
        var PaymentGatewayName = paymentGateway.options[paymentGateway.selectedIndex].getAttribute('data-name');
        if(PayGateID=="") { 
            $(".pgy").show(); 
        }
        else{  
            $(".pgy").hide();  
            var url = BASE_URL+"setPayGateSession";   
            $('#CompanyOfficeID').empty();
            $.ajax({
                type: 'POST',
                url: url,
                data: {PayGateID:PayGateID,PaymentGatewayName:PaymentGatewayName},
                dataType: "text",
                success: function(resultData) {                   
                    location.reload();      
                },
                error : function(error) { 
                    console.log(error);
                }
            });
        }

    });
   
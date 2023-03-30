$( document ).ready(function() 
{ 
    function blink_text() {
        $('.blink').fadeOut(500);
        $('.blink').fadeIn(500);
    }
    setInterval(blink_text, 1000); 
    userOfficeList();
    if($('#paymentGateway').length){
        loadPayGs();  
    }   
   
});
function loadPayGs(){
    $.ajax({
        type: 'POST',
        url: BASEURL+'loadPaygateByOffice',
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
    var url = BASEURL+"userOfficeList";   
    $('#userOfficeLink').empty();
    $.ajax({
        type: 'POST',
        url: url,
        data: {},
        dataType: "json",
        success: function(resultData) {
            if(resultData.Status == "1"){
                var des=resultData.data; 
                let appentcontent="";
                $('#userOfficeLink').empty();
                appentcontent="<option value=''>Select Office</option>";
                    $.each(des, function (i) {
                        var sel="";
                        
                        appentcontent =appentcontent+"<option value='"+des[i]['CompanyOfficeID']+"'"+sel+">"+des[i]['CompanyOfficeName']+"</option>"
                    });                     
                $('#userOfficeLink').append(appentcontent);
                    
            }
            else{
                
                let appentcontent="";
                appentcontent="<option value=''>Please Link</option>";
                $('#userOfficeLink').append(appentcontent);
                $('#officeToast span').text('Please Link an Office');
            }
        },
        error : function(error) { 
            console.log(error);
        }
    });

        
}
    $('#userOfficeLink').click(function() 
    {    
        // $("#offSpan").removeClass("blink");  
    });
    $('#userOfficeLink').blur(function() 
    {    
        // $("#offSpan").addClass("blink");  
    });
    $('#userOfficeLink').change(function() 
    {   
        var userOfficeLinkID = $(this).val(); 
        if(userOfficeLinkID=="") { 
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
        var url = BASEURL+"setOfficeSession";   
        $('#userOfficeLink').empty();
        $.ajax({
            type: 'POST',
            url: url,
            data: {userOfficeLinkID:userOfficeLinkID},
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
            url: BASEURL+'getProductLists',
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
        if(PayGateID=="") { 
            $(".pgy").show(); 
        }
        else{  
            $(".pgy").hide();  
            var url = BASEURL+"setPayGateSession";   
            $('#userOfficeLink').empty();
            $.ajax({
                type: 'POST',
                url: url,
                data: {PayGateID:PayGateID},
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
   
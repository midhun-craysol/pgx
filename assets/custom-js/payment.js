$( document ).ready(function() { 
        $.ajax({
            type: 'POST',
            url: BASEURL+'getProductLists',
            data: {Yes:1},
            dataType: "json",
            success: function(resultData) { 
                if(resultData.Status == "1"){
                    var des=resultData.data;
                    $('#paymentGateway').empty();
                    let appentcontent="";
                    appentcontent="<option value=''>Select Payment Gateway</option>";
                        $.each(des, function (i) { 
                            appentcontent =appentcontent+"<option value='"+des[i]['ProductID']+"' >"+des[i]['ProductName']+"</option>";
                        });                     
                    $('#paymentGateway').append(appentcontent);  
                }
            },
            error : function(error) { 
                console.log(error);
            }
        }); 
});
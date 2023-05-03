  
 var addEditForm ="loginForm";

 function myFunction() {
	var x = document.getElementById("UserPassword");
	if (x.type === "password") {
	  x.type = "text";
	} else {
	  x.type = "password";
	}
  } 

$(document).ready(function(){ 
	$("#log-next").click(function(e){ 
		if(($('#Username').length)&&($('#loginForm input[name="Username"]').val() !='')&&($('#loginForm input[name="code"]').val() !='')){			
			var Username = $('#loginForm input[name="Username"]').val();
			var code = $('#loginForm input[name="code"]').val();
			$.ajax({
					type: 'POST',
					url: BASE_URL+"verifyUser",
					data: {Username:Username,code:code},
					dataType: "json",
					success: function(resultData) { 
						if(resultData.Status == "1") {
							$("#step2").show();							
							$("#step1").hide();							
						} else { 
						}
					},
					error : function(error) { 
						
					}
				});
		}
	});


    $("#loginForm").submit(function(e){		
		e.preventDefault();	
		var uname = document.getElementById("UserName").value;
		var pwdusr = document.getElementById("UserPassword").value;
		var api = 'erpx666';
		if(uname=="")
		{
			document.getElementById("err1").innerHTML = "Please enter user name";
		}
		else{
			var msg1="OK";
			document.getElementById("err1").innerHTML = " ";
	    }
		if(pwdusr=="")
		{
			document.getElementById("err2").innerHTML = "Please enter password";

		}
		else
		{
			var msg2="OK";
			document.getElementById("err2").innerHTML = " ";
		}
         if(msg1=="OK" && msg2=="OK")
		 {
		    document.getElementById("err3").innerHTML = " ";
		
		var formData = $("#loginForm").serialize();
		$.ajax({
			type: 'POST',
			url: "http://localhost/erpx/Api_extUserLogin",
			data: {UserName:uname, UserPassword:pwdusr, ApiKey:api},
			dataType: "json",
			success: function(resultData) {  				
				if(resultData.Status == "1"){ 
					setSession(resultData);
				} else { 
					document.getElementById("err3").innerHTML = "Invalid UserName/Password"; 
				}
			},
			error : function(error) { 
				
			}
		});			
	}	
	});
});
 function setSession(resultData){
	$.ajax({
		type: 'POST',
		url: BASE_URL+"setSession",
		data: {resultData:resultData},
		dataType: "json",
		success: function(resultData1) { 		
			
			if(resultData1 == "1"){ 
				window.location = BASE_URL+'';	
			} 
		},
		error : function(error) { 
			
		}
	});	
 }
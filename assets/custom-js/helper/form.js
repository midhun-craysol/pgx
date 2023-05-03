var transalateText = "";
$.validator.addMethod("blankSpace", function(value, element) {
	if(value.substring(0,1)!=" " && value.substr(-1)!=" "){
		return value.trim() != "" && value != ""; 
	}
}, "No white space please");

$.validator.addMethod("emailVal", function(value, element) {
	var mailformat = (/^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i);			
	if(value.match(mailformat)){			
		return value;
	}
}, "Please enter a valid email address.");

$(document).ready(function(){
	$(".close").on("click",function(){
		$(this).closest(".modal").modal('hide');
	});
	$(".phonenumbervalidation").on("keypress",function(evt){
		if($(this).val().length>12){
			return false;
		}
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    });
	$('body').keydown(function(e){
		if(e.which==27){
			$('input').blur();
			$('select').blur();
			$('th').blur();
			$('button').blur();
			$('li a').blur();
		}
	});


	$.validator.addMethod("nospace", function(value, element) {
		return /^[a-zA-Z0-9_.-]+$/.test(value);
	}, "No white space please");
	if(addEditForm!=""){
		$("#"+addEditForm).submit(function(e){		
			// console.log("______here2");		
			e.preventDefault();			
			if($("#"+addEditForm ).valid()){		
				// console.log("______here 1");			
				var msgResponse = " Creation";
				var url = BASE_URL+addUrl;
				//Changing base Url if the case is edited.
				if(($('#'+IdField).length)&&($('#'+addEditForm+' input[name="'+IdField+'"]').val()) && ($('#'+addEditForm+' input[name="'+IdField+'"]').val() !='')){			
					url = BASE_URL+updateUrl;						
					msgResponse = " Updation";					
				}
				var formData = $("#"+addEditForm).serialize();	
				handleCreateEdit(url,formData,msgResponse);
			}
		});
	} 
	if(addEditForm!=""){
		$("#"+addEditForm +" .text_field").on("keyup change", function(){
			$("#"+addEditForm+" :submit").attr("disabled", false); 
			var count=0;
			
			$("#"+addEditForm +" .text_field").each(function(){ 
				if($(this).val()==""){
					count=1; 			
				}		
			});
			if(count==0){
				if($("#"+addEditForm ).valid()===true){
					$("#"+addEditForm+" :submit").attr("disabled", false); 
				}else{
					$("#"+addEditForm+" :submit").attr("disabled", true);
				}			
			}else{
				$("#"+addEditForm+" :submit").attr("disabled", true);
			}
		});

	}

	



	}); 
	
	
  	$(".required_input").on("keyup", function(){
	  	$("#"+addEditForm+" :submit").attr("disabled", false); 
	  	if($("#"+addEditForm).valid()===true){
			$(".required_input").each(function(){     
				if($(this).val()==""){
					$("#"+addEditForm+" :submit").attr("disabled", true); 					
				}
			});
		}else{
			$("#"+addEditForm+" :submit").attr("disabled", true); 
			
		}
  	});

  $(".required_select").on("change", function(){
	  $("#"+addEditForm+" :submit").attr("disabled", false); 
	  $(".required_select").each(function(){     
		 if($(this).val()==""){
		  $("#"+addEditForm+" :submit").attr("disabled", true); 
		 }
		//  else{
		// 	$("#"+addEditForm+" :submit").attr("disabled", false); 
		//  }		
	  });
  });
 
$(".valAlphaX").keypress(function (e) {
	var keyCode = e.keyCode || e.which; 
	$("#lblError").html("");
	//Regex for Valid Characters i.e. Alphabets and Numbers.
	var regex = /^[A-Z, ,.,a-z]+$/;
	var isValid = regex.test(String.fromCharCode(keyCode));
	if (!isValid) {             
		$("#lblError").html("Only Alphabets  allowed.");
	}

	return isValid;
});

$(".valNumber").keypress(function (e) {
	var keyCode = e.keyCode || e.which; 
	$("#lblError").html("");
	//Regex for Valid Characters i.e. Alphabets and Numbers.
	var regex = /^[0-9, ,.]+$/;
	var isValid = regex.test(String.fromCharCode(keyCode));
	if (!isValid) {             
		$("#lblError").html("Only Alphabets  allowed.");
	}

	return isValid;
});

$(".valAlpNum").keypress(function (e) {
	var keyCode = e.keyCode || e.which; 
	$("#lblError").html("");
	//Regex for Valid Characters i.e. Alphabets and Numbers.
	var regex = /^[0-9,a-z,A-Z, ,.,@]+$/;
	var isValid = regex.test(String.fromCharCode(keyCode));
	if (!isValid) {             
		$("#lblError").html("Only Alphabets  allowed.");
	}

	return isValid;
});

function caretPosition(input) {
	var start = input[0].selectionStart,
		end = input[0].selectionEnd,
		diff = end - start;
	if (start >= 0 && start == end) {
		return start;
	} else if (start >= 0) {
  return start;
	}
}
function inputcheckcopy(fldnames) {	
	fieldx = fldnames.join(","); 
	$(fieldx).on('keyup',fieldx, function(ev){
		var d=0;if(ev.ctrlKey || ev.keyCode == 17){d++;if(ev.keyCode == 17){d=1;}}
		if(d!=1){

			var curpos=caretPosition($(this));
			var titleChar = toTitleCase($(this).val());         
			$(this).val(titleChar);
			$(this).selectRange(curpos); 
		}
	});
}

jQuery.validator.addMethod("noSpace", function(value, element) { 
	return value.trim() != "" && value != ""; 
  }, "Field Required Please don't leave it empty");

 

$.validator.addMethod("nospace", function(value, element) {
	return /^[a-zA-Z0-9_.-]+$/.test(value);
}, "No white space please");
/*
* Alert Box - sucess
*
*/
function alertBox(Status,Message,Page=""){

	var titleStr = "Alert : "+Page;
	var imgStr = "";
	var altStr="";
	if(Status==-1) {
		imgStr = ASSETS_URL+'/images/alert-icons/infoAlert.png';
		altStr = 'Info'; //operation can't delete
	}
	if(Status==0) {
		imgStr = ASSETS_URL+'/images/alert-icons/FailAlert.png';
		altStr = 'FailAlert'; //operation perform fail
	}
	if(Status==1) {
		imgStr = ASSETS_URL+'/images/alert-icons/SucessAlert.png';
		altStr = 'Success'; //operation perform sucess
	}
	if(Status==2) {
		imgStr = ASSETS_URL+'/images/alert-icons/WarningAlert.png';
		altStr = 'Duplicate Entry';  // Operation 
	}
	if(Status==3) {
		imgStr = ASSETS_URL+'/images/alert-icons/FailAlert.png';
		altStr = 'FailAlert';
		Message += " - Invalid user type";
	}
	if(Status==4) {
		imgStr = ASSETS_URL+'/images/alert-icons/WarningAlert.png';
		altStr = 'Warning'; //Server not found
		Message = "Server Not Found Error:404";
	}
	var box = bootbox.alert({	
		title: titleStr,
		backdrop : true,
		message: "<div class='row'><div class='col-sm-2'><img src='"+imgStr+"' alt='"+altStr+"' width='50' height='50'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b>"+Message+"</b></div></span>"+"</div></div>"
		
	});
}
function addHFieldToForm(formName,fldName,fldValue){	
	$('<input>').attr({
		type: 'hidden',
		id: fldName,
		name: fldName,
		value: fldValue,
	}).appendTo('#'+formName);
}

function showSubTblBody(targetID){
	$("#exapandStruct"+targetID).toggleClass('exapandStruct');
	$("#exapandStruct"+targetID).toggleClass('expanded_div');
    var timestamp = Number(new Date()); 
    $('#exapandStruct'+targetID).attr('data-id',timestamp);
    $('table.dataTable tbody td:first-child').attr("style","vertical-align:top !important;");
    $('table.dataTable tbody td:nth-last-child(2)').attr("style","vertical-align:top !important;");
    $('table.dataTable tbody td:nth-last-child(3)').attr("style","vertical-align:top !important;");
    $('table.dataTable tbody td:nth-last-child(4)').attr("style","vertical-align:top !important;");
    $('table.dataTable tbody td:nth-last-child(5)').attr("style","vertical-align:top !important;");
  
    if($('.expanded_div').length>2){    
        var id= parseInt($("#exapandStruct"+targetID).attr("data-id"));     
        var getid="";
        $('.expanded_div').each(function(i){
            var removeid=parseInt($(this).attr("data-id"));
            if(id>=removeid){
                id=removeid;
                getid=$(this).attr("id");                
            }          
        });
        $("#"+getid).toggle();
        $("#"+getid).toggleClass('exapandStruct');
        $("#"+getid).toggleClass('expanded_div');
    }
}

function fillValuesForEdit(formName,dataToFill ,selctFillFlag =false){
	$("form#"+formName+" :input").each(function(){
		var input = $(this); 
		var inputIndex = input.attr("name"); 
		$(this).val(dataToFill[inputIndex]);
	});
	$("form#"+formName+" textarea").each(function(){
		var input = $(this); 
		var inputIndex = input.attr("name");
		$(this).val(dataToFill[inputIndex]);
	});
	if(selctFillFlag){
		$("form#"+formName+" select").each(function(){
			var selectID = $(this).attr("id"); 
			$('#'+selectID+' option').removeAttr("selected");
			$('#'+selectID+' option[value=\''+dataToFill[selectID]+'\']').attr("selected","selected");
		});
	}
}
function fillValuesForEditNew(formName,dataToFill ,selctFillFlag =false){
	
	$("form#"+formName+" :input[type = text]").each(function(){
		var input = $(this); 
		var inputIndex = input.attr("name");
		if((dataToFill[inputIndex] !='') && $(this).type != 'radio'){
			$(this).val(dataToFill[inputIndex]);
		}
		
	});
	$("form#"+formName+" :input[type = number]").each(function(){
		var input = $(this); 
		var inputIndex = input.attr("name");
		if((dataToFill[inputIndex] !='') && $(this).type != 'radio'){
			$(this).val(dataToFill[inputIndex]);
		}
		
	});
	$("form#"+formName+" textarea").each(function(){
		var input = $(this); 
		var inputIndex = input.attr("name");
		if((dataToFill[inputIndex] !='')){
			$(this).val(dataToFill[inputIndex]);
		}
	});
	if(selctFillFlag){
		$("form#"+formName+" select").each(function(){
			var selName = $(this).attr("name");	tabx
			
		if((dataToFill[selName] !='')){
			$('#'+formName+' select[name="'+selName+'"] option').removeAttr("selected");
			$('#'+formName+' select[name="'+selName+'"] option[value=\''+dataToFill[selName]+'\']').attr("selected","selected");
		}
		});
	}
}
function fillTextsForEdit(formName,dataToFill){
	$("form#"+formName+" :input").each(function(){
		var input = $(this); 
		var inputIndex = input.attr("name");
		$(this).val(dataToFill[inputIndex]);
	});
}
function bootboxAlert(MessageText){
	      var titleStr = "Alert : PGX";
          var altStr = 'Info';
          var imgStr = ASSETS_URL+'images/alert-icons/infoAlert.png';
          var MessageData ="<div class='row'><div class='col-sm-2'><img src='"+imgStr+"' alt='"+altStr+"' width='50' height='50'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b> "+MessageText+"</b></div></span>"+"</div></div>";
          bootbox.alert(MessageData);
}

function closeRequest(id){
	delUrl="delPermntAct";
	delData = {GovActReqID:id};
	var titleStr = "Alert :" +tabx;
	var MessageText = "Do you want to Close Request?";
	var altStr = 'Info';
	var imgStr = ASSETS_URL+'/images/alert-icons/DeleteAlert.png';
	var MessageData ="<div class='row'><div class='col-sm-2'><img src='"+imgStr+"' alt='"+altStr+"' width='30' height='30'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b>"+MessageText+"</b></div></span>"+"</div></div>";
	bootbox.confirm({
		title: titleStr,
    	message: MessageData,
		buttons: {
			confirm: {
				label: 'Yes', 
			},
			cancel: {
				label: 'No',
			}
		},
		callback: function (result) {
			if(result==true) {
				$.ajax({
					type: 'POST',
					url: BASE_URL+delUrl,
					data: delData,
					dataType: "json",
					success: function(resultData) { 
						if(resultData.Status == 1){
							alertBox(resultData.Status,"Successfully Closed",tabx);
							$('#'+pageTable).DataTable().ajax.reload( null, false );
						}
						else{
							alertBox(resultData.Status,"Failed To Close",tabx);
							$('#'+pageTable).DataTable().ajax.reload( null, false );
						}
 
					},
					error : function(error) { 
						
					}
				});
			}
		}
	});
	
}
function handleDelete(delData,delUrl){

	var titleStr = "Alert :"+" " +tabx;
	var MessageText = "Are you sure you want to delete?";
	var altStr = 'Info';
	var imgStr = 'assets/images/alert-icons/DeleteAlert.png';
	var MessageData ="<div class='row'><div class='col-sm-2'><img src='"+imgStr+"' alt='"+altStr+"' width='30' height='30'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b>"+MessageText+"</b></div></span>"+"</div></div>";
	//var MessageData ="<div style='padding: 10px;'><div><img src='"+imgStr+"' alt='"+altStr+"' width='50' height='50'><span style='padding:10px'><b>"+tabx+" : "+MessageText+"</b></span>"+"</div></div>";
	bootbox.confirm({
		title: titleStr,
    	message: MessageData,
		buttons: {
			confirm: {
				label: 'Yes', 
			},
			cancel: {
				label: 'No',
			}
		},
		callback: function (result) {
			if(result==true) {
				$.ajax({
					type: 'POST',
					url: BASE_URL+delUrl,
					data: delData,
					dataType: "json",
					success: function(resultData) { 
						if(addEditForm!='projectDistributorLinkForm' && addEditForm!='DealerLinkForm'){
							$(".dataTables_filter").addClass("d-none");
						}	

						if(resultData.Status == 1){
							alertBox(resultData.Status,resultData.Message,tabx);
							$('#'+pageTable).DataTable().ajax.reload( null, false );

							if(delData["IdFrExpand"]!== 'undefined'){
							setTimeout("expndAfterDele('"+delData["IdFrExpand"]+"')",500);
							}

						}
						else{
							alertBox(resultData.Status,resultData.Message,tabx);
						}
 
					},
					error : function(error) { 
						
					}
				});
			}
		}
	});
	
}

function expndAfterDele(tID){ 
    $("#"+tID).toggleClass();
}
function handleUnlink(delData,delUrl){
	var titleStr = "Alert :"+" " +tabx;
	var MessageText = "Do you want to unlink?";
	var altStr = 'Info';
	var imgStr = 'assets/images/alert-icons/DeleteAlert.png';
	var MessageData ="<div class='row'><div class='col-sm-2'><img src='"+imgStr+"' alt='"+altStr+"' width='30' height='30'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b>"+MessageText+"</b></div></span>"+"</div></div>";
	//var MessageData ="<div style='padding: 10px;'><div><img src='"+imgStr+"' alt='"+altStr+"' width='50' height='50'><span style='padding:10px'><b>"+tabx+" : "+MessageText+"</b></span>"+"</div></div>";
	bootbox.confirm({
		title: titleStr,
    	message: MessageData,
		buttons: {
			confirm: {
				label: 'Yes', 
			},
			cancel: {
				label: 'No',
			}
		},
		callback: function (result) {
			if(result==true) {
				$.ajax({
					type: 'POST',
					url: BASE_URL+delUrl,
					data: delData,
					dataType: "json",
					success: function(resultData) { 
						if(resultData.Status == 1){
							alertBox(resultData.Status,resultData.Message,tabx);
							$('#'+pageTable).DataTable().ajax.reload( null, false );
						}
						else{
							alertBox(resultData.Status,resultData.Message,tabx);
						}
 
					},
					error : function(error) { 
						
					}
				});
			}
		}
	});
	
}



function handleDelete2(delData,delUrl){
	var titleStr = "Alert :"+" " +tabx;
	var MessageText = "Are you sure you want to unlink?";
	var altStr = 'Info';
	var imgStr = 'assets/images/alert-icons/DeleteAlert.png';
	var MessageData ="<div class='row'><div class='col-sm-2'><img src='"+imgStr+"' alt='"+altStr+"' width='30' height='30'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b>"+MessageText+"</b></div></span>"+"</div></div>";
	bootbox.confirm({
		title: titleStr,
    	message: MessageData,
		buttons: {
			confirm: {
				label: 'Yes', 
			},
			cancel: {
				label: 'No',
			}
		},
		callback: function (result) {
			if(result==true) {
				$.ajax({
					type: 'POST',
					url: BASE_URL+delUrl,
					data: delData,
					dataType: "json",
					success: function(resultData) { 
						$(".dataTables_filter").addClass("d-none");

						if(resultData.Status == 1){
							alertBox(resultData.Status,resultData.Message,tabx);
							$('#'+pageTable).DataTable().ajax.reload( null, false );
							if(delData["IdFrExpand"]!== 'undefined'){
								setTimeout("expndAfterDele('"+delData["IdFrExpand"]+"')",500);
								}
						}
						else{
							alertBox(resultData.Status,resultData.Message,tabx);
						}
 
					},
					error : function(error) { 
						
					}
				});
			}
		}
	});
	
}


function handleDelete1(delData,delUrl1){
	var titleStr = "Alert : "+" " +tabx;
	var MessageText = "Are you sure you want to delete?";
	var altStr = 'Info';
	var imgStr = 'assets/images/alert-icons/DeleteAlert.png';
	var MessageData ="<div class='row'><div class='col-sm-2'><img src='"+imgStr+"' alt='"+altStr+"' width='30' height='30'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b> "+MessageText+"</b></div></span>"+"</div></div>";
	bootbox.confirm({
		title: titleStr,
    	message: MessageData,
		buttons: {
			confirm: {
				label: 'Yes', 
			},
			cancel: {
				label: 'No',
			}
		},
		callback: function (result) {
			if(result==true) {
				$.ajax({
					type: 'POST',
					url: BASE_URL+delUrl1,
					data: delData,
					dataType: "json",
					success: function(resultData) { 
						$(".dataTables_filter").addClass("d-none");

						if(resultData.Status == 1){
							alertBox(resultData.Status,resultData.Message,tabx);
							$('#'+pageTable).DataTable().ajax.reload( null, false );
						}
						else{
							alertBox(resultData.Status,resultData.Message,tabx);
						}

			
					},
					error : function(error) { 
						
					}
				});
			}
		}
	});
	
}
function handleCreateEdit(url,formData,msgResponse,parent=false){

	if(parent == true){
		tabAlert = parentTab;
	}
	else{
		tabAlert = " "+	tabx;
	}
	$(".modalLoader").show();
	$.ajax({
		type: 'POST',
		url: url,
		data: formData,
		dataType: "json",
		success: function(resultData) { 
			if(addEditForm!='projectDistributorLinkForm' && addEditForm!='DealerLinkForm' ){
				$(".dataTables_filter").addClass("d-none");
			}			 
			if(resultData.Status == "1"){
				alertBox(resultData.Status,resultData.Message,tabAlert);
				if(typeof(noTable) !== 'undefined') {					
					formResetModalReload(parent,false);	
				}
				else{					
					formResetModalReloadandClose(parent);	
				}

				   


			}  
			else if(resultData.Status == "2" || resultData.Status == "3" || resultData.Status == 2 || resultData.Status == 3){
				alertBox(resultData.Status,resultData.Message,tabAlert);
				if(typeof(noTable) !== 'undefined') {					
					formResetModalReload(parent,false);	
				}
				else{					
					formResetModalReload(parent);	 
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
function handleCreateEditCustom(url,formData,msgResponse,parent=false,customModal,customForm){
	if(parent == true){
		tabAlert = parentTab;
	}
	else{
		tabAlert = tabx1;
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
					customModalReload(customModal,customForm);	
				}
				else{					
					customModalReload(customModal,customForm);	
				}
			}  
			else if(resultData.Status == "2" || resultData.Status == "3" || resultData.Status == 2 || resultData.Status == 3){
				alertBox(resultData.Status,resultData.Message,tabAlert);
				if(typeof(noTable) !== 'undefined') {					
					customModalReload(customModal,customForm);	
				}
				else{					
					customModalReload(customModal,customForm);	 
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

function handleCreateEdit1(url,formData,msgResponse,parent=false){
	
	if(parent == true){
		tabAlert = parentTab;
	}
	else{
		tabAlert = tabx1;
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
					formResetModalReload1(parent,false);	
				}
				else{					
					formResetModalReload1(parent);	
				}
			}  
			else if(resultData.Status == "2" || resultData.Status == "3" || resultData.Status == 2 || resultData.Status == 3){
				alertBox(resultData.Status,resultData.Message,tabAlert);
				if(typeof(noTable) !== 'undefined') {					
					formResetModalReload1(parent,false);	
				}
				else{					
					formResetModalReload1(parent);	 
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
function handleEdit(url,id,handleSelect=true){
    somethingChanged = false;
	data = {};
	data[IdField] = id;	
	$.ajax({
		type: 'POST',
		url: BASE_URL+url,
		data: data,
		dataType: "json",
		success: function(resultData) { 
			if (resultData.data){				
 				$("#"+addEditForm+" button[type=submit]").attr("disabled", true);
				dataX = resultData.data;		
				$("#"+formModalBox).modal("show");						
				fillValuesForEdit(addEditForm,dataX,handleSelect);	
				addHFieldToForm(addEditForm,IdField,id);
			}
		},
		error : function(error) { 
			A
		}
	});
}



function formResetModalReload(parent=false,tableReload=true){
	if(parent){
		$("#"+parentForm)[0].reset();
		$("#"+parentFormModalBox).modal("hide");
	}
	else{
		// $("#"+addEditForm)[0].reset();
		// $("#"+formModalBox).modal("hide");
		if(tableReload === true){
			$("#"+pageTable).DataTable().ajax.reload( null, false );
		}
		if(typeof(pageReload) != 'undefined' && pageReload == true){
			location.reload();
		}
	}
}
function formResetModalReloadandClose(parent=false,tableReload=true){
	if(parent){
		$("#"+parentForm)[0].reset();
		$("#"+parentFormModalBox).modal("hide");
	}
	else{
		$("#"+addEditForm)[0].reset();
		$("#"+formModalBox).modal("hide");
		if(tableReload === true){
			$("#"+pageTable).DataTable().ajax.reload( null, false );
		}
		if(typeof(pageReload) != 'undefined' && pageReload == true){
			location.reload();
		}
	}
}
function formResetModalReload1(parent=false,tableReload=true){
	if(parent){
		$("#"+parentForm)[0].reset();
		$("#"+parentFormModalBox).modal("hide");
	}
	else{
		$("#"+addEditForm1)[0].reset();
		$("#"+formModalBox1).modal("hide");
		if(tableReload === true){
			$("#"+pageTable).DataTable().ajax.reload( null, false );
		}
		if(typeof(pageReload) != 'undefined' && pageReload == true){
			location.reload();
		}
	}
}

function customModalReload(parent=false,tableReload=true){
	if(parent){
		$("#"+parentForm)[0].reset();
		$("#"+parentFormModalBox).modal("hide");
	}
	else{
		$("#"+customForm)[0].reset();
		$("#"+customModal).modal("hide");
		if(tableReload === true){
			$("#"+pageTable).DataTable().ajax.reload( null, false );
		}
		if(typeof(pageReload) != 'undefined' && pageReload == true){
			location.reload();
		}
	}
}
/*
*Fetch Trasalate Text from Db
*Created On 02-11-2021
*Param textInput
*return transalateText
*/
function cray_xlt_transalation(TextReference){
	var url = "\TransalationPluginLan";
	var UrlFullPath = BASE_URL+url;
	var TransalateText123 = ""
	if(TextReference!="") {
		$.ajax({
			type: 'POST',
			url: UrlFullPath,
			data: {TextReference:TextReference},
			dataType: "json",
			success: function(resultData) {
				if(resultData.data){
					TransalateText123 = resultData.data;
					transalateText = TransalateText123;
				} 
			},
			error : function(error) { 
				
			}
		}).responseText;
	}
}
/*
* FileUpload Using Jquery 
* params - id,fileObject
*/
function FileUpload() {

}

function handleCancel(cancelData,cancelUrl){
	var titleStr = "Alert :"+" " +tabx;
	var MessageText = "Are you sure you want to cancel this record?";
	var altStr = 'Info';
	var imgStr = 'assets/images/alert-icons/DeleteAlert.png';
	var MessageData ="<div class='row'><div class='col-sm-2'><img src='"+imgStr+"' alt='"+altStr+"' width='30' height='30'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b> "+MessageText+"</b></div></span>"+"</div></div>";
	//var MessageData ="<div style='padding: 10px;'><div><img src='"+imgStr+"' alt='"+altStr+"' width='50' height='50'><span style='padding:10px'><b>"+tabx+" : "+MessageText+"</b></span>"+"</div></div>";
	bootbox.confirm({
		title: titleStr,
    	message: MessageData,
		buttons: {
			confirm: {
				label: 'Yes', 
			},
			cancel: {
				label: 'No',
			}
		},
		callback: function (result) {
			if(result==true) {
				$.ajax({
					type: 'POST',
					url: BASE_URL+cancelUrl,
					data: cancelData,
					dataType: "json",
					success: function(resultData) { 
						if(resultData.Status == 1){	
							var Message = "Successfully Cancelled";
							alertBox(resultData.Status,Message,tabx);
							$('#'+pageTable).DataTable().ajax.reload( null, false ); 
						}
						else if (resultData.Status == -1){	 
							var Message ="In use , can't be deleted";
							alertBox(resultData.Status,Message,tabx);
						}
						else if (resultData.Status == 0){
							var Message = "Cancellation Failed";
							alertBox(resultData.Status,Message,tabx);
						}
						else{
							
							var Message = "Something went wrong";
							alertBox(resultData.Status,Message,tabx);

						}
					},
					error : function(error) { 
						
					}
				});
			}
		}
	});
	
}
function caretPosition(input) {
	var start = input[0].selectionStart,
		end = input[0].selectionEnd,
		diff = end - start;
	if (start >= 0 && start == end) {
		return start;
	} else if (start >= 0) {
  return start;
	}
}
function toTitleCase1(str) {
    str = str.toLowerCase().split(' ');
    for (var i = 0; i < str.length; i++) {
      str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
    }
    return str.join(' ');
  }
  function toTitleCase(str) {
	  return str.replace(/\w\S*/g, function(txt){
		  return txt.charAt(0).toUpperCase() + txt.slice(1);
	  });
}
function DateConvert(DateVal){
    var newDate = new Date(DateVal);
    return(newDate.getDate() + "-" + (newDate.getMonth() + 1) + "-" + newDate.getFullYear());
}
function DateTimeConvert(DateVal){
    var newDate = new Date(DateVal);
    return(newDate.toLocaleTimeString() + " " +newDate.getDate() + "-" + (newDate.getMonth() + 1) + "-" + newDate.getFullYear());
}

// jQuery.validator.addMethod("toTitleCase", function(value, element) { 
// 	return value.trim() != "" && value != ""; 
//   }, "Field Required Please don't leave it empty");




//   function toTitleCase(string) {
//   return string.charAt(0).toUpperCase() + string.slice(1);
// }
$.fn.selectRange = function(start, end) {
    if(end === undefined) {
        end = start;
    }
    return this.each(function() {
        if('selectionStart' in this) {
            this.selectionStart = start;
            this.selectionEnd = end;
        } else if(this.setSelectionRange) {
            this.setSelectionRange(start, end);
        } else if(this.createTextRange) {
            var range = this.createTextRange();
            range.collapse(true);
            range.moveEnd('character', end);
            range.moveStart('character', start);
            range.select();
        }
    });
};
 
function DataTableFieldAligns(fieldNos){
	// setTimeout(function(){
		$.each( fieldNos, function( i, val ) {
			$('table.dataTable thead tr th:nth-last-child('+val+')').css("text-align","center");
			$('table.dataTable tbody>tr>td:nth-last-child('+val+')').css({"text-align":"center"});
			
		  });
	//},300);
}

function PhoneNumberCheck(PhoneNumber) {
    var phoneVal = $('#' + PhoneNumber).val();
    $("#" + PhoneNumber).attr("minlength", "10").attr("maxlength", "13");
    $("#" + PhoneNumber).keypress(function (e) {
        var Charcounts = $('#' + PhoneNumber).val().length;
        this.value = this.value.replace(/[^0-9\.]/g, '');
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
        else {
            if (Charcounts >= 9 && Charcounts <= 12) {
                $("#" + PhoneNumber).removeAttr("required", "false");
            }
            else if (Charcounts < 9 || Charcounts > 12 ) {
                $("#" + PhoneNumber).attr("required", "true");
                $("#" + PhoneNumber).attr("minlength", "10").attr("maxlength", "13");
            }
            else {
                e.preventDefault();
            }
        }
    });
}
$.validator.addMethod('Url', function(value) {
	url = value.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g); 
	return(url);
}, 'Invalid URL');
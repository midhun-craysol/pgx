</main>
<div style="clear:both"></div> 
  <div class="fixed-footer" >
    <div class="container-fluid">
      <div class="row"> 
        <div class="col-sm-12 text-center">
          <span class="f-centered" style="font-size: 12px;">&nbsp; Copyright © 2023. <a href="#" target="_blank" class="nav-title">Craysol </a> All rights reserved.</span>
        </div> 
      </div>
    </div>            
  </div>     
 
<script src="<?php echo(ASSETS_URL); ?>bootstrap/js/bootstrap.bundle.min.js" ></script>
  <?php 
    if(!empty($scripts)){
    foreach ($scripts as $script) { ?>    
    <script type="text/javascript" src="<?php echo(BASE_URL."assets/custom-js/".$script.".js"); ?>" ></script>  
    <?php  
        }
      }
  ?>
<script src="<?php echo(ASSETS_URL); ?>bootstrap/js/bootstrap-select.min.js" ></script>
<script src="<?php echo(ASSETS_URL); ?>custom-js/password_change_user.js" ></script>

<script>
  var ASSETS_URL = "<?php echo(ASSETS_URL); ?>";
  $(".submenu .nav-link ").on("click",function(e){
  routeURL = $(this).attr("href"); 

  $(".fullWrapper").show();
  e.preventDefault();
  $.ajax({ 
          type: 'POST',
          data:{dAccess:"dashboard"},
          dataType:"html",
          url: BASE_URL+routeURL,
          success: function(resultData) {                          
            $("#mainContentArea").html(resultData);       
            var url= window.location.pathname; 
            var valuex = url.substring(url.lastIndexOf('/')+1); 
            $(".submenu .nav-link").removeClass("active");
            $(".submenu .nav-link").filter("[href='"+routeURL+"']").addClass("active");   

            $("#breadHome ").html(breadHome);
            $("#breadPage").html(breadPage);
          },
          error : function(error) { 
            console.log(error);
          },
          complete : function(){
            $(".fullWrapper").hide();
          }
        });
      
  });
  $(".valAlphaXs").keypress(function(e){
       var test = $(this).val();
       var val=$(this).attr("id");
       $("#lblError"+val).html("");
       var regex = new RegExp("^[a-zA-Z]+$ ");
       var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
       if (regex.test(str)) {
           $("#lblError"+val).html("");
           return true;
       }
       else
       {
       e.preventDefault();
       $(".specialchar_error").show();
       $("#lblError"+val).html('Only Alphabets allowed.');
       return false;
       }
   });
  function LogOut()
  {    
    var MessageData ="<div class='row'><div class='col-sm-2'><img src='"+ ASSETS_URL+"images/alert-icons/infoAlert.png' alt='Info' width='50' height='50'><span style='padding:10px'></div><div class='col-sm-10'><div style='padding-top:10px;'><b> Are you sure you want to logout?</b></div></span>"+"</div></div>";
  
    bootbox.confirm({
      title: "Alert : PGX",
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
          if(result ==true){ 
						window.location.href = BASE_URL+"logout";	
          }          
        }
      });

  }

  $(window).on('load', function(e){
    let cookieUrl = getCookie("routeURL");   
    if (cookieUrl != "" ) {
      if(cookieUrl=="'companyparam'"){
        routeURL=cookieUrl;
        $(".nav-link").filter("[href='ais140param']").removeClass("active statemenuclick");
        $(".nav-link").filter("[href='companyparam']").parent().parent().addClass("show");  
        $(".nav-link").filter("[href='companyparam']").addClass("active menuclick");
      }
      if(cookieUrl=="'ais140param'"){
        routeURL=cookieUrl;
        $(".nav-link").filter("[href='companyparam']").removeClass("active menuclick");
        $(".nav-link").filter("[href='ais140param']").parent().parent().addClass("show");  
        $(".nav-link").filter("[href='ais140param']").addClass("active statemenuclick");
      }
    }
  });
  
function toTitleCase(str) {
   return str.replace(/(?:^|\s)\w/g, function(match) {
       return match.toUpperCase();
   });
}
  function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
  
  $(".sortable").sortable({
    stop: function(ev, ui) {
    var children = $(this).sortable('refreshPositions').children();
      var SorTorder = [];
      $.each(children, function(index) {
          $(this).attr("displayorder",index);
      });

    }
  });

  $("#sideNav").on("click",function(e){
    $("#sidebarMenu").toggle();

  });
    
  $("#activitylog").click(function(){ 
    $("#LogContent").toggleClass("d-none");
    $("#pwdresetForm").addClass("d-none");
  });
  $(".tgNav").click(function() {
    
    $("#navbarToggleExternalContent1").toggle();

  $("#mainContentArea").toggleClass("col-md-12").css("padding-right","0px");
  $("#mainContentArea").toggleClass("col-lg-12").css("padding-right","0px");
  $("#mainContentArea").toggleClass("col-md-9").css("padding-right","0px");
  $("#mainContentArea").toggleClass("col-lg-10").css("padding-right","0px");
   
});

$("#theme").change(function() {
  var theme =$(this).val();
  $.ajax({
      type: 'POST',
      url: BASE_URL+"theme",
      data: {theme:theme},
      dataType: "json",         
      success: function(resultData) { 
      if(resultData=="1")
      {
        location.reload(); 
      }else{
        location.reload(); 
      } 
      },
      error : function(error) { 
        location.reload(); 
      }
      });


  });

  $(document).click(function(event) {
    var LogContent = $("#LogContent");
    var idstatus = event.target.id;
          if(idstatus=="restPwdClass"){
            $("#LogContent").removeClass("d-none");
            $("#pwdresetForm").removeClass("d-none");

          }else if(idstatus!="typ"){
            if (!LogContent.is(event.target) && !LogContent.has(event.target).length) {
               LogContent.addClass("d-none");
             }

          }
          else{
            //LogContent.toggleClass("d-none");
          }
});

 
$(document).ready(function(){
  
  $(".buttonloader").on("click",function(){ 
            var url=$(".buttonloader").data("target"); 
              $('.fa-refresh').addClass('fa-spin');

              setTimeout(function(){

                  var table = $("#"+url).DataTable();
                  table.ajax.reload();
                  $('.fa-refresh').removeClass('fa-spin');
              }, 1010);

          });
  $("#navbarToggleExternalContent1").toggle();

  $("#mainContentArea").toggleClass("col-md-12").css("padding-right","0px");
  $("#mainContentArea").toggleClass("col-lg-12").css("padding-right","0px");
  $("#mainContentArea").toggleClass("col-md-9").css("padding-right","0px");
  $("#mainContentArea").toggleClass("col-lg-10").css("padding-right","0px");
  
  if ($(".menuclick").length > 0) {
      routeURL = 'companyparam';
      document.cookie = "routeURL="+routeURL;
      $(".fullWrapper").show();
      $.ajax({
              type: 'POST', 
              data:{dAccess:"dashboard"},
              dataType:"html",
              url: BASE_URL+routeURL,
              success: function(resultData) {                          
                $("#mainContentArea").html(resultData); 
                var url= window.location.pathname; 
                var valuex = url.substring(url.lastIndexOf('/')+1);
                $(".nav-link").removeClass("active");
                $(".nav-link").removeClass("menuclick");
                $(".nav-link").filter("[href='"+routeURL+"']").addClass("active");           
                $("#breadHome ").html(breadHome);
                $("#breadPage").html(breadPage);
              },
              error : function(error) { 
                console.log(error);
              },
              complete : function(){
              }
            });
    }
    if ($(".statemenuclick").length > 0) {
      routeURL = 'ais140param';
      document.cookie = "routeURL="+routeURL;
      $(".fullWrapper").show();
      $.ajax({
              type: 'POST', 
              data:{dAccess:"dashboard"},
              url: BASE_URL+routeURL,
              dataType:"html",
              success: function(resultData) {                          
                $("#mainContentArea").html(resultData); 
                var url= window.location.pathname; 
                var valuex = url.substring(url.lastIndexOf('/')+1);
                $(".nav-link").removeClass("active");
                $(".nav-link").removeClass("statemenuclick");
                $(".nav-link").filter("[href='"+routeURL+"']").addClass("active");           
                $("#breadHome ").html(breadHome);
                $("#breadPage").html(breadPage);
              },
              error : function(error) { 
                console.log(error);
              },
              complete : function(){
              }
            });
    }
    
});
</script>
  <?php if(isset($timeStart)) { echo("<span  class='loadTimeRoad'; >Page#".$pageID." Loading Time - ".round((microtime(true) - $timeStart),4)." Seconds</span>"); } ?>

 
  </html>
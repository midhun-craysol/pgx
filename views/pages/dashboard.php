<?php 
    echo("<pre>");
    print_r($_SESSION);
    echo("</pre>");
    if(($_SESSION['pgx']["PasswordChangeFlg"]==1)&&($_SESSION['pgx']["NavTitle"]=='System')){

    }
    else{
        echo('<div class="mx-auto bg-info" style="margin-top:5%;width:150px;"></div>'); 
    } 
?>
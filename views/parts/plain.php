<script>
    $('#appendScript').empty("");
    (typeof(tabx) != "undefined") ? delete tabx : "";
    (typeof(addEditForm) != "undefined") ? delete addEditForm : "";
    (typeof(formModalBox) != "undefined") ? delete formModalBox : "";
    (typeof(pageTable) != "undefined") ? delete pageTable : "";
    (typeof(ajaxUrl) != "undefined") ? delete ajaxUrl : "";
    (typeof(addUrl) != "undefined") ? delete addUrl : "";
    (typeof(delUrl) != "undefined") ? delete delUrl : "";
    (typeof(IdField) != "undefined") ? delete IdField : "";
    (typeof(pageTable) != "undefined") ? delete pageTable : "";
    (typeof(updateUrl) != "undefined") ? delete updateUrl : "";
    <?php   
        echo(" var breadHome='".$breadhome."';");
        echo(" var breadPage='".$breadpage."';"); 
        
        if(!empty($scripts))
        {
            foreach ($scripts as $key=>$script) 
            {  
                $sc= BASE_URL.'/assets/custom-js/'.$script.'.js';  
                echo(" 
                var imported".$key." = document.createElement('script');
                imported".$key.".src = '".$sc."';
                // imported".$key.".setAttribute('Class','appendScript');
                // imported".$key.".class = 'appendScript'; 
                $('#appendScript').append(imported".$key.");
            ");
            }
        }
        if(isset($loadTimeStart)){
            echo("
                $('.loadTimeRoad').html('#".$pageID." Loading Time ".round((microtime(true) - $loadTimeStart),4)." Seconds');
            ");
        }
    ?>
</script>

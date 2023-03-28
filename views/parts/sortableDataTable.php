<script>
  pageName ="<?php echo(isset($pageName)? $pageName :''); ?>";
</script>
<?php

if(isset($filterHtml)){
  ?>
<div class="row pb-2 mb-1">  
    <div class="col-sm-12 ActionsAndFilters">       
            <?php
            echo($filterHtml);
             ?>
    </div>
  </div>
  <?php
}
else{
  ?>     
    <?php
}
?>
 

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body bodyCard">
          <?php 
          if(isset($dataTable) && !empty($dataTable)) { ?>
        <div class="table-responsive">
        <div class="btn-toolbar mb-2 mb-md-0 tableActionBtns float-right pr-1">
          <div class="btn-group">
          <?php if(isset($popupBtn)){
          ?>
            <button type="button" class="btn btn-sm btn-form-add"  id="<?php echo(isset($popupBtn)? $popupBtn :''); ?>">+</button>
            <?php  } 
            echo(isset($formatBtn)? $formatBtn :''); 
            ?>

          <?php  
          ?> 
          </div>
      </div>
         
          <table class="table table-striped  table-bordered table-hover table-sm" style="direction:LTR;  width='100%';" id="<?php echo(isset($dataTable["Id"])? $dataTable["Id"] :''); ?>"  width="100%">
            <thead>
              <tr>
              <?php if(!empty($dataTable["fields"])) { 
                foreach ($dataTable["fields"] as $field){
                ?>
              <th <?php echo( (isset($field["width"]) && $field["width"] !="")? "width='".$field["width"]."' " :''); ?> ><?php echo($field["th"]); ?></th>
              <?php } 
              } ?>
              </tr>
            </thead>
            <tbody class='sortable'>
              
            </tbody>
          </table>
        </div>
    <?php  }
          ?>
        </div>
      </div>
    </div>
  </div>
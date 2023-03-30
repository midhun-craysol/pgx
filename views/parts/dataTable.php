<script>
  pageName ="<?php echo(isset($pageName)? $pageName :''); ?>";
</script> 
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body bodyCard">
          <?php 
          if(isset($dataTable) && !empty($dataTable)) { ?>
          
        <div class="table-responsive">
        <div class="col-12 ">
        <?php
            if(isset($filterTopHtml)){
              ?>
              <div class="DTSectionTop row" >       
                        <?php
                        echo($filterTopHtml);
                        ?>
                </div>
              <?php
            }
            ?>
        </div>
        <div class="clearfix"></div> 
      <div class="btn-toolbar mb-2 mb-md-0 tableActionBtns pr-1">
        <?php
            if(isset($filterHtml)){
              ?>
              <div class="row col-12" >       
                  <?php
                    echo($filterHtml);
                  ?>
                </div>
              <?php
            }
            ?>
        </div>

        <div class="btn-toolbar mb-2 mb-md-0 tableActionBtns pr-1">
        <?php
            if(isset($Statefilter)){
              ?>
              <div class="row col-12" >       
                  <?php
                    echo($Statefilter);
                  ?>
                </div>
              <?php
            }
            ?>
        </div>
           <div class="DTableBtns">
              
              <div class="btn-group tablebtn_group">
              <button class="buttonloader pgx_btn tablebtn" title="Refresh" href="#" data-target="<?php echo(isset($dataTable["Id"])? $dataTable["Id"] :''); ?>" ><i class="fa fa-refresh" aria-hidden="true"></i></button>
                  <?php if(isset($popupBtn)){
                  ?>
                    <button type="button" class="pgx_btn tablebtn"  id="<?php echo(isset($popupBtn)? $popupBtn :''); ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    <?php  } 
                    echo(isset($formatBtn)? $formatBtn :'');                     
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
            <tbody>
              
            </tbody>
          </table>
        </div>
    <?php  }
          ?>
        </div>
      </div>
    </div>
  </div> 
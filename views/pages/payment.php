

<script>
  pageName ="<?php echo(isset($pageName)? $pageName :''); ?>";
</script> 
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body bodyCard"> 
          <div class="col-lg-2"></div>
          <form class="forms-sample col-lg-6" id="PaymentForm" content-type="multipart/form-data" method="POST">    
            <div class="form-group row">
            <label for="Products" class="col-sm-4 col-form-label">Products<i class="text-danger">*</i> </label>
            <div class="col-sm-8">
            <select name="Products" class="form-select text_field" id="Products" autocomplete="off">
                <option value="">--Select--</option> 
            </select>
            </div>
            </div>            
            <div class="form-group row">
            <label for="Amount" class="col-sm-4 col-form-label">Amount<i class="text-danger">*</i> </label>
            <div class="col-sm-8">
                <input name="Amount" type="text" class="form-control valAlpNum text_field" id="Amount" autocomplete="off">
            </div>
            </div>  
            <button type="submit" id="PaymentSubmit" class="btn btn-sm btn-primary float-right" >Save</button>
          </form>        
        </div>
      </div>
    </div>
  </div> 
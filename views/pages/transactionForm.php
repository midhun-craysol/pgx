

<script>
  pageName ="<?php echo(isset($pageName)? $pageName :''); ?>";
</script> 
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body bodyCard row"> 
          <div class="col-lg-3"><h4>Your amount is 100/-</h4></div>
          <div class="col-lg-9">
          <a class="payment" aria-hidden="true" style="font-size: 16px">
          <!-- <button>Pay Now </button> -->
          <button type="button" onclick="payNow()" class="btn btn-primary btn-sm">Pay Now</button>
            </a>
          </div>
          
          <!-- <form class="forms-sample col-lg-6" id="TransactionForm" content-type="multipart/form-data" method="POST">    
                     
            <div class="form-group row">
            <label for="Amount" class="col-sm-4 col-form-label">Amount<i class="text-danger">*</i> </label>
            <div class="col-sm-8">
                <input name="Amount" type="text" class="form-control valAlpNum text_field" id="Amount" autocomplete="off">
            </div>
            </div>  
            <button type="submit" id="TransactionSubmit" class="btn btn-sm btn-primary float-right" >Save</button>
          </form>         -->
        </div>
      </div>
    </div>
  </div> 
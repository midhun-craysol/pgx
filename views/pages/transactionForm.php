<script>
    pageName ="<?php echo(isset($pageName)? $pageName :''); ?>";
  </script>
    <script src="<?php echo(BASE_URL); ?>assets/js/checkout.js" ></script>

 
  <script>
   

  </script>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body bodyCard row"> 
            <div id="compid" data-val="<?php echo $_SESSION['pgx']['CompanyOfficeID']; ?>" class="d-none"></div>
            <div class="col-lg-3"><h4>Product 1 : amount 100/-</h4></div>
              <div class="col-lg-9">
                <a class="payment" aria-hidden="true" style="font-size: 16px">
                <!-- <button>Pay Now </button> -->
                <button type="button" data-amount="100" class="btn btn-primary btn-sm pay1">Pay Now</button>
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
  
          <div class="card-body bodyCard row"> 
            <div class="col-lg-3"><h4>Product 2 : amount 200/-</h4></div>
              <div class="col-lg-9">
                <a class="payment" aria-hidden="true" style="font-size: 16px">
                <!-- <button>Pay Now </button> -->
                <button type="button" data-amount="200" class="btn btn-primary btn-sm pay1">Pay Now</button>
                <!-- <a href="https://razorpay.me/@craysoltechnologiesipvtltd">pay >></a> -->
  
              
                </a>
              </div>          
            </div>
          </div>
  
      </div>
    </div> 
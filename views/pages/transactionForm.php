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
              
            </div>
          </div>
  
          <div class="card-body bodyCard row"> 
            <div class="col-lg-3"><h4>Product 2 : amount 200/-</h4></div>
              <div class="col-lg-9">
                <a class="payment" aria-hidden="true" style="font-size: 16px">
                <!-- <button>Pay Now </button> -->
                <button type="button" data-amount="200" class="btn btn-primary btn-sm pay1">Pay Now</button>
                
  
              
                </a>
              </div>          
            </div>
          </div>
  
      </div>
    </div> 
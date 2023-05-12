<script>
    pageName ="<?php echo(isset($pageName)? $pageName :''); ?>";
  </script>
    <script src="<?php echo(BASE_URL); ?>assets/js/checkout.js" ></script>

 
  <script>
   

  </script>
  <?php 
  use Razorpay\Api\Api;
  $api = new Api($key_id, $secret);

  $api->paymentLink->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true,
'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar',
'email' => 'gaurav.kumar@example.com', 'contact'=>'+919000090000'),  'notify'=>array('sms'=>true, 'email'=>true) ,
'reminder_enable'=>true ,'notes'=>array('policy_name'=> 'Jeevan Bima'),'callback_url' => 'https://example-callback-url.com/',
'callback_method'=>'get'));

?>
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body bodyCard row"> 
            <div id="compid" data-val="<?php echo $_SESSION['pgx']['CompanyOfficeID']; ?>" class="d-none"></div>
            <div class="col-lg-3"><h4>Product 1 : amount 100/-</h4></div>
              <div class="col-lg-9">
                <a class="payment" aria-hidden="true" style="font-size: 16px">
                  <button type="button" data-amount="100" class="btn btn-primary btn-sm pay1">Pay Now</button>
                </a>

                <a class="payment" aria-hidden="true" style="font-size: 16px">
                  <button type="button" data-amount="100" class="btn btn-primary btn-sm paylink">Create a Payment Link</button>
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

    

    <div class="modal fade" id="ViewPaymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999 !important;">
            <div class="modal-dialog">
                <div class="modal-content modalwid">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Transaction Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="row">
                          <table>
                            <tr>
                              <td><label>Transaction ID </label></td><td>:</td><td><span id="TransactionID"></span></td>
                            </tr> 
                            <tr>
                              <td>Transaction Time</td><td>:</td><td><span id="TransactionTime"></span></td>
                            </tr>
                            <tr>
                              <td>Total Amount </td><td>:</td><td><span id="TotalAmount"></span></td>
                            </tr>
                            <tr>
                              <td>Transaction Status</td><td>:</td><td><span id="Status"></span></td>
                            </tr>

                           
                          </table>
                           
                            <!-- <div class="col-5">                            
                              <label>TransactionID </label>
                            </div>
                            <div class="col-7">
                          
                            </div> -->
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="SendLinkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999 !important;">
            <div class="modal-dialog">
                <div class="modal-content modalwid">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Customer Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="row">
                        <form class="forms-sample" id="sendLinkForm" content-type="multipart/form-data" method="POST">
                      
                      <div class="form-group row">
                        <label for="CustomerName" class="col-sm-4 col-form-label pr-0"> Name<i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                          <input name="CustomerName" type="text" class="form-control"  id="CustomerName" autocomplete="off">
                          <span id="lblNameError" class="specialchar_error"></span>
                        </div>
                      </div>  

                      <div class="form-group row">
                        <label for="CustomerNumber" class="col-sm-4 col-form-label pr-0"> Contact Number<i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                          <input name="CustomerNumber" type="number" class="form-control"  id="CustomerNumber" autocomplete="off">
                          <span id="lblCustomerNumberError" class="specialchar_error"></span>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="CustomerEmail" class="col-sm-4 col-form-label pr-0"> Email<i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                          <input name="CustomerEmail" type="text" class="form-control"  id="CustomerEmail" autocomplete="off">
                          <span id="lblCustomerEmailError" class="specialchar_error"></span>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="TransactionAmount" class="col-sm-4 col-form-label pr-0">Amount</label>
                        <div class="col-sm-8">
                          <input name="TransactionAmount" type="text" class="form-control full-caps" id="TransactionAmount" autocomplete="off" readonly>
                          
                        </div>
                      </div> 
                      
                      <button type="submit" id="paylinkSubmit" class="btn btn-primary btn-sm float-right" >Share Link</button>
                    </form>
                           
                           
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>
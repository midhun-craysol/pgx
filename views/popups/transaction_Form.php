
<script>
  pageName ="countryList";
</script>

   <!-- Modal -->
   <div class="modal fade" id="countryModal" tabindex="-1" role="dialog" aria-hidden="true">       
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Country  </h5>
                <a type="button" class="close" id="btnModeClose" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <div class="modal-body">               
              <div class="col-md-12 px-0 stretch-card">
                <div class="card">
                  <div class="card-body">

                    <form class="forms-sample" id="countryForm" content-type="multipart/form-data" method="POST">
                      
                      <div class="form-group row">
                        <label for="CountryName" class="col-sm-4 col-form-label pr-0"> Name<i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                          <input name="CountryName" type="text" class="form-control required_input"  id="CountryName" autocomplete="off">
                          <span id="lblNameError" class="specialchar_error"></span>
                        </div>
                      </div>  

                      <div class="form-group row">
                        <label for="CountryAbbr" class="col-sm-4 col-form-label pr-0">Abbreviation<i class="text-danger">*</i></label>
                        <div class="col-sm-8">
                          <input name="CountryAbbr" type="text" class="form-control full-caps required_input" id="CountryAbbr" autocomplete="off">
                          <span id="lblCountryError" class="specialchar_error"></span>
                        </div>
                      </div> 
        
                        <div class="form-group row pt-1">
                          
                          <div class="col-sm-4">
                          </div>                         
                          
                        </div>
                      
                      <div id="Statusdiv">
                        <div class="form-group row">
                        <label class="col-sm-4 col-form-label pr-0"> Status</label>
                          <div class="col-sm-8">
                          <label class="switch">
                              
                              <input id="Status" name="Status" type="checkbox" checked>
                              <span class="slider round"></span>
                           </label>  
                           
                          </div>
                        </div>
                        </div>
                      
                      <button type="submit" id="countrySubmit" class="btn btn-primary btn-sm float-right" >Save</button>
                    </form>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>


        
      
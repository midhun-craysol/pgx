<script>
  pageName ="CompanyParamList";
</script>
<style>
  img.paramImg {
    width: auto;
    height: 30px;
}

.paramInput:hover {
  background-color: #3379a8;
  color:white;
}
.cmp tr:hover {
  background-color: #3379a8;
  color:white;
}
.paramInput {
    background: transparent;
    width: 100%;
}
</style>
<!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
  </div> -->
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body" style="padding-bottom: 100px;">

        <h5 class="h5 text-end" style="cursor: pointer;"><i class="fa fa-pencil-square-o editParam" aria-hidden="true" onclick="editCpTxt();"></i></h5>

        <form class="CompanyParamForm" id="CompanyParamForm">  

        <table class="table-bordered display dataTable cmp" id="companyparamTable" width="100%">                     
          <tbody>
              
              <?php 

              $paramKeys =[
               
                "PicFolderURL" => "File Upload Root Folder",
                "PGCompanyID" => "PG Company",
                "PGOfficeID" => "PG Office",
                "PaymentGatewayCode" => "Payment Gateway Code",
                "TestField"     =>"TestField"
              ];
             
                echo "</tr><thead style='border: 1px solid #ddd;'><th width='200px'>Name</th><th width='260px'>Value</th><th></th></thead></tr>";
               
                $textParams = ["PicFolderURL","PGCompanyID","PGOfficeID","PaymentGatewayCode","TestField"];
              
                $j=1;
                foreach ($paramRows as $row) { 

                  foreach ($columnArr as $key) {
                
                     
                      if (array_key_exists($key,$paramKeys)){
                        $paramValueIndex = $key;
                        $paramValue = '<span id="lblParam'.$j.'">'.$row[$key].'</span>';
                        if(in_array($key,$textParams)){
                          $paramValue .= '<input class="paramInput border-0 paramInput form-control d-none" id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly  required>';
                          //$paramValue .= $row[$key];
                         
                        }
                       
                       
                        $rowCreated = '<tr><td height="25">'.$paramKeys[$key].'</td>
                        <td height="20">'.$paramValue.'</td><td></td></tr>';  
  
                        
                        echo($rowCreated);

                        
                      }                             
                  
                    
                      $j++; 
                  } 
                  
                }
              ?>
            
            <!-- <tr rowspan="3" class="d-none" id="savebtn"><td> </td><td></td> <td><button  type='submit' class='paramSubmit btn btn-xs' ><i class='fa fa-save'></i></button>  </td></tr> -->
            
          </tbody>
        </table>
       <div class="text-right d-none" id="savebtn"><button type="submit" id="rtoSubmit" class="btn btn-primary btn-sm float-right" >Save</button></div>
    </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  

    
           
      




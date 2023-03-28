<script>
  pageName ="Ais140StateParamList";
</script>
<style>
  img.paramImg {
    width: auto;
    height: 30px;
}
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
<h5  class="h5">State Parameters&nbsp;<button type="button" class="btn btn-primary btn-sm" onclick="editCpTxt();"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></h5>
</div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body" style="padding-bottom: 100px;">
        <form class="Ais140StateParamForm" id="Ais140StateParamForm">   
        <table class="table-bordered display dataTable cmp" id="companyparamTable" width="100%">                     
          <tbody> 
              <?php  
                $paramKeys =[ 
                  "StateID" => "State Name",
                  "GovServerURL" => "State Govt. Server URL",
                  "IPWhiteList" => "IP White List",
                  "PhoneWhiteList" => "Phone White List", 
                  "VahanImplementedFlg" => "Vahan Implemented",
                  "FirstPermanentActivationPlanID" => "First Permanent Activation Plan",
                ]; 
                echo "</tr><thead><th width='60'>Sl No.</th><th>Name</th><th>Value</th></thead></tr>";
               
                $textParams = ["StateID","GovServerURL","VahanImplementedFlg"];
              
                $j=1;
                foreach ($paramRows as $row) { 

                  foreach ($columnArr as $key) {
                
                     
                      if (array_key_exists($key,$paramKeys)){
                        $paramValueIndex = $key;
                        $paramValue = $row[$key];
                        if(in_array($key,$textParams)){

                          if($key=="StateID")
                          {
                             $input='<select name="StateID" id="StateID" disabled>
                             <option value="'.$row[$key].'" ></option>
                             </select>';
                          }

                          if($key=="GovServerURL")
                          {
                             $input=' <input  class="paramInput border-0" id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly required>';
                          }
                          if($key=="IPWhiteList")
                          {
                             $input=' <textarea  class="paramInput border-0" id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly required>';
                          }
                          if($key=="PhoneWhiteList")
                          {
                             $input=' <textarea  class="paramInput border-0" id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly required>';
                          }

                          if($key=="VahanImplementedFlg")
                          {
                            $check="";
                            if($row[$key]=="Yes"){
                              $check="checked";
                            }
                             $input=' <input type="checkbox"  class="paramInput border-0"  id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly  '.$check.'>';
                          }
                         
                          $paramValue = ''.$input;
                          $paramValue .= "";
                        
                        }
                       
                       
                        $rowCreated = '<tr><td>'.$j.'</td><td height="25">'.$paramKeys[$key].'</td><td height="20">'.$paramValue.'</td></tr>';  
  
                        
                        echo($rowCreated);

                        
                      }                             
                  
                    
                      $j++; 
                  } 
                  
                }
              ?>
            

            
          </tbody>
        </table>
        <div class="text-right d-none" id="savebtn"><button type="submit" id="rtoSubmit" class="btn btn-primary btn-sm float-right" >Save</button></div>
    </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  

    
           
      




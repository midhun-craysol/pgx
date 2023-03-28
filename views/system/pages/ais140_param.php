<script>
  pageName ="Ais140ParamList";
</script>
<style>
  img.paramImg {
    width: auto;
    height: 30px;
}
.ais140Cmp tr:hover{
    cursor: pointer;
    color:#FFFFFF ;
    background-color: #3379a8 !important;
    box-shadow: 0px 15px 9px -6px grey;
    border-top: 2px solid grey;
    border-bottom: 2px solid grey;
    
  }
.ais140Cmp tr>input:hover{
    cursor: pointer;
    color:#FFFFFF ;
    background-color: #3379a8 !important;
   
  }
  .ais140Cmp tr>thead>td:hover{
    cursor: pointer;
    color:black ;
    background-color: white !important;

  }

 

</style>
<!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom">
  </div> -->
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body" style="padding-bottom: 100px;">
        <form class="Ais140ParamForm" id="Ais140ParamForm" method="post">   
        <h5 class="h5 text-end" style="cursor: pointer;"> &nbsp;<i class="fa fa-pencil-square-o editParam" aria-hidden="true"  onclick="editCpTxt()";></i></h5>

        <table class="table-bordered display dataTable ais140Cmp" id="companyparamTable" width="100%">                     
          <tbody>
              
              <?php 

              $paramKeys =[
               
                "DefCustVehMaxCount" => "Maximum Vehicle Count",
                "CertificateAbbr" => "Certificate Abbreviation",
                "CertificateRnr" => "Certificate Count",
                "MaxCertificateDwnldRnr" => "Download Count",
                "IndiaCountryCode" => "India Country Code",
                "LastCertificateSrNo" => "Last Certificate Sr No",
                "AdnlCertificateAmt" => "Adnl Certificate Amt",
                "TempActivateDays" => "Temp Activate Days",
                "TempActivateionCount" => "Temp Activation Count",

              ];
             
                echo "<tr><thead><th width='200px'>Name</th><th width='200px'>Value</th><th></th></thead></tr>";
               
                $textParams = ["DefCustVehMaxCount","CertificateAbbr","CertificateRnr","MaxCertificateDwnldRnr","IndiaCountryCode","LastCertificateSrNo","AdnlCertificateAmt","TempActivateDays","TempActivateionCount"];
              
                $j=1;
                foreach ($paramRows as $row) { 

                  foreach ($columnArr as $key) {
                
                     
                      if (array_key_exists($key,$paramKeys)){
                        $paramValueIndex = $key;
                        $paramValue = $row[$key];
                        if(in_array($key,$textParams)){
                          $editBtn = '<button type="button" class="btn  btn-icon  btn-sm" onclick="editCpTxt(\''.$key.'\',\''.$row[$key].'\');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                          if( $key=="CertificateRnr"||$key=="MaxCertificateDwnldRnr"||$key=="LastCertificateSrNo"||$key=="TempActivateionCount" ){
                            $text="number";
                            $editBtn="";
                            $paramValue = ''.$row[$key].'';
                          }
                          else if($key=="DefCustVehMaxCount"){
                            $text="number";
                            $paramValue = '<span id="sp1">'.$row[$key].'</span>
                            <input type="'.$text.'" class="paramInput form-control border-0 d-none" id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly required>';
                          }
                          else if($key=="AdnlCertificateAmt"){
                            $text="number";
                            $paramValue = '<span id="sp4">'.$row[$key].'</span>
                            <input type="'.$text.'" class="paramInput form-control border-0 d-none" id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly required>';
                          }
                          else if($key=="TempActivateDays"){
                            $text="number";
                            $paramValue = '<span id="sp5">'.$row[$key].'</span>
                            <input type="'.$text.'" class="paramInput form-control border-0 d-none" id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly required>';
                          }
                          else if($key=="IndiaCountryCode"){
                            $text="text";
                            $paramValue = '<span id="sp3">'.$row[$key].'</span>
                            <input type="'.$text.'" class="paramInput form-control border-0 d-none" id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly required>';
                          }
                          else{
                            $text="text";
                            $paramValue = '<span id="sp2">'.$row[$key].'</span>
                            <input type="'.$text.'" class="paramInput form-control border-0 d-none" id="inputAll'.$j.'" name="'.$key.'"  value ="'.$row[$key].'" readonly required>';
                          }
                         
                          // $paramValue .= "<button id='".$key."SaveParam' type='submit' class=' invisible paramSubmit btn btn-xs' ><i class='fa fa-save'></i></button>";
                         
                        }
                       
                       
                        $rowCreated = '<tr><td height="25">'.$paramKeys[$key].'</td><td height="20">'.$paramValue.'</td><td></td></tr>';  
  
                        
                        echo($rowCreated);

                        
                      }                             
                  
                    
                      $j++; 
                  } 
                  
                }
              ?>
            

            
          </tbody>
        </table>
        <div class="text-right d-none" id="savebtn"><button type="submit"  class="btn btn-primary btn-sm float-right" >Save</button></div>
    </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  

    
           
      




<?php
require_once  MODEL_BASE_PATH."Database.php"; 
class  CrudModel extends Database
{
    function __construct(){
        $this->db = new Database();
    }
    
    public function getPageTableName($TableName = "")
    {
        $where = "WHERE TableName = '".$TableName."' ";
        $page = $this->detailsRow("000_tables",$where);
        if(!empty($page) || $pageName =""){
            $TableName = ($page["TablePrefix"] !="" && $page["TableName"] !="")? $page["TablePrefix"].$page["TableName"] : "";
            return($TableName);
        }
        else {
            return('');
        }
    }

    public function list($table ,$conditions)
    {
        $sqlQuery = "SELECT * FROM  ".$table;
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }
    }
    public function listFields($table ,$fields , $conditions =" ")
    {   
        if(!empty($fields)){
            $items = implode (", ",$fields);
        }else{
            $items = "*";
        }
        $sqlQuery = "SELECT ".$items." FROM  ".$table." ".$conditions;
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"List fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"List fetching failed")));
        }
    }
    public function listRows($table ,$fields,$conditions)
    {   
        if(!empty($fields)){
            $items = implode (", ",$fields);
        }else{
            $items = "*";
        }
        $sqlQuery = "SELECT ".$items." FROM  ".$table;
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $result = $this->db->executeQuery($sqlQuery);
        return($result);
    }

    public function getSingleRow($table,$fields,$conditions =" ")
    {
        if(!empty($fields)){
            $items = implode (", ",$fields);
        }else{
            $items = "*";
        }
        $sqlQuery = "SELECT ".$items." FROM  ".$table;       
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $sqlQuery .= " LIMIT 1";
        $result = $this->db->executeQuery($sqlQuery);
        return($result);
    }
    public function getSingleRowCustom($table,$fields,$conditions ="")
    {
        if(!empty($fields)){
            $items = implode (", ",$fields);
        }else{
            $items = "*";
        }
        $sqlQuery = "SELECT ".$items." FROM  ".$table;       
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){      
            return($result[0]);
        }
        else{
            return([]);
        }
    }
    public function details($table,$conditions)
    {
        $sqlQuery = "SELECT * FROM ".$table;        
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $sqlQuery .= " LIMIT 1";  
        
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result[0],"Message"=>"Details fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"Details fetching failed")));
        }
    }
    public function detailsRow($table,$conditions)
    {
        $sqlQuery = "SELECT * FROM ".$table;        
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $sqlQuery .= " LIMIT 1";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return($result[0]);
        }
        else {
              return([]);
        }
    }

    public function detailsMinimum($table,$conditions)
    {
        $sqlQuery = "SELECT * FROM ".$table;        
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";        
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(json_encode(array("Status"=>1,"data"=>$result,"Message"=>"Details fetched successfully")));
        }
        else {
              return(json_encode(array("Status"=>0,"Message"=>"Details fetching failed")));
        }
    }

    public function userlog($table,$qry,$action){
        $q=str_replace("'", "\'", $qry);

        if($_SESSION['pgx']["UserType"]=="SysUsers")
        {
            $id=$_SESSION['pgx']["UserID"];
        }
        else
        {
            $id=$_SESSION['pgx']["UserMainID"];
        }
         
      $qry=json_decode($qry);
      $logsqlQuery="INSERT INTO `999_userlog`(`UserLogID`, `ActionTableName`, `ActionName`, `ActionBy`,`ActionValues`,`UserAgentInfo`) VALUES ('".$this->generateId()."','".$table."','".$action."','".$id."','".$q."','".$_SERVER['HTTP_USER_AGENT']."')";
            $r=$this->db->executeStatement($logsqlQuery);   
    }
    public function delete($table,$conditions)
    {
        $sqlQuery = "DELETE FROM ".$table;
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $this->userlog($table,"","DELETED"); 
        $result = $this->db->executeStatement($sqlQuery);        
        return($this->handleResult($result,"Successfully Deleted","Deletion Failed"));
    }
    public function deleteStatus($table,$conditions)
    {
        
        $sqlQuery = "UPDATE `".$table."` SET `".$table."`.`Status`='2'";
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $this->userlog($table,"`Status`='2'","DELETED"); 
        $result = $this->db->executeStatement($sqlQuery);
        
        if($result == -1) 
        { 
            //return (["Status" => -1]); 
            echo json_encode(["Status"=>-1,"Message" =>"Successfully Deleted"]);
            
        }
        else if($result == 1) 
        { 

            return (["Status" => 1,"Message" => "Successfully Deleted"]) ; 
        }
        else{
            return (["Status" => 0,"Message" => "Deletion Failed"]);
 
        } 
    }
    public function deleteWithFKeyCheck($table,$conditions)
    {
        $sqlQuery = "DELETE FROM ".$table;
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $this->userlog($table,"","DELETED"); 
        $result = $this->db->executeDelete($sqlQuery);    
        if($result == -1) 
        { 
            return (["Status" => -1]); 
        }
        else if($result == 1) 
        { 
            return (["Status" => 1]) ; 
        }
        else{
            return (["Status" => 0]);
        }
    }   
    public function deleteWithFKeyStatusNew($table,$conditions ,$fkCondition , $relatedTables)
    {
        if(!empty($relatedTables)){
            $relFlags = 0;
            foreach($relatedTables as $relatedTable){
                $tbName = $this->getPageTableName($relatedTable);
                $fkQuery = "Select * FROM `".$tbName."`";
                $fkQuery .= " WHERE ".$fkCondition." AND `Status` ='1' ";
                $result = $this->db->executeQuery($fkQuery);  
                if(!empty($result )){
                    $relFlags++;
                } 
            }
            if($relFlags>0){
                echo json_encode(["Status"=>0,"Message" =>"Can't be deleted"]);
            }
            else{           
                                
                    echo json_encode(["Status"=>1,"Message" =>"OKKKK"]);
                  
            }
        }
        else{
            echo json_encode(["Status"=>1,"Message" =>"OKKKKwwww"]);
        }
        
    }
  public function updateByDeleteStatus($table,$conditions)
  {
    $sqlQuery = "UPDATE `".$table."` SET `".$table."`.`Status`='2'";
    $sqlQuery .= ($conditions)?(" ".$conditions):" ";
    $result = $this->db->executeStatement($sqlQuery);           
    if($result){                    
        echo json_encode(["Status"=>1,"Message" =>"Successfully Deleted"]);
    }  
    else{
        echo json_encode(["Status"=>0,"Message" =>"Deletion Failed"]);
    } 

  }
    public function deleteWithFKeyStatus($table,$conditions ,$fkCondition , $relatedTables)
    {
        
        if(!empty($relatedTables)){
            $relFlags = 0;
            
            foreach($relatedTables as $relatedTable){
                $tbName = $this->getPageTableName($relatedTable);
                $fkQuery = "Select * FROM `".$tbName."`";
                $fkQuery .= " WHERE ".$fkCondition." AND `Status` ='1' ";
                
                $result = $this->db->executeQuery($fkQuery);  
                if(!empty($result)){
                    $relFlags++;
                } 
            }
            if($relFlags>0){
                echo json_encode(["Status"=>-1,"Message" =>"In use , Can't be deleted"]);
            }
            else{            
                $sqlQuery = "UPDATE `".$table."` SET `".$table."`.`Status`='2'";
                $sqlQuery .= ($conditions)?(" ".$conditions):" ";
                $result = $this->db->executeStatement($sqlQuery); 
                $this->userlog($table,"`Status`='2'","DELETED");     
                if($result){                    
                    echo json_encode(["Status"=>1,"Message" =>"Successfully Deleted"]);
                }  
                else{
                    echo json_encode(["Status"=>0,"Message" =>"Can't be deleted"]);
                }     
            }
        }
        else{
            $sqlQuery = "UPDATE `".$table."` SET `".$table."`.`Status`='2'";
            $sqlQuery .= ($conditions)?(" ".$conditions):" ";
            $this->userlog($table,"`Status`='2'","DELETED"); 
            // print_r($sqlQuery); die();
            $result = $this->db->executeStatement($sqlQuery);           
            if($result){                    
                echo json_encode(["Status"=>1,"Message" =>"Successfully Deleted"]);
            }  
            else{
                echo json_encode(["Status"=>0,"Message" =>"Deletion Failed"]);
            } 

        }
    }
    public function unlinkWithFKeyStatus($table,$conditions ,$fkCondition , $relatedTables)
    {
        
        if(!empty($relatedTables)){
            $relFlags = 0;
            
            foreach($relatedTables as $relatedTable){
                $tbName = $this->getPageTableName($relatedTable);
                $fkQuery = "Select * FROM `".$tbName."`";
                $fkQuery .= " WHERE ".$fkCondition." AND `Status` ='1' ";
                
                $result = $this->db->executeQuery($fkQuery);  
                if(!empty($result)){
                    $relFlags++;
                } 
            }
            if($relFlags>0){
                echo json_encode(["Status"=>-1,"Message" =>"In use , Can't be unlink"]);
            }
            else{            
                $sqlQuery = "UPDATE `".$table."` SET `".$table."`.`Status`='2'";
                $sqlQuery .= ($conditions)?(" ".$conditions):" ";
                $result = $this->db->executeStatement($sqlQuery); 
                $this->userlog($table,"`Status`='2'","UNLINKED");     
                if($result){                    
                    echo json_encode(["Status"=>1,"Message" =>"Successfully Unlinked"]);
                }  
                else{
                    echo json_encode(["Status"=>0,"Message" =>"Can't be unlink"]);
                }     
            }
        }
        else{
            $sqlQuery = "UPDATE `".$table."` SET `".$table."`.`Status`='2'";
            $sqlQuery .= ($conditions)?(" ".$conditions):" ";
            $this->userlog($table,"`Status`='2'","UNLINKED"); 
            // print_r($sqlQuery); die();
            $result = $this->db->executeStatement($sqlQuery);           
            if($result){                    
                echo json_encode(["Status"=>1,"Message" =>"Successfully Unlinked"]);
            }  
            else{
                echo json_encode(["Status"=>0,"Message" =>"Unlink Failed"]);
            } 

        }
    }
  
    public function add($table,$data)
    {    
       
        $primaryKey =$this->getPrimaryKeyName($table);
        if($primaryKey != null) {
            $data[$primaryKey] = $this->generateId();
            $fields="";
            $values="";
            foreach ($data as $key => $value) {
                $fields.="`".$key."`,";
                $values.="'".$value."',";
            }  
            if($fields !=""){
                $fields = rtrim($fields, ',');
                $values = rtrim($values, ',');
            }
            $sqlQuery ="INSERT INTO `".$table."` ( ".$fields." ) VALUES (".$values.")"; 

           
            $this->userlog($table,json_encode($values),"INSERTED");            
            $result = $this->db->executeStatement($sqlQuery);
            
        }
        else{
            $result = [];
        }
        return($this->handleResult($result,"Successfully Created","Creation Failed"));
    }
    public function addWithOutKey($table,$data)
    {      
             
        $fields="";
        $values="";
        foreach ($data as $key => $value) {
            $fields.="`".$key."`,";
            $values.="'".$value."',";
        }  
        if($fields !=""){
            $fields = rtrim($fields, ',');
            $values = rtrim($values, ',');
        }
        $sqlQuery ="INSERT INTO `".$table."` ( ".$fields." ) VALUES (".$values.")"; 
        
                
        $this->userlog($table,json_encode($values),"INSERTED");            
        $result = $this->db->executeStatement($sqlQuery); 
        return($this->handleResult($result,"Successfully Created","Creation Failed"));
    }


    public function addNew($table,$data)
    {      
           
        $primaryKey =$this->getPrimaryKeyName($table);
        if($primaryKey != null) {
            $data[$primaryKey] = $this->generateId();
            $fields="";
            $values="";
            foreach ($data as $key => $value) {
                $fields.="`".$key."`,";
                $values.="'".$value."',";
            }  
            if($fields !=""){
                $fields = rtrim($fields, ',');
                $values = rtrim($values, ',');
            }
            $sqlQuery ="INSERT INTO `".$table."` ( ".$fields." ) VALUES (".$values.")"; 
            $this->userlog($table,json_encode($values),"INSERTED");          
            $result = $this->db->executeStatement($sqlQuery);
           

        }
        else{
            $result = [];
        }
        return($this->handleResultNew($result,"Successfully Created","Creation Failed"));
    }
    public function createRow($table,$data)
    {      
           
        $primaryKey =$this->getPrimaryKeyName($table);
        if($primaryKey != null) {

            $data[$primaryKey] = $this->generateId();
            $fields="";
            $values="";
            foreach ($data as $key => $value) {
                $fields.="`".$key."`,";
                $values.="'".$value."',";
            }  
            if($fields !=""){
                $fields = rtrim($fields, ',');
                $values = rtrim($values, ',');
            }
            $sqlQuery ="INSERT INTO `".$table."` ( ".$fields." ) VALUES (".$values.")";
            $this->userlog($table,json_encode($values),"INSERTED"); 
            $result = $this->db->executeStatement($sqlQuery);
            if(!empty($result)){
                return($data[$primaryKey] );
            }
            else {
                $data[$primaryKey]=[];
                return($data[$primaryKey]);
            }
        }
        else{
            $data[$primaryKey]=[];
            return($data[$primaryKey]);
        }
    }

    public function translate($from_lan, $to_lan, $text){

        $text = 'Test new message only.';
        $apiKey = '<past your google api key here>';
        // $url = 'https://www.googleapis.com/language/translate/q=' . rawurlencode($text) . '&source=en&target=ml';
        $url ="https://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=' . urlencode($text) . '&langpair=' . $from_lan . '|' . $to_lan";
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($handle);
        $responseDecoded = json_decode($response, true);
    
        curl_close($handle);
    
        // $json = json_decode(file_get_contents('https://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=' . urlencode($text) . '&langpair=' . $from_lan . '|' . $to_lan));
        $translated_text = $responseDecoded->responseData->translatedText;
        // echo ($response);
        
    
        return $translated_text;
    }
    public function addText($data)
    {      
        
        $textTable =$this->getPageTableName("textlibrary");
        $primaryKey =$this->getPrimaryKeyName($textTable);
        if($primaryKey != null) {
            $data[$primaryKey] = $this->generateId();
            $fields="";
            $values="";
            foreach ($data as $key => $value) {
                $fields.="`".$key."`,";
                $values.="'".$value."',";
            }  
            if($fields !=""){
                $fields = rtrim($fields, ',');
                $values = rtrim($values, ',');
            }
            $sqlQuery ="INSERT INTO `".$textTable."` ( ".$fields." ) VALUES (".$values.")";
            
            $result = $this->db->executeStatement($sqlQuery);
            if(!empty($result)){
                // $from_lan = "en";
                // $to_lan = "ml";
                // $translatedText = $this->translate($from_lan, $to_lan, $data["TextReference"]);
                // $langLibData = array(
                //     "LanguageID" => "2",
                //     "TextLibID" => $primaryKey,
                //     'TranslatedText' => $translatedText
                // );
                // $this->addTextToLangLib($langLibData);
                return($data[$primaryKey]);
            }
            else{
                return(null);
            }
        }
        else{
            return(null);
        }
    }
    public function addTextToLangLib($data)
    {      
        
        $langTible =$this->getPageTableName("languagelibrary");
        $primaryKey =$this->getPrimaryKeyName($langTible);
        if($primaryKey != null) {
            $data[$primaryKey] = $this->generateId();
            $fields="";
            $values="";
            foreach ($data as $key => $value) {
                $fields.="`".$key."`,";
                $values.="'".$value."',";
            }  
            if($fields !=""){
                $fields = rtrim($fields, ',');
                $values = rtrim($values, ',');
            }
            $sqlQuery ="INSERT INTO `".$langTible."` ( ".$fields." ) VALUES (".$values.")";
            $result = $this->db->executeStatement($sqlQuery);
            if(!empty($result)){
                return($data[$primaryKey]);
            }
            else{
                return(null);
            }
        }
        else{
            return(null);
        }
    }
    public function getPrimaryKeyName($table){
        $sqlQuery ="SHOW KEYS FROM ".$table." WHERE Key_name = 'PRIMARY'";
        $result = $this->db->executeQuery($sqlQuery);    
            return((!empty($result) && $result[0]['Column_name'] !='')?$result[0]['Column_name']:null);
    }
    function generateId (){
        $micro = gettimeofday()['usec'];
        $todate =  date("YmdHis");
        $alpha = substr(md5(rand()), 0, 2);
        return($todate.$micro.$alpha);

    }
    public function update($table,$data ,$conditions)
    {   
        $fieldAndValuePair="";
        foreach ($data as $key => $value) {
            if(!is_numeric($key)){
                $fieldAndValuePair.="`".$key."` = '".$value."',";
            }
        }
        if($fieldAndValuePair !=""){
            $fieldAndValuePair = rtrim($fieldAndValuePair, ',');
        }       
        
        $sqlQuery = "UPDATE `".$table."` SET ".$fieldAndValuePair;
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
       
        $this->userlog($table,json_encode($fieldAndValuePair),"UPDATED"); 
        $result = $this->db->executeStatement($sqlQuery);
        return($this->handleResult($result,"Successfully Updated","Failed to Update"));
        
    }
    public function updateRow($table,$data ,$conditions)
    {   
        $fieldAndValuePair="";
        foreach ($data as $key => $value) {
            if(!is_numeric($key)){
                $fieldAndValuePair.="`".$key."` = '".$value."',";
            }
        }
        if($fieldAndValuePair !=""){
            $fieldAndValuePair = rtrim($fieldAndValuePair, ',');
        }
        
        
        $sqlQuery = "UPDATE `".$table."` SET ".$fieldAndValuePair;
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        // print_r($sqlQuery."  -----------------------  "); 
        $result = $this->db->executeStatement($sqlQuery);
        return($result);
        
    }
    public function updateText($data)
    {   
        
        $textTable =$this->getPageTableName("textlibrary");
        $fieldAndValuePair="";
        $textLibID = $data['TextLibID'];
        unset($data['TextLibID']);
        foreach ($data as $key => $value) {
            $fieldAndValuePair.="`".$key."` = '".$value."',";
        }
        if($fieldAndValuePair !=""){
            $fieldAndValuePair = rtrim($fieldAndValuePair, ',');
        }
        $sqlQuery = "UPDATE `".$textTable."` SET ".$fieldAndValuePair;
        $sqlQuery .= " WHERE TextLibID ='".$textLibID."'";
        
        $result = $this->db->executeStatement($sqlQuery);
        return(($result)?true:false);
        
    }
    public function handleResult($result,$successMessage,$errorMessage)
    {
        if($result){            
            return(json_encode(array("Status"=>1,"Message"=>$successMessage)));
      }
      else{           
      
            return(json_encode(array("Status"=>0,"Message"=>$errorMessage)));
      }
    }

    public function handleResultNew($result,$successMessage,$errorMessage)
    { 

        if($result->insert_id!=0){
            return(json_encode(array("Status"=>1,"Message"=>$successMessage)));

        }
        else{
            return(json_encode(array("Status"=>0,"Message"=>$errorMessage)));

        }
      
       
    }

    public function paginate( $tableName , $searchValue,$columnsToSearch,$sortColumn,$sortOrder,$draw,$row,$rowperpage){
        ## Total number of records without filtering
        $sel = $this->db->select("select count(*) as allcount from ".$tableName." WHERE 1 ");
        $totalRecords = (!empty($sel))? $sel[0]['allcount']:0;
        $searchQuery = " ";
        
        if(!empty($columnsToSearch) && ($totalRecords != 0)){
            if($searchValue != ''){
                $searchQuery .= " and ( ";                
            foreach ($columnsToSearch as $key=> $column) { 
                $searchQuery .= $column." like '%".$searchValue."%' ";

                if((count($columnsToSearch)-1) != $key){                    
                    $searchQuery .=" or ";
                }else {
                    $searchQuery .=") ";
                }
                
            }
             }
        }
         ## Total number of record with filtering
        
         $sel = $this->db->select("select count(*) as allcount from ".$tableName." WHERE 1 ".$searchQuery);
         $totalRecordwithFilter = (!empty($sel))? $sel[0]['allcount']:0;

        $query = "select * from ".$tableName." WHERE 1 ".$searchQuery." order by ".$sortColumn." ".$sortOrder." limit ".$row.",".$rowperpage;
        $resultRecords =  $this->db->select( $query);
        
        
        $data = array();
        foreach ($resultRecords as $key => $row) {
            $actions ='<button type="button" class="btn  btn-icon  btn-sm" onclick="editCurrency('.$row['CurrencyID'].')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button type="button" data-id='.$row['CurrencyID'].' onclick="delCurrency('.$row['CurrencyID'].')" class="btn  btn-icon  btn-sm delCrBtn"><i class="ti-trash"></i></button>' ;
            $data[] = array( 
                "CurrencyID"=>$row['CurrencyID'],
                "CurrencyName"=>$row['CurrencyName'],
                "CurrencyAbbr"=>$row['CurrencyAbbr'],
                "RateFetchAgencyName"=>$row['RateFetchAgencyName'],
                "RateFetchApiLink"=>$row['RateFetchApiLink'],
                'Actions' => $actions
            );
        }

        $response = array(
              "draw" => intval($draw),
              "iTotalRecords" => $totalRecords, 
              "iTotalDisplayRecords" => $totalRecordwithFilter,
              "aaData" => $data
        );

        return($response);

    }
    public function tempData($Uid)
    {
        $sqlQuery = "SELECT * FROM temp WHERE `Uid` ='".$Uid."' LIMIT 1";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){
            return($result[0]);
        }
        else {
            return([]);
        }
    }

    public function checkDuplicates($table ,$conditions)
    {   
        $sqlQuery = "SELECT * FROM  `".$table."`";
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        $result = $this->db->executeQuery($sqlQuery);
        if(!empty($result)){            
              return(true);
            }
        else {
              return(false);
        }
    }
    public function getMaxOrder($table ,$fldname ,$conditions)
    {   
        $sqlQuery = "SELECT max(`".$fldname."`) as maxOrder FROM  `".$table."` ";
        $sqlQuery .= ($conditions)?(" ".$conditions):" ";
        // echo $sqlQuery;
        // die();
        $result = $this->db->executeQuery($sqlQuery);    
        return((!empty($result) && $result[0]['maxOrder'] !='')?$result[0]['maxOrder']:null);
       
    }
    
    public function addAndGetID($table,$data)
    {      
        $fields="";
        $values="";
        foreach ($data as $key => $value) {
            $fields.="`".$key."`,";
            $values.="'".$value."',";
        }  
        if($fields !=""){
            $fields = rtrim($fields, ',');
            $values = rtrim($values, ',');
        }
        $sqlQuery ="INSERT INTO ".$table."( ".$fields." ) VALUES (".$values.")";
        $result = $this->db->executeInsert($sqlQuery);
      //pavan sandeep 25-09
         if(!empty($result)) {    
        //  $myfile = fopen("CrudQuerySales.txt", "w") or die("Unable to open file!");
        //  fwrite($myfile, print_r($sqlQuery."$result=".$result,1) );           
        //     return($result["ID"]);

        }
        else{  
            return(0);
        }
    }

    public function addColumn($table,$data)
    {      
           
        $fields="";
        $values="";
        foreach ($data as $key => $value) {
            
            $fields.="`".$value['keyName']."`,";
            $values.="'".$value['keyValue']."',";
            $colQ = "SHOW COLUMNS FROM `".$table."` LIKE '".$value['keyName']."'";

            $exists = $this->db->executeQuery($colQ);
            if(!$exists){
                $colQuery = "ALTER TABLE `".$table."` ADD  `".$value['keyName']."` varchar(30);";
                $resultCol = $this->db->executeStatement($colQuery);
                if($fields !="" && !empty($resultCol)){
                    $fields = rtrim($fields, ',');
                    $values = rtrim($values, ',');
                }
                $sqlQuery ="UPDATE ".$table." SET ".$value['keyName']." = '".$value['keyValue']."'";
              
                $result = $this->db->executeStatement($sqlQuery);
                
                
                return($this->handleResult($result,"Row creation successfull","Row creation failed"));
            }
            else{
                return(json_encode(array("Status"=>2,"Message"=>"Column name already exist.")));
            }
        }

        
    }

    public function delColumn($table,$data)

    {   
        $colQ= "SELECT '".$data."' FROM `".$table."`";
        $exists = $this->db->executeQuery($colQ);
        $sqlQuery = "ALTER TABLE `".$table."` DROP COLUMN `".$data."`";
        $result = $this->db->executeStatement($sqlQuery);        
        return($this->handleResult($result,"Row deletion successfull","Row deletion failed"));  
    }
    public function updateColumn($table,$data,$olddata)
    {      
           
        $fields="";
        $values="";
        foreach ($data as $key => $value) {
            $fields.="`".$value['keyName']."`,";
            $values.="'".$value['keyValue']."',";
            $colQ = "SHOW COLUMNS FROM `".$table."` LIKE '".$value['keyName']."'";
           
            $exists = $this->db->executeQuery($colQ);
            
            if(!$exists){
                if($fields !="" && !empty($resultCol)){
                    $fields = rtrim($fields, ',');
                    $values = rtrim($values, ',');
                }

                $sqlQuery = "ALTER TABLE `".$table."` DROP COLUMN `".$olddata."`";
                $result1 = $this->db->executeStatement($sqlQuery);
                
                $colQuery = "ALTER TABLE `".$table."` ADD  `".$value['keyName']."` varchar(30);";
                $result2 = $this->db->executeStatement($colQuery);

                $sqlQuery ="UPDATE ".$table." SET ".$value['keyName']." = '".$value['keyValue']."'";
                $result = $this->db->executeStatement($sqlQuery);
                
                return($this->handleResult($result,"Row Updation successfull","Row Updation failed"));            
            }
            else{
                $sqlQuery ="UPDATE ".$table." SET ".$value['keyName']." = '".$value['keyValue']."'";
                $result = $this->db->executeStatement($sqlQuery);
                
                return($this->handleResult($result,"Row Updation successfull","Row Updation failed")); 
            }
        }

        


    }
    public function updateColumnVal($table,$data,$conditions)
    {   
       
        foreach ($data as $key => $value) {        
            $sqlQuery ="UPDATE `".$table."` SET `".$key."` = ".$value." ".$conditions;
            //echo $sqlQuery;
            $result = $this->db->executeStatement($sqlQuery);
            
            return($this->handleResult($result,"Row Updation successfull","Row Updation failed"));            
        }
    }

    public function addwithID($table,$data)
    {      
           
        $primaryKey =$this->getPrimaryKeyName($table);
        if($primaryKey != null) {
            $data[$primaryKey] = $this->generateId();
            $fields="";
            $values="";
            foreach ($data as $key => $value) {
                $fields.="`".$key."`,";
                $values.="'".$value."',";
            }  
            if($fields !=""){
                $fields = rtrim($fields, ',');
                $values = rtrim($values, ',');
            }
            $sqlQuery ="INSERT INTO `".$table."` ( ".$fields." ) VALUES (".$values.")";
            $this->userlog($table,json_encode($value),"ADD");  
            $result = $this->db->executeStatement($sqlQuery);
        }
        else{
            $data[$primaryKey]= [];
        }

        return($this->handleResultwithID($result,$data[$primaryKey],"Row creation successfull","Row creation failed"));
    }


    public function handleResultwithID($result,$id,$successMessage,$errorMessage)
    {
        if($result){            
            return(json_encode(array("Status"=>1,"Message"=>$successMessage,"ID"=>$id)));
      }
      else{           
      
            return(json_encode(array("Status"=>0,"Message"=>$errorMessage,"ID"=>$id)));
      }
    }
    public function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
    
        return false;
    }
    public function cancelRecord($table,$conditions)
    {      
            $sqlQuery = "UPDATE `".$table."` SET `".$table."`.`Status`='0' ";
            $sqlQuery .= ($conditions)?(" ".$conditions):" ";
            $result = $this->db->executeStatement($sqlQuery);           
            if($result){                    
                echo json_encode(["Status"=>1,"Message" =>"Successfully Cancelled"]);
            }  
            else{
                echo json_encode(["Status"=>0,"Message" =>"Cancellation Failed"]);
            }       
    }
}

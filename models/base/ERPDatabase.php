<?php

class ForeignKeyExceptions extends Exception {
    public function __construct($msg = 0, $code = 0) {
        parent::__construct($msg, $code);
    }
}
class ERPDatabase
{ 
    protected $connection = null;
 
    public function __construct()
    {
        try {
            $this->connection = new mysqli(ERP_DB_HOST, ERP_DB_USERNAME, ERP_DB_PASSWORD, ERP_DB_DATABASE_NAME);
            mysqli_query($this->connection,"SET CHARACTER SET 'utf8'");
            mysqli_query($this->connection,"SET SESSION collation_connection ='utf8_unicode_ci'");
            if ( mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");   
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());   
        }           
    }
 
    public function select($query = "" , $params = [])
    {   
        
        try {
            $stmt = $this->executeStatement( $query );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);               
            $stmt->close();
 
            return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }
 
    public function executeStatement($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
 
            if( $params ) {
                $stmt->bind_param($params[0], $params[1]);
            }
 
            $stmt->execute();
 
            return $stmt;

        } catch(Exception $e) {

            throw New Exception( $e->getMessage() );

        }   
    }
    public function executeDelete($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
 
            if( $params ) {
                $stmt->bind_param($params[0], $params[1]);
            }
 
            $stmt->execute();
 
            return $this->connection->affected_rows;

        } catch(Exception $e) {

            throw New Exception( $e->getMessage() );
            return($e->getMessage());

        }   
    }
    public function executeQuery($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
 
            if( $params ) {
                $stmt->bind_param($params[0], $params[1]);
            }
 
            $stmt->execute();
 
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }   
    }
    public function executeInsert($query = "" , $params = [])
    {
        try {
            $stmt = $this->connection->prepare( $query );
 
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
 
            if( $params ) {
                $stmt->bind_param($params[0], $params[1]);
            }
 
            // $stmt->execute();
 
            // return $stmt->get_result();
            if ($stmt->execute()) { 
                return(array("success"=>1,"Id"=>$stmt->insert_id));
            } else {
                // KO :-(
                return(array("success"=>0,"error"=>"Sql Error"));
            }

        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }   
    }
    public function htmlRealEscapeString($TextInput){
       
        if(!empty($TextInput)){
            if(is_array($TextInput)){
                foreach($TextInput as $singleInput)
                    {
                        $DataString = mysqli_real_escape_string($this->connection,$singleInput);
                        return $DataString;
                    }
            }
            else{
              
                $DataString = mysqli_real_escape_string($this->connection,$TextInput);
                return $DataString;
             }
             
            }
             
            
        }
     
        
    
}
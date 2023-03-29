<?php 
define("DB_HOST", "192.168.3.49");
define("DB_USERNAME", "mdn");
define("DB_PASSWORD", "mdn123");
define("DB_DATABASE_NAME", "pgx"); 

define("ERP_DB_HOST", "192.168.3.26:3306");
define("ERP_DB_USERNAME", "praveen");
define("ERP_DB_PASSWORD", "Praveen1234$$");
define("ERP_DB_DATABASE_NAME","erpx_m20"); 
 session_start();
 if(isset($_SESSION['pgx']['compDB_HOST'])){  
  define("COMP_DB_HOST",$_SESSION['pgx']['compDB_HOST']);
  define("COMP_DB_USERNAME", $_SESSION['pgx']['compDB_USERNAME']);
  define("COMP_DB_PASSWORD", $_SESSION['pgx']['compDB_PASSWORD']);
  define("COMP_DB_DATABASE_NAME", $_SESSION['pgx']['compDB_DATABASE_NAME']);
}


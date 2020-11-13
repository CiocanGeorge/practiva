<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   
if (!isset($_SESSION)) {
    session_start();
}
//echo $_POST['username'];
class init {
    
  static $config_file = "config.ini";
  static $conn;
  static $pieces;
  private
            function __construct() {
        
    }
   
   public static function init_DB() {

       if(!file_exists(self::$config_file) && filter_input(INPUT_POST, 'config')==null){
           init::wh_log("start!!!");
       ?>
<html>
    <head>
		<meta charset="utf-8">
		<title>Server Setup</title>
                <meta name="description" content="Configurare">
                <meta name="author" content="Isus">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">      
	</head>
        <body id ="body">
            <h1 align="center">DB Init</h1><br><hr><br><br>
            
            <form method="POST" action="#" align="center" name="config">
                <p align = "center" >Username</p><input type="text" id="username" name="username"><br>
                <p align = "center" >Password</p><input type="password" id="password" name="password"><br>
                <p align = "center" >Server name</p><input type="text" id="servername" name="servername"><br>
                <p align = "center" >Port</p><input type="number" id="port" name="port"><br>
                <p align="center"><input type="submit" name="config" value="Configureaza"></p>
                
            </form>
            
        </body>
    
</html>
            
       
       <?php
       
  
       }
       /*
        * 
        * 
        */
      if (filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING)!=null && filter_input(INPUT_POST, 'servername',FILTER_SANITIZE_STRING)!=null && 
               filter_input(INPUT_POST, 'port',FILTER_SANITIZE_NUMBER_INT)!=null &&!file_exists(self::$config_file) ){
         
           
           if (!isset($_SESSION['key'])) {
            $key = init::random_str(random_int(3, 35));
            
            $_SESSION['key'] = $key;
        } else {
            $key = $_SESSION['key'];
        }
           $myfile = fopen(self::$config_file, "w+");
          // chmod($this->config_file, 0600);
           
           
           if(flock($myfile, LOCK_EX)){
               $str = filter_input(INPUT_POST, 'password',FILTER_SANITIZE_STRING);
                
                $encryption_key = 'randomshit';
                $iv = openssl_random_pseudo_bytes(16);
                $encrypted = openssl_encrypt($str, 'AES-256-CBC', $encryption_key, 0, $iv);
                $data =  $iv.'.'.$encrypted;
                
                
                $user = filter_input(INPUT_POST, 'username');
                $server = filter_input(INPUT_POST, 'servername');
                $port = filter_input(INPUT_POST, 'port');
               
                
                
                fwrite($myfile, "$user,$data,$server,$port");
                fseek($myfile, 0);
                $read = fread($myfile, 1024);
                self::$pieces = explode(",", $read);
                self::$pieces[1] =$str;
                
           }
          init::wh_log("Writing to file Done!");
       }else if(file_exists(self::$config_file)){
            $myfile1 = fopen(self::$config_file, "r");
                init::wh_log("File opened: ".$myfile1);
            if (flock($myfile1, LOCK_EX)) {
                fseek($myfile1, 0);
                $str = fread($myfile1, 1024);
                init::wh_log("FIle Contents read: ".$str);
                self::$pieces = explode(",", $str);
              
                
                 $encryption_key = 'randomshit';
                 
                 $pcs = explode(".", self::$pieces[1]);
                $iv = $pcs[0];
                $enc = $pcs[1];
           
                $decrypted = openssl_decrypt($enc, 'AES-256-CBC', $encryption_key, 0, $iv);

               self::$pieces[1] = $decrypted;
               fclose($myfile1);
            }
       }
       
        if (!empty(self::$conn)) {
            return self::$conn;
        } //end if
        
        if (file_exists(self::$config_file)) {
            try {
                  
                $dbh = new PDO('mysql:host=' . self::$pieces[2] . ';port=' . self::$pieces[3] . ';dbname=' . 'combinatii', self::$pieces[0], self::$pieces[1], array(
                    PDO::ATTR_PERSISTENT => true
                ));
                
                //CHECK AND CREATE DATABASES;
              $ans=$dbh->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'combinatii'");
	if($ans->execute())
	{
		//check for tables; 
            //ingredient
            $tbls =  $dbh->prepare("SELECT * FROM information_schema.tables WHERE table_schema = 'combinatii' AND table_name = 'ingredient' LIMIT 1;");
            if($tbls->execute()){
                    //nothing to do
             }else{
                  $dbh->query("CREATE TABLE `ingredient`(`Denumire` varchar(50) not null, `Descriere` varchar(200) not null)");
              }
              //preparat
               $tbls =  $dbh->prepare("SELECT * FROM information_schema.tables WHERE table_schema = 'combinatii' AND table_name = 'preparat' LIMIT 1;");
            if($tbls->execute()){
                    //nothing to do
             }else{
                 $dbh->query("CREATE TABLE `preparat`(`Denumire` varchar(50) not null,`Gramaj` int(10) not null,`Descriere` varchar(200) not null)");
              }
              
              //prepingr
                 $tbls =  $dbh->prepare("SELECT * FROM information_schema.tables WHERE table_schema = 'combinatii' AND table_name = 'prepingr' LIMIT 1;");
            if($tbls->execute()){
                    //nothing to do
             }else{
                 $dbh->query("CREATE TABLE `prepingr`(`preparat` varchar(20) not null,`ingredient` varchar(20) not null,`gramaj` int(12) not null)");
              }
		
	}
	else
	{
		/*$crt=*/$dbh->query("create database combinatii");
	}
        
        

                self::$conn = $dbh;
                return $dbh;
            } catch (PDOException $e) {
                print "Error! : " . $e->getMessage() . "<br/>";
                die();
            }
        }
    }
    
    static function getCon(){
        if(self::$conn==null){
            return self::init_DB();
        }else
            return self::$conn;
    
    }

     static function random_str($length) {
        $keyspace = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
  static  function wh_log($log_msg)
{
    $log_filename = "log";
    if (!file_exists($log_filename)) 
    {
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
  
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
} 
   
    
    
    
}







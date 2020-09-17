<?php
	 require './init.php';
	
	//conectare BD
	
	$con = init::getCon();
	//verificare conectiune
	$prep=filter_input(INPUT_POST, 'preparat',FILTER_SANITIZE_STRING);
	$ing=filter_input(INPUT_POST, 'ingredient',FILTER_SANITIZE_STRING);
	$gram=filter_input(INPUT_POST, 'gramaj',FILTER_SANITIZE_STRING);
        
       $ispresent=  $con->query("Select preparat  from prepingr where preparat ='".$prep."' and "
                . " ingredient='".$ing."'");
         $info = $ispresent->fetch(PDO::FETCH_ASSOC);
          if(!isset($info['preparat'])){
              $sql="INSERT INTO prepingr (preparat,ingredient,gramaj) VALUES ('$prep','$ing','$gram')";
	 $ins = $con->prepare($sql);
	if($ins->execute())
	{
		
		header("Location: alege.php");
		exit();
	}
	else
	{
		echo "eroare";
	}
              
          } else {
              

	
	//$sql="INSERT INTO prepingr (preparat,ingredient,gramaj) VALUES ('$prep','$ing','$gram')";
        $sql = "update prepingr set gramaj = '".$gram."' where preparat='".$prep."' and "
                . " ingredient='".$ing."'";
	 $ins = $con->prepare($sql);
	if($ins->execute())
	{
		
		header("Location: alege.php");
		exit();
	}
	else
	{
		echo "eroare";
	}
	}
	$con->close();
	
 

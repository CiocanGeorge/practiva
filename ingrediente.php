 <?php
	 require './init.php';
         $con = init::init_DB();
         
	$denum=filter_input(INPUT_POST, 'denumire',FILTER_SANITIZE_STRING);
	$desc=filter_input(INPUT_POST, 'descriere',FILTER_SANITIZE_STRING);
	
	$sql="INSERT INTO ingredient (Denumire,Descriere) VALUES ('$denum','$desc')";
       $ins = $con->prepare($sql);

	
	
	
	if($ins->execute())
	{
		header("Location: home.php");
		exit();
	}
	else
	{
		echo "eroare";
	}
	
	$con->close();
 
 ?>
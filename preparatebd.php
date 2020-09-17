  <?php
	require './init.php';
         
	$denum=filter_input(INPUT_POST, 'denumire',FILTER_SANITIZE_STRING);
	$desc=filter_input(INPUT_POST, 'descriere',FILTER_SANITIZE_STRING);
	$gram=filter_input(INPUT_POST, 'gramaj',FILTER_SANITIZE_STRING);
	
	
	
	$con = init::getCon();
	

	$sql="INSERT INTO preparat (Denumire,Gramaj,Descriere) VALUES ('$denum','$gram','$desc')";
        
	 $ins = $con->prepare($sql);
	if($ins->execute())
	{
		echo "succes"; 
		header("Location: preparate.php");
		exit();
	}
	else
	{
		echo "eroare";
	}
	
	$con->close();

 
 ?>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "combinatii";
	
	$prep=$_POST["preparat"];
	$ing=$_POST["ingredient"];
	$gram=$_POST["gramaj"];
	
	
	//conectare BD
	
	$con=new mysqli($servername,$username,$password,$dbname);
	//verificare conectiune
	if($con->connect_error)
		die("Connection failed: ". $con->connect_error);
	
	$sql="INSERT INTO prepingr (preparat,ingredient,gramaj) VALUES ('$prep','$ing','$gram')";
	
	if($con->query($sql)===TRUE)
	{
		
		header("Location: alege.php");
		exit();
	}
	else
	{
		echo "eroare";
	}
	
	$con->close();
	
 
 ?>
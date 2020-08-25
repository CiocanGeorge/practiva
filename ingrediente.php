 <?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ingrediente";
	
	$denum=$_POST["denumire"];
	$desc=$_POST["descriere"];
	echo $denumireee;
	
	//conectare BD
	
	$con=new mysqli($servername,$username,$password,$dbname);
	//verificare conectiune
	if($con->connect_error)
		die("Connection failed: ". $con->connect_error);
	
	$sql="INSERT INTO ingredient (Denumire,Descriere) VALUES ('$denum','$desc')";
	
	if($con->query($sql)===TRUE)
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
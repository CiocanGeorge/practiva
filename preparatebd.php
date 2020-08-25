  <?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "preparate";
	
	$denum=$_POST["denumire"];
	$desc=$_POST["descriere"];
	$gram=$_POST["gramaj"];
	
	
	//conectare BD
	
	$con=new mysqli($servername,$username,$password,$dbname);
	//verificare conectiune
	if($con->connect_error)
		die("Connection failed: ". $con->connect_error);
	
	$sql="INSERT INTO preparat (Denumire,Gramaj,Descriere) VALUES ('$denum','$gram','$desc')";
	
	if($con->query($sql)===TRUE)
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
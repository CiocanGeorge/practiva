 <?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ingrediente";
	
	
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



$result = mysql_query("SELECT id,link FROM mytable Order By id DESC LIMIT 0,5");
$new_array[] = $row;
while ($row = mysql_fetch_array($result)) {
    $new_array[$row['id']] = $row;
    $new_array[$row['link']] = $row;
}

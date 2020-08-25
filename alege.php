<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "preparate";
$dbname1 = "ingrediente";
$con=new mysqli($servername,$username,$password,$dbname);
$con1=new mysqli($servername,$username,$password,$dbname1);
$query="SELECT * FROM `preparat`";
$query1="SELECT * FROM `ingredient`";
$result=mysqli_query($con,$query);
$result1=mysqli_query($con1,$query1);
$result2=mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ciocan</title>
		<link rel="stylesheet" href="alege.css">
	</head>
	<body>
		<nav>
			<label class="logo">Ciocan George Nicolae</label>
			<ul>
				<li><a href="home.php" class="active" >Ingrediente</a></li>
				<li><a href="preparate.php" class="active">Preparate</a></li>
				<li><a href="alege.php">Alegere</a></li>
				<li><a href="afisare.php">Afisare</a></li>
			</ul>
		</nav>
		</br>
		
		<div>
		<form action="trimite.php" method="post" >
		<p>Preparat:
		<select name="preparat" id="preparat">
			<?php while($row1=mysqli_fetch_array($result)):;?>
			<option><?php echo $row1[0];?><option>
			<?php endwhile;?>
		</select>
		</p>
		<p>Ingredient:
		<select name="ingredient" id="ingredient">
			<?php while($row1=mysqli_fetch_array($result1)):;?>
			<option><?php echo $row1[0];?><option>
			<?php endwhile;?>
		</select>
		</p>
		
		
			<label>Gramaj:</label> 
			<input type="text" name="gramaj"></br>
		
		
	
		<input type="submit" value="Salveaza">
	
		</form>
		</div>
	</body>
</html>
		
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ciocan</title>
		<link rel="stylesheet" href="preparate.css">
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
		
		<form action="preparatebd.php" method="post" class="preparate">
			<label>Denumire:</label> 
			<input type="text" name="denumire"></br>
			<label>Gramaj:</label>
			<input type="text" name="gramaj"></br>
			<label>Descriere:</label>
			<input type="text" name="descriere"></br>
			<input type="submit" value="Salveaza">
		</form>
	</body>
</html>
		
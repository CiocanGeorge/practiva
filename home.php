<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ciocan</title>
		<link rel="stylesheet" href="home.css">
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
		<form action="ingrediente.php" method="post" class="ingredient">
			<label>Denumire:</label> 
			<input type="text" name="denumire"></br>
			<label>Descriere:</label>
			<input type="text" name="descriere"></br>
			<input type="submit" value="Salveaza">
		</form>
		</div>
	</body>
</html>
		
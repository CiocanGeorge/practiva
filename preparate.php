<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="preparate.css">
        
    </head>
	
		<?php include 'header.php';?>
		</br></br>
		
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
		
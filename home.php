<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="alege.css">
    </head>
        <?php
        include './init.php';
        if(init::init_DB()){
        include 'header.php';
        ?>
    <body>
    </br></br>
                
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
        <?php
       }
       ?>
</html>
		
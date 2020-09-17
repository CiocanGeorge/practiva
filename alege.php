<?php
 session_start();
 require './init.php';
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "combinatii";
$con = new mysqli($servername, $username, $password, $dbname);
$con1 = new mysqli($servername, $username, $password, $dbname);*/
$con = init::getCon();
$query = "SELECT Distinct Denumire FROM `preparat`";
$query1 = "SELECT Distinct Denumire FROM `Ingredient`";

$result = $con->query($query);
$result1 = $con->query($query1);
$result2 = $con->query($query);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="alege.css">
    </head>
    <?php include 'header.php'; ?>

    </br></br>

    <div>
        <form action="trimite.php" method="post" >
            <p>Preparat:
                <select name="preparat" id="preparat">
                    <?php
                   /* while ($row1 = mysqli_fetch_assoc($result)) {
                        foreach ($row1 as $key => $value) {
                            ?><option><?php echo $value; ?></option><?php
                        }
                    }*/
                    while(($row = $result->fetch()) != false) {
                        ?><option><?php echo $row['Denumire']; ?></option><?php
                    }
                    ?>
                </select>
            </p>
            <p>Ingredient:
                <select name="ingredient" id="ingredient">
<?php
                while(($row = $result1->fetch()) != false) {
                        ?><option><?php echo $row['Denumire']; ?></option><?php
                    }

                    ?>

                </select>
            </p>


            <label>Gramaj:</label> 
            <input type="text" name="gramaj"></br>
            <input type="submit" value="Salveaza">

        </form>
    </div>
</body>
</html>

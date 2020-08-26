
<!DOCTYPE html>
<html>


	<head>
		<meta charset="utf-8">
		<title>Ciocan</title>
		<link rel="stylesheet" href="afisare.css">
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
		
		<table style="width:100%">
			
			<?php
			$con = mysqli_connect("localhost", "root", "", "combinatii");
			// Check connection
			if ($con->connect_error) {
				die("Connection failed: " . $con->connect_error);
			}
			$querycol="SELECT DISTINCT `preparat` FROM `prepingr`";
			$querylinie="SELECT DISTINCT `ingredient` FROM `prepingr`";
			#$querygram="SELECT DISTINCT `gramaj` FROM `prepingr`";
			$resultcol=mysqli_query($con,$querycol);
			$resultlinie=mysqli_query($con,$querylinie);
			#$resultgram=mysqli_query($con,$querygram);
			
			echo "<tr><th></th>";
			$lista=array();
			while($row1=mysqli_fetch_array($resultlinie))
			{
				
				
				foreach($row1 as $data)
				{
					$lista[]=$data;
					echo "<th align='center'>". $data . "</th>";
					break;
				}
				
			}
			echo "</tr>";
			
			
			
			while($row2=mysqli_fetch_array($resultcol))
			{
				echo "<tr>";
				foreach($row2 as $data)
				{
					 echo "<th align='center'>". $data ."</th>";#. "</th></tr>";
					for($i=0;$i<count($lista);$i=$i+1)
					{
					$query1="SELECT DISTINCT `gramaj` FROM `prepingr` WHERE preparat='".$data."' AND ingredient='".$lista[$i]."'";
					$res=mysqli_query($con,$query1);
				
					
	
					
					 if(($row3=mysqli_fetch_array($res))!=0)
					{
						echo "<th>".$row3['gramaj']."</th>";
					}
					else
						 echo "<th></th>";
					}
					 
					 break;
				}
				echo "</tr>";
			}
			
		
			?>
			</table>
		
		</div>
	</body>
</html>
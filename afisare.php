
<!DOCTYPE html>
<html>


	
	<?php include 'header.php';?>
        <style>
<?php include 'afisare.css'; ?>
</style>
        </br></br>
		<div>
		
		<table class="table" id="table">
			
			<?php
			$con = mysqli_connect("localhost", "root", "", "combinatii");
			// Check connection
			if ($con->connect_error) {
				die("Connection failed: " . $con->connect_error);
			}
			$querycol="SELECT DISTINCT `Denumire` FROM `preparat`";
			$querylinie="SELECT DISTINCT `Denumire` FROM `ingredient`";
			#$querygram="SELECT DISTINCT `gramaj` FROM `prepingr`";
                        $queryColNames =  "SELECT `COLUMN_NAME` 
                                            FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                                            WHERE `TABLE_SCHEMA`='combinatii' 
                                            AND `TABLE_NAME`='prepingr'";
                        $queryIngr = "Select Distinct denumire from ingredient";
                        
			$resultcol=mysqli_query($con,$querycol);
			$resultlinie=mysqli_query($con,$querylinie);
			#$resultgram=mysqli_query($con,$querygram);
                        $resultColsNames = mysqli_query($con,$queryColNames);
                        $resultIngr = mysqli_query($con,$queryIngr);

                        $rowColNames = mysqli_fetch_array($resultColsNames);
                        
                                
			echo "<tr><th>".$rowColNames[0]."</th>";
                        
                        $contorIngr = 0;
                        
                        
                        while ($rowIngrediente = mysqli_fetch_assoc($resultIngr)) {
                             foreach ($rowIngrediente as $key => $value) {
                               echo("<th>".$value."</th>");
                               $contorIngr++;
                        }
                    }

                     echo  "</tr>";
			$lista=array();
			while($row1=mysqli_fetch_array($resultlinie))
			{
				
				
				foreach($row1 as $data)
				{
					$lista[]=$data;
					//echo "<td align='center'>". $data . "</td>";
					break;
				}
				
			}
			//echo "</tr>";
			
			
			
			while($row2=mysqli_fetch_array($resultcol))
			{
				echo "<tr>";
				foreach($row2 as $data)
				{
					 echo "<td align='center'>". $data ."</td>";#. "</th></tr>";
					for($i=0;$i<count($lista);$i=$i+1)
					{
					$query1="SELECT DISTINCT `gramaj` FROM `prepingr` WHERE preparat='".$data."' AND ingredient='".$lista[$i]."'";
					
                                            $res=mysqli_query($con,$query1);
				
					
	
					
					 if(($row3=mysqli_fetch_array($res))!=0)
					{
						echo "<td align='center' class='tdborder'>".$row3['gramaj']."</td>";
					}
                                       
					else
						 echo "<td></td>";
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
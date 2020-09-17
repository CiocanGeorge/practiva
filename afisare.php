
<!DOCTYPE html>
<html>


	
	<?php 
        session_start();
        require './init.php';
        include 'header.php';?>
        <style>
<?php include 'afisare.css'; ?>
</style>
        </br></br>
		<div>
		
		<table class="table" id="table">
			
			<?php
			$con = init::getCon();

			$querycol="SELECT DISTINCT `Denumire` FROM `preparat`";
			$querylinie="SELECT DISTINCT `Denumire` FROM `ingredient`";
			
                        $queryColNames =  "SELECT `COLUMN_NAME` 
                                            FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                                            WHERE `TABLE_SCHEMA`='combinatii' 
                                            AND `TABLE_NAME`='prepingr' limit 1";
                        $queryIngr = "Select Distinct denumire from ingredient";
                        
                  
                        
			$resultcol=$con->query($querycol); /*mysqli_query($con,$querycol);*/
			$resultlinie=$con->query($querylinie);
		
                        $resultColsNames = $con->query($queryColNames);
                        $resultIngr = $con->query($queryIngr);

  
                        echo "<tr>";
                        while ($row = $resultColsNames->fetch(PDO::FETCH_ASSOC))  {

                          echo "<th>".$row['COLUMN_NAME']."</th>";  
                        }
                        
                        $contorIngr = 0;
                        $lungime = 0;
                        $lista;
                        
                        while ($row = $resultlinie->fetch(PDO::FETCH_ASSOC))  {   
                                $lista[$contorIngr] = $row['Denumire'];
                               echo("<th>".$row['Denumire']."</th>");
                             $contorIngr=$contorIngr+1;
                     
                    }

                     echo  "</tr><tr>";
                      while ($row1 = $resultcol->fetch(PDO::FETCH_ASSOC))  {
                             echo "<td>".$row1['Denumire']."</td>";
                            init::wh_log($row1['Denumire']);

                            for($i=0;$i<count($lista);$i=$i+1){
                                    $querygGramaj = "SELECT DISTINCT `gramaj` FROM `prepingr` WHERE preparat='".$row1['Denumire']."' AND ingredient='".$lista[$i]."'";
                                 //   init::wh_log($querygGramaj);
                                     $resultQuery = $con->query($querygGramaj);
                                    
                                   
                                    $row4 = $resultQuery->fetch(PDO::FETCH_ASSOC);

                                  // $total_rating_votes = $row4['gramaj'];
                                     
                                 if(!isset($row4['gramaj'])){
                                   echo "<td></td>";
                                    }else{
                                          echo "<td>". $row4['gramaj']."</td>";
                                    }  
                                      
                             } 
                                                     
                             echo "</tr>";

                             }
               
                 
			?>
			</table>
		
		</div>
	</body>
</html>
<?php
include ("db.php"); //include db.php file to connect to DB
$pagename="Make your home smart"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4><center>".$pagename."</h4>";
//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="select prodId, prodName, prodPicNameSmall,prodDescripLong ,prodPrice from product";
//run SQL query for connected DB or exit and display error message
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
echo "<table style='border: 0px'>";
//create an array of records (2 dimensional variable) called $arrayp.
//populate it with the records retrieved by the SQL query previously executed. 
//Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp=mysqli_fetch_array($exeSQL))
{
echo "<tr>";
echo "<td style='border: 0px'>";
//make the image into an anchor to prodbuy.php and pass the product id by URL (the id from the array)
echo "<a href=prodbuy.php?u_prod_id=".$arrayp['prodId'].">";
//display the small image whose name is contained in the array
echo "<img src=images/".$arrayp['prodPicNameSmall']." height=200 width=200>";
echo "</td>";
echo "<td id='table1' style='border: 0px'>";
echo "<p><h2>".$arrayp['prodName']."</h2>"; //display product name as contained in the array
echo "<p>".$arrayp['prodDescripLong']; 
echo "<p><h5><b>&pound".$arrayp['prodPrice']."</h5></b>";
// echo "<p style='border: 0px'><input type=reset value='See More'  id='seemore'> </p>";  
// echo '<a href="http://programminghead.com"><input type="submit"/></a>';
echo "</td>";
echo "</tr>";
}
echo "</table>";
include ("footfile.html");
echo "</body>";
?>

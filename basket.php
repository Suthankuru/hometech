<?php

// Starting the session:
session_start();

include ("db.php");
$pagename="Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
// echo "<h4><center>".$pagename."</h4>"; //display name of the page as window title
echo "<body>";

include ("headfile.html"); //include header layout file
echo "<h4><center>".$pagename."</h4>"; //display name of the page on the web page

if ( isset($_POST['h_prodid']) ) {

$newprodid = $_POST['h_prodid'];
$reququantity = $_POST['p_quantity'];

// echo "ID of selected product: ".$newprodid."<br>";
// echo "Quantity of selected product: ".$reququantity;

//create a new cell in the basket session array. Index this cell with the new product id.
//Inside the cell store the required product quantity
$_SESSION['basket'][$newprodid] = $reququantity;
echo "<p><b>1 item added</b>";

}
else {
echo "Basket unchanged";
}

$total = 0;

echo "<table id='baskettable'>";
echo "<tr>
    <th>Product name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Subtotal</th>
    <th>Remove Product</th>
</tr>";

if ( isset( $_SESSION['basket'] ) ) {
    foreach($_SESSION['basket'] as $key => $value)
	{	
		$SQL="select prodId,prodName,prodPrice from product where prodId = '".$key."';";
		//Create a new variable containing the execution of the SQL query i.e. select the records or get out
		$exeSQL=mysqli_query($conn,$SQL) or die (mysqli_error());
		$arrayprod=mysqli_fetch_array($exeSQL);
		echo "<tr>
		<td>".$arrayprod['prodName']."</td>
		<td>".$arrayprod['prodPrice']."</td>
		<td>".$value."</td>
		<td> Rs ".$arrayprod['prodPrice']*$value."</td>";
		$total = $total+($arrayprod['prodPrice']*$value);
		echo "<form action=basket.php method=post>";
        echo "<td>";
        // echo "<input type=submit value='Remove'>";
        echo "<input type=submit value='Remove' name='submitbtn' id='submitbtn'>"; 
        echo "</td>";
        echo "<input type=hidden name=del_prodid value=".$arrayprod['prodId'].">";
        echo "</form>";
	}

		}
else{
	    echo "Empty Basket";
	}
		echo "<tr><td colspan='4'>Total</td><td>Rs ".$total."</td></tr></table>";
		echo "<a href='clearBasket.php'>Clear the basket</a>";
		echo "<br><br>";
		echo "New hometeq customers :<a href='signup.php'> Sign Up</a>";
		echo "<br>";
		echo "Returning HomeTeq Customers : <a href='login.php'> Login</a>";
        
	
		if (isset($_POST['del_prodid']))
		{
		//capture the posted product id and assign it to a local variable $delprodid
		$delprodid=$_POST['del_prodid'];
		//unset the cell of the session for this posted product id variable
		unset ($_SESSION['basket'][$delprodid]);
		//display a "1 item removed from the basket" message
		header("Refresh:0");
		echo "<p>1 item removed";
		}
		
include("footfile.html"); //include head layout
echo "</body>";
?>
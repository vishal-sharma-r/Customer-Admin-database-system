<?php
$insert = false;
session_start();
// Assuming you have already established the MySQL database connection
$server = "localhost";
$username = "root";
$password = "";
$db = "user";
$con = mysqli_connect($server ,$username, $password, $db);

if(!$con)
{
    die("Connection to this database failed due to ". mysqli_connect_error());
}

if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}
$username = $_SESSION["username"];
if(isset($_POST['orderdate']))
{
 

  $orderdate = $_POST['orderdate'];
  $company = $_POST['company'];
  $owner = $_POST['owner'];
  $item = $_POST['item'];
  $quantity = $_POST['quantity'];
  $weight = $_POST['weight'];
  $shipment = $_POST['shipment'];
  $trackingId = $_POST['trackingId'];
  $shipmentSize = $_POST['shipmentSize'];
  $boxCount = $_POST['boxCount'];
  $specification = $_POST['specification'];
  $checklistQuantity = $_POST['checklistQuantity'];

  // Insert into table
  $query = "INSERT INTO `customer` (`id`, `orderdate`, `company`, `owner`, `item`, `quantity`, `weight`, `shipment`, `trackingId`, `shipmentSize`, `boxCount`, `specification`, `checklistQuantity`) VALUES ('$username', '$orderdate', '$company', '$owner', '$item', '$quantity', '$weight', '$shipment', '$trackingId', '$shipmentSize', '$boxCount', '$specification', '$checklistQuantity')
  on duplicate key update id = '$username', orderdate = '$orderdate', company = '$company',   owner = '$owner', item = '$item',quantity =  '$quantity', weight = '$weight', shipment = '$shipment', trackingId = '$trackingId', shipmentSize = '$shipmentSize', trackingId = '$boxCount', specification = '$specification', checklistQuantity = '$checklistQuantity' 
  ";
  if($con->query($query) == true){
    // echo "successfully inserted";
    $insert = true;
  }
  $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User page</title>
    <link rel="stylesheet" href="style_user.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&family=Sriracha&display=swap"
      rel="stylesheet"
    />
</head>
<body>
    <div class="container">
        <?php 
        if($insert)
        {
          echo "<h3 class = 'submitMsg'> Your data inserted Submitted Successfully ❤ </h3>";
        }
        ?>
        <h1> This is customer page</h1>
        <p>
        <?php 
        echo $_SESSION["username"]."<p>Enter your details</p>";
        ?>
        <form action="#" method="POST">
          <input
            type="text"
            name="orderdate"
            id="orderdate"
            placeholder="Order date"
            onfocus="(this.type='date')"
            required
          />
          <input type="text" name="company" id="company" placeholder="Company" required />
          <input
            type="text"
            name="owner"
            id="owner"
            placeholder="Owner "
            required
          />
          <input
            type="text"
            name="item"
            id="item"
            placeholder="Item"
            required
          />
          <input
            type="text"
            name="quantity"
            id="quantity"
            placeholder="Quantity"
            required
          />
          <input
            type = "text"
            name="weight"
            id="weight"
            placeholder="Weight"
            required
          />
          <input
            type = "text"
            name="shipment"
            id="requestShipment"
            placeholder="Request for Shipment"
            required
          />
          <input
            type = "text"
            name="trackingId"
            id="trackingId"
            placeholder="Tracking ID"
            required
          />
          <input
            type = "text"
            name="shipmentSize"
            id="shipmentSize"
            placeholder="Shipment Size"
            required
          />
          <input
            type = "text"
            name="boxCount"
            id="boxCount"
            placeholder="Box Count"
            required
          />
          <input
            type = "text"
            name="specification"
            id="specification"
            placeholder="Specification"
            required
          />
          <input
            type = "text"
            name="checklistQuantity"
            id="checklistQuantity"
            placeholder="Checklist Quantity"
            required
          />
          <button class="btn">Submit</button>
        </form>
     <p> <a  href="logout.php"><button class="btn"> Logout</button></a></p>
    </div>
    <script src="index.js"></script> 
  </body>
</html>

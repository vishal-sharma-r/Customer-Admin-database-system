<?php
session_start();
if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}

$server = "localhost";
$username = "root";
$password = "";
$db = "user";
$con = mysqli_connect($server ,$username, $password, $db);

if(!$con)
{
    die("Connection to this database failed due to ". mysqli_connect_error());
}

$id = $_SESSION['username'];

if ($id == 'admin') {

    $sql = "SELECT quantity, weight, boxCount FROM customer ";
    $res = mysqli_query($con, $sql);
    
    $sumquantity = 0;
    $sumweight = 0;
    $sumbox = 0;

    if ($res->num_rows > 0) {
        // output data of each row
        while($row = $res->fetch_assoc()) {
        //   echo "quantity: " . $row["quantity"]. " - weight: " . $row["weight"]. " box count " . $row["boxCount"]. "<br>";
          $sumquantity += $row['quantity'];
          $sumweight += $row['weight'];
          $sumbox += $row['boxCount'];
        }
      } else {
        echo "0 results";
      }
} else {
    echo "Access denied. You are not authorized to view this page.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="admin.css">

    <style>
       
        </style>
</head>
<body class = "bodyy">

    <h1> Admin Loged In</h1>
    <div class = 'center'>
            <table>
            <tr>
                <th><p>Item/Customer</p></th>
                <th class = 'head-color'><p>Customer1<p></th>
                <th class = 'head-color'><p>Customer2<p></th>
                <th class = 'head-color'><p>Total<p></th>
            </tr>
            <tr>
                <td class = 'yellow'><p>Quantity</p></td>
                <td><p><?php   $stmt = $con->query("SELECT quantity FROM customer WHERE id ='customer1'");
                  $col = $stmt->fetch_assoc();
                    echo $col['quantity']; ?></p></td>
                <td><p><?php   $stmt = $con->query("SELECT quantity FROM customer WHERE id ='customer2'");
      $col = $stmt->fetch_assoc();
        echo $col['quantity']; ?></p></td>
                <td><p> <?php echo  $sumquantity ?></p></td>
            </tr>
            <tr>
                <td class = 'yellow'><p>Weight</p></td>
                <td><p><?php   $stmt = $con->query("SELECT weight FROM customer WHERE id ='customer1'");
      $col = $stmt->fetch_assoc();
        echo $col['weight']; ?></p></td>
                <td><p><?php   $stmt = $con->query("SELECT weight FROM customer WHERE id ='customer2'");
      $col = $stmt->fetch_assoc();
        echo $col['weight']; ?></p></td>
                <td><p><?php echo  $sumweight ?> </p></td>
            </tr>
            <tr>
                <td class = 'yellow'><p>Box Count</p></td>
                <td><p><?php   $stmt = $con->query("SELECT boxCount FROM customer WHERE id ='customer1'");
      $col = $stmt->fetch_assoc();
        echo $col['boxCount']; ?></p></td>
                <td><p><?php   $stmt = $con->query("SELECT boxCount FROM customer WHERE id ='customer2'");
      $col = $stmt->fetch_assoc();
        echo $col['boxCount']; ?></p></td>
                <td><p><?php echo  $sumbox ?> </p></td>
            </tr>
            
            </table>
            <p> <a  href="logout.php"><button class="btn"> Logout</button></a></p>
</div>

</body>
</html>

<?php
$con->close();

?>
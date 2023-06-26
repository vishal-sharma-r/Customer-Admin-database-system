<?php

  $host = "localhost";
  $user = "root";
  $password = "";
  $db = "user";

  session_start();
  $data = mysqli_connect($host,$user,$password,$db);
  if($data == false){
    die("connection_error()");
  }
  else{
    // echo "Database connected";
  }

  // condition for login
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "select * from login where username ='".$username."' AND password ='".$password."' ";

    $result = mysqli_query($data,$sql);
    $row = mysqli_fetch_array($result);
    if($row["usertype"]=="user")
    {
      // echo "user"; 
      $_SESSION["username"] = $username;

      header("location:userhome.php");
    }
    else if($row["usertype"]=="admin")
    {
      // echo "admin"; 
      $_SESSION["username"] = $username;

      header("location:adminhome.php");
    }
    else{
      echo "username or password incorrect";
    }
    $data->close();
  }
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Intershala</title>
    <link rel="stylesheet" href="style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="wrapper">
        <div id="formContent">
          <form action="#" method="POST">
            <input type="text" id="login" name="username" placeholder="id" required>
            <input type="text" id="password" name="password" placeholder="password" required>
            <button type="submit" class="button">Sign IN</button>
          </form>
      
      
        </div>
      </div>
    <script src="index.js"></script>
  </body>
</html>

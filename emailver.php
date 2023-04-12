<?php
session_start();
include 'connectdb.php';


$accessemail=$_SESSION['emailtoverify'];

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

.cls {
  /*box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);*/
  transition: 0.3s;
  width: 47%;
  background-color: dimgray;
  color: white;
  border-radius: 5px;
  height: 200px;
  margin-left: 2%;
  margin-top: 5%
}


</style>

</head>
<body>
<div class="container">

<div class="row">
<?php 
$fotp=$_COOKIE['otp'];
$numlength = strlen((string)$fotp);
?>
<br><br><br><br><br><br>
  <form action="" method="post">
<center>
    <div class="form-group">
      <label for="otp">Enter Verfication Code:</label><br><br>
        <input type="number" name="votp" style="height: 50px; padding: 20px; width: 50%" class="form-control" >
        <input type="hidden" name="sotp" value="<?php  echo $fotp; ?>" >
        <input type="hidden" name="slength" value="<?php  echo $numlength; ?>" >
    </div>
 <br>
    <button type="submit" name="verifyotp" class="btn btn-default">Submit</button>
</center>   
</form>

  </div>

  <?php 
if(isset($_POST['verifyotp']))
{
  $votp=$_POST['votp'];
  $sotp=$_POST['sotp'];
  $slength=$_POST['slength'];

// for General 

  if($votp==$sotp)
  {
    $conn=openConnection();
    $email = $_SESSION['emailtoverify'];
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    $pw = $_SESSION['password'];
    $stmt = $conn->prepare("INSERT INTO users (email ,username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss",$email ,$username ,$pw ,$role);
    $stmt->execute();

    include 'redirection.php';
    redirect('checkproduct.php');
  }
  else
  {
      echo "<script>alert('Verification Faild');</script>";
  }

}

  ?>
    
</div>
</body>


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
</html>
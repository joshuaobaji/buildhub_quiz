<?php
$login=0;
$invalid=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include "include/connection.php";
    $username=$_POST['username'];
    $password=$_POST['password'];


    // $sql="select * from rexregister where username='$username' and password='$password'";

    // Fetch the hashed password from the database based on the entered username
    $getHashedPasswordQuery = "SELECT password FROM rexregister WHERE username = '$username'";
    $result = mysqli_query($con, $getHashedPasswordQuery);


    $result=mysqli_query($con,$getHashedPasswordQuery);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0) {
            $login=1;
            session_start();
            $_SESSION['username']=$username;
    
            header('location:dashboard.php');
            
        } else {
            $invalid=1;
          
        }
    
    }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" type="text/css"> 
    <title>Login Page</title>
  </head>
  <body>
  <?php
if($login){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> You are successfully logged in.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>
<?php
if($invalid){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Sorry</strong> Invalid credentials please sign up<a href="index.php"> here</a>.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>

<h3 class="display-4 text-center mt-5">Login Here</h3>
    <div class="container mt-5">
    <form action="login.php" method="POST">
      <div class="form-group">
         <label for="exampleInputEmail1">Username</label>
         <input type="text" class="form-control" placeholder="Enter your username" name="username" >
      </div>
      <div class="form-group">
         <label for="exampleInputPassword1">Password</label>
         <input type="password" class="form-control"  placeholder="Enter your Password" name="password">
       </div>
  <button id="btn" type="submit" class="btn btn-primary w-100"><span>Login</span></button>
    </form>
</div>
    <p class="text-center">You don't have an account? <a href="index.php">Sign up here!</a></p>
  </body>
</html>
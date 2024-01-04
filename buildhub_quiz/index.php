<?php
$success=0;
$user=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include "include/connection.php";
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $username=$_POST['username'];
    

     // Hash the password
     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql="select * from rexregister where username='$username'";

    $result=mysqli_query($con,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0) {
            /* echo "User already exists"; */
            $user=1;
        } else {
            $sql="insert into rexregister (firstname,lastname,email,password,username) values('$firstname','$lastname','$email','$hashed_password','$username')";
    $result=mysqli_query($con,$sql);
    if($result) {
      /* echo "Signup successfully"; */
      $success=1;
    } else {
      die(mysqli_error($con));
      }
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
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Login Page</title>
  </head>
  <body>
  <?php
if($user){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Sorry</strong> User already exist.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>
<?php
if($success){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success</strong> You are successfully signed up login <a href="login.php"> Here</a>.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>

    <h3 class="display-4 text-center mt-5">Create account</h3>
    <p class="text-muted text-center">Please enter your account here</p> 
    <div class="container mt-5">
        <form action="index.php" method="POST">
            <div class="form-group">
                <label>First Name</label>
				<input name="firstname" type="text" class="form-control input-lg" value="" required>
            </div>
            <div class="form-group">
                <label>Last Name</label>
				<input name="lastname" type="text" class="form-control input-lg" value=""  required>
            </div>
            <div class="form-group">
                <label>E-mail Address</label>
                <input name="email" type="email" class="form-control input-lg" value="">
                <input type="hidden" class="medium" name="refer" value="none" required="">
            </div>
            <div class="form-group">
                <label>Password</label>
				<input name="password" type="password" class="form-control input-lg"  required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input name="username" type="text" class="form-control input-lg"  required>
            </div>
                <div class="text-center mt-5">
                    <button id="btn" type="submit" class="btn btn-primary w-100" name="register"><span>Sign Up</span></button>
                </div> 
                <p class="text-center">Already have an account? <a href="login.php">Sign In!</a></p>

            </div>
            
        </form> 
    </div>
  </body>
  </html>
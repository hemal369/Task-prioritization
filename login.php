<?php 
 include 'authenticate.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To-do-list</title>
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    <link rel="stylesheet" href="./css/login.css" />
</head>

<body class="bg-info">


<?php 
   
   if(isset($_POST['submit'])){

      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
      $password = mysqli_real_escape_string($conn, $_POST['mpassword']);
      $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        
      $pass = password_hash($password,PASSWORD_BCRYPT);
      $cpass = password_hash($cpassword,PASSWORD_BCRYPT);

      $token = bin2hex(random_bytes(15));

      $emailquery = "select * from registration where email='$email' ";
      $query= mysqli_query($conn, $emailquery);

      $emailcount = mysqli_num_rows($query);

      if($emailcount>0){
           ?> 
           <script>
              alert("email already exists");               
           </script> 
           <?php
      }else {
          if($password === $cpassword){
          
           $insertQuery = "insert into registration(username,email,mobile,password,cpassword) values 
             ('$username','$email','$mobile','$pass','$cpass' ) ";

           $iquery = mysqli_query($conn,$insertQuery);

           if($iquery){
                  header('location:login.php');
                 
           }else {
               ?> 
               <script>
                  alert("inserting failed");               
               </script> 
               <?php
           }

          } else {
           ?> 
           <script>
              alert("passwords do not match");               
           </script> 
           <?php
          }
      }

   }
?>

<?php 
   
   if(isset($_POST['submit1'])){

      $email = mysqli_real_escape_string($conn, $_POST['email1']);
      $password = mysqli_real_escape_string($conn, $_POST['password1']);
        
    //   $pass = password_hash($password,PASSWORD_BCRYPT);
    //   $cpass = password_hash($cpassword,PASSWORD_BCRYPT);

    //   $token = bin2hex(random_bytes(15));

      $emailquery = "select * from registration where email='$email' ";
      $query= mysqli_query($conn, $emailquery);

      $emailcount = mysqli_num_rows($query);

      if($emailcount){
         
        $email_pass = mysqli_fetch_assoc($query);
        
        $db_pass = $email_pass["password"];

        $u_id = $email_pass["userid"];

        $pass_decode = password_verify($password , $db_pass);

        if($pass_decode){

            session_start();
            $_SESSION['user_id'] = $u_id;

            header('location: front.php');
        }else{
            echo "password incorrect";
        }
      }else {
           echo "invalid email";
   }
}
?>


    <div class="container">
        <!-- Login Form Start -->
        
        <div class="row justify-content-center" id="login-box">
        <div>
            <h1 class="mx-5 my-5"><b>Priority Pro</b></h1>
        </div>
            <div class="col-lg-10 my-auto myShadow">
                <div class="row">
                    <div class="col-lg-7 bg-white p-4">
                        <h1 class="text-center font-weight-bold text-primary">Sign in to Account</h1>
                        <hr class="my-3" />
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" class="px-3" id="login-form">
                            <div class="input-group input-group-lg form-group">
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i
                                            class="far fa-envelope fa-lg fa-fw"></i></span>
                                </div>
                                <input type="email" id="email" name="email1" class="form-control rounded-0"
                                    placeholder="E-Mail" required />
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i
                                            class="fas fa-key fa-lg fa-fw"></i></span>
                                </div>
                                <input type="password" id="myPassword" name="password1" class="form-control rounded-0"
                                    minlength="4" placeholder="Password" required autocomplete="off" />
                            </div>

                            
                            <div class="form-group clearfix">
                                <div class="custom-control custom-checkbox float-left">
                                    <input onclick="myFunction()" type="checkbox" class="custom-control-input" id="customCheck" name="rem" />
                                    <label class="custom-control-label" for="customCheck">Show password</label>
                                </div>
                                <div class="forgot float-right">
                                    <a href="#" id="forgot-link">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="login-btn" value="Sign In" name="submit1"
                                    class="btn btn-primary btn-lg btn-block myBtn" />
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Hello USER!</h1>
                        <hr class="my-3 bg-light myHr" />
                        <p class="text-center font-weight-bolder text-light lead">Welcome to our smart to-do list! Stay organized and boost your productivity with our intuitive platform. Create tasks, prioritize them, and track your progress with ease. Let's get started!</p>
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn"
                            id="register-link">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Form End -->
        <!-- Registration Form Start -->
        
        <div class="row justify-content-center wrapper" id="register-box" style="display: none;">
        
            <div class="col-lg-10 my-auto myShadow">
            
                <div class="row">
                    <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Welcome User!</h1>
                        <hr class="my-4 bg-light myHr" />
                        <p class="text-center font-weight-bolder text-light lead">To keep connected with us please login
                            with your personal info.</p>
                        <button class="btn btn-outline-light btn-lg font-weight-bolder mt-4 align-self-center myLinkBtn"
                            id="login-link">Sign In</button>
                    </div>
                    <div class="col-lg-7 bg-white p-4">
                        <h1 class="text-center font-weight-bold text-primary">Create Account</h1>
                        <hr class="my-3" />
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="px-3" id="register-form">
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i
                                            class="far fa-user fa-lg fa-fw"></i></span>
                                </div>
                                <input type="text" id="name" name="username" class="form-control rounded-0"
                                    placeholder="Full Name" required />
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i
                                            class="far fa-envelope fa-lg fa-fw"></i></span>
                                </div>
                                <input type="email" id="remail" name="email" class="form-control rounded-0"
                                    placeholder="E-Mail" required />
                            </div>


                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i
                                            class="fas fa-solid fa-phone fa-lg fa-fw"></i></span>
                                </div>
                                <input type="tel" id="mobile" name="mobile" class="form-control rounded-0"
                                maxlength="10" placeholder="Mobile number" required />
                            </div>

                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i
                                            class="fas fa-key fa-lg fa-fw"></i></span>
                                </div>
                                <input onChange="onChange()" type="password" id="rpassword" name="mpassword" class="form-control rounded-0"
                                    minlength="4" placeholder="Password" required />
                            </div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i
                                            class="fas fa-key fa-lg fa-fw"></i></span>
                                </div>
                                
                                <input onChange="onChange()" type="password" id="cpassword" name="cpassword" class="form-control rounded-0"
                                    minlength="4" placeholder="Confirm Password" required  />
                                    
                            </div>
                            <div class="form-group">
                                <div id="passError" class="text-danger font-weight-bolder"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" id="register-btn" value="Sign Up"
                                    class="btn btn-primary btn-lg btn-block myBtn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Registration Form End -->
        <!-- Forgot Password Form Start -->
        <div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
            <div class="col-lg-10 my-auto myShadow">
                <div class="row">
                    <div class="col-lg-7 bg-white p-4">
                        <h1 class="text-center font-weight-bold text-primary">Forgot Your Password?</h1>
                        <hr class="my-3" />
                        <p class="lead text-center text-secondary">To reset your password, enter the registered e-mail
                            adddress and we will send you password reset instructions on your e-mail!</p>
                        <form action="#" method="post" class="px-3" id="forgot-form">
                            <div id="forgotAlert"></div>
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0"><i
                                            class="far fa-envelope fa-lg"></i></span>
                                </div>
                                <input type="email" id="femail" name="email" class="form-control rounded-0"
                                    placeholder="E-Mail" required />
                            </div>
                            <div class="form-group">
                                <input type="submit" id="forgot-btn" value="Reset Password"
                                    class="btn btn-primary btn-lg btn-block myBtn" />
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 d-flex flex-column justify-content-center myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Reset Password!</h1>
                        <hr class="my-4 bg-light myHr" />
                        <button class="btn btn-outline-light btn-lg font-weight-bolder myLinkBtn align-self-center"
                            id="back-link">Back</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Forgot Password Form End -->
    </div>
    <script>
		function myFunction() {
			var x = document.getElementById("myPassword");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>
    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/login.js"></script>
</body>

</html>
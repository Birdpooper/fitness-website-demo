<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper1{ width: 360px; padding: 10px;}
        h2{margin-top:100px}
        .profile i {
    font-size: 40px;    line-height: 70px;
}
footer .icons a i {
  line-height: 70px;
}
@media (max-width:700px) {
  .content .top .icons a i {
    font-size: 40px;
    line-height: 50px;
  }
}
    </style>
</head>
<body>
     <nav>
        <div class="wrapper">
            <div class="logo"><a href="#">AbhiFit</a></div>
            <input type="radio" name="slider" id="menu-btn" />
            <input type="radio" name="slider" id="close-btn" />
            <ul class="nav-links">
                <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
                <li><a href="../html/index.html">Home</a></li>
                <li><a href="../html/about.html">About</a></li>

                <li><a href="../html/Testimonials.html">Testimonials</a></li>
                <li>
                    <a href="#" class="desktop-item">Fit Awards</a>
                    <input type="checkbox" id="showDrop" />
                    <label for="showDrop" class="mobile-item">Fit Awards</label>
                    <ul class="drop-menu">
                        <li><a href="../HTML/fit-award-2019.html">Top Personal Trainer UAE 2019</a></li>
                        <li><a href="../HTML/top-trainer-uae.html">Top 10 Personal Trainer UAE 2018</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="desktop-item">Services</a>
                    <input type="checkbox" id="showMega" />
                    <label for="showMega" class="mobile-item">Services</label>
                    <div class="mega-box">
                        <div class="content">
                            <div class="row">
                                <img src="../images/main.jpg" alt="" />
                            </div>
                            <div class="row">
                                <header>Our Services</header>
                                <ul class="mega-links">
                                    <li><a href="../html/Personal Training.html">Personal Training</a></li>
                                    <li><a href="../html/nutrition.html">Nutrition Plan</a></li>
                                    <li><a href="../html/Media.html">Media</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Calculator</header>
                                <ul class="mega-links">
                                    <li><a href="../HTML/body-fat.html">US Navy Body Fat (%) Calculator</a></li>
                                    <li><a href="../HTML/bmi-calculator.html">BMI Calculator</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Blog</header>
                                <ul class="mega-links">
                                    <li><a href="#">All Posts</a></li>
                                    <li><a href="#">Children</a></li>
                                    <li><a href="#">Men</a></li>
                                    <li><a href="#">Women</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a href="../html/contact page.html">Contact</a></li>
                <div class="profile">
                    <li><a href="../php/login.php"><i class='bx bxs-user-circle'></i></a></li>
                </div>
            </ul>
            <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
        </div>
    </nav>
<center>
        <div class="wrapper1">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</center>
  <footer>
    <div class="content">
      <div class="top">
        <div class="logo-details">
          <span class="logo_name">AbhiFit</span>
        </div>
        <div class="icons">
          <a href="#" class="fb"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" class="insta"><i class="fab fa-instagram"></i></a>
          <a href="#" class="yt"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="link-boxes">
        <ul class="box">
          <li class="link_name">AbhiFit</li>
          <li><a href="../HTML/index.html">Home</a></li>
          <li><a href="../HTML/contact page.html">Contact us</a></li>
          <li><a href="../HTML/about.html">About us</a></li>
          <li><a href="../HTML/contact page.html">Get started</a></li>
        </ul>
        <ul class="box">
          <li class="link_name">Services</li>
          <li><a href="../HTML/Personal Training.html">Personal Trainer</a></li>
          <li><a href="../HTML/nutrition.html">Nutrition Plan</a></li>
          <li><a href="../HTML/Media.html">Media</a></li>
        </ul>
        <ul class="box">
          <li class="link_name">Quick Links</li>
          <li><a href="../HTML/fit-award-2019.html">Award-Winning PT</a></li>
          <li><a href="../HTML/Personal Training.html">Personal Training</a></li>
          <li><a href="../HTML/Testimonials.html">Testimonials</a></li>
          <li><a href="../HTML/bmi-calculator.html">BMI Calc</a></li>
        </ul>
        <ul class="box">
          <li class="link_name">Account</li>
          <li><a href="../php/login.php">Profile</a></li>
          <li><a href="../php/login.php">My account</a></li>
        </ul>


      </div>
    </div>
    <div class="bottom-details">
      <div class="bottom_text">
        <span class="copyright_text">Copyright © 2024 <a href="#">AbhiFit</a>All rights reserved</span>
        <span class="policy_terms">
          <a href="#">Privacy policy</a>
          <a href="#">Terms & condition</a>
        </span>
      </div>
    </div>
  </footer>
</body>
</html>
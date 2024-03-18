<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper1{ width: 360px; padding: 20px;}
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
            <div class="logo"><a href=""><img src="../images/ptlogo.png" alt="PT Transformer"></a></div>
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
                                    <li><a href="../HTML/body-fat.html">BMR Calculator</a></li>
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
                <style>
                    .profile i {
                        font-size: 40px;
                        line-height: 70px;
                    }
                </style>
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
        </center>
        <footer>
    <div class="content">
      <div class="top">
        <div class="logo-details">
          <div class="logo"><a href=""><img src="../images/ptlogo.png" alt="PT Transformer" width="100px"></a></div>
          <span class="logo_name">PT Transformer</span>
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
          <li class="link_name">PT Transformer</li>
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
          <li><a href="../HTML/Testimonials.html">Testimonials</a></li>
          <li><a href="../HTML/bmi-calculator.html">BMI Calc</a></li>
          <li><a href="../HTML/body-fat.html">BMR Calc</a></li>
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
        <span class="copyright_text">Copyright © 2024 <a href="#">PT Transformer</a>All rights reserved</span>
        <span class="policy_terms">
          <a href="#">Privacy policy</a>
          <a href="#">Terms & condition</a>
        </span>
      </div>
    </div>
  </footer>
</body>
</html>
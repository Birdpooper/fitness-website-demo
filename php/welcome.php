<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        .wrapper1{ width: 600px; padding-top: 20px; }
        .profile i {
    font-size: 40px;    line-height: 70px;
}
h1 {
    margin-top:100px;
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
.wrapper1{
    width: 500px
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
        <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</div>
</center><br><br><br><br><br><br><br><br>

<footer>
    <div class="content">
      <div class="top">
        <div class="logo-details">
          <div class="logo"><a href=""><img src="../images/ptlogo.png" alt="PT Transformer" width="100px"></a></div>
          <span class="logo_name">PT Transformer</span>
      </div>
        <div class="fix">
          <div class="icons">
            <a href="#" class="fb"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" class="insta"><i class="fab fa-instagram"></i></a>
            <a href="#" class="yt"><i class="fab fa-youtube"></i></a>
          </div>
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
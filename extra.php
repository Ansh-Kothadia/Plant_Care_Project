<?php
  session_start();

  // Check if user is logged in
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) 
  {
      header("Location: login.php");
      exit();
  }
  $con = mysqli_connect("localhost", "root", "", "plant_care");
  if (!$con) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }

$user_id = $_SESSION['id'];
$message = isset($_POST['Message']) ? $_POST['Message'] : '';


$sql = "SELECT username, email, contact FROM signup WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $username, $email, $contact,);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);


$insert="INSERT INTO `contactus` ( `name`, `email`, `contactno`,`message`) VALUES ( '$username','$email', '$contact', '$message');";
$result1=mysqli_query($con,$insert);

mysqli_close($con);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html{
    scroll-behavior: smooth;
}

body {
    font-family: 'Inter', sans-serif;
    line-height: 1.5;
    color: #333;
    background-color: #fafafa;
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 32px;
}

/* Navbar section */

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 1000;
    padding: 12px 24px;
    /* background-color: #222; */
    background: #7C9082;
    flex-wrap: wrap;
  }
  
  .nav-left a {
    color: white;
    text-decoration: none;
    margin-right: 50px;
    font-size: 16px;
  }
  
  .nav-left a:hover {
    color: rgb(227, 226, 226);
  }
  
  .nav-right .btn {
    margin-left: 10px;
    padding: 8px 16px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  /* .login {
    background-color: white;
    color: black;
    border: 1px solid white;
  } */
  
  .logout {
    background-color: #00bfff;
    color: white;
    border: none;
  }
  
  /* .login:hover {
    background-color: rgb(199, 195, 195);
    color: #222;
  } */
  
  .logout:hover {
    background-color: #009acd;
  }
  
  @media (max-width: 950px){
    .navbar{
        justify-content: center;
        flex-direction: column;
        gap: 23px;
    }
    .nav-left{
        display: flex;
        flex-direction: column;
        gap: 16px;
        transform: translate(32px, 10px);
        text-align: center;
    }

  }

  .contactUs input{
    height: 37px;
    width: 269px;
    border-radius: 6px;
    background: #7C9082;
    border: none;
    color: white;
    cursor: pointer;
  }

   

  .contactUs{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 350px;
    margin: 50px auto;
    padding: 40px;
    background: beige;
  }
  .contactUs img{
    height: 225px;
    border-radius: 30px;
    margin-top: 65px;
  }
  @media (max-width:1171px){
    .contactUs{
      gap:28px;
      flex-direction: column;
      align-items: center;
    }
  }
  @media (max-width:557px)
  {
    .contactUs img{
      height:130px;
    }
  }

    </style>
</head>
<body>
    <section class="navbar">
        <div class="nav-left">
          <a href="profile.php"><i class='bx bx-user-circle'></i></a>
          <a href="#home">Home</a>
          <a href="#section1">Services</a>
          <a href="#section2">Subscription</a>
          <a href="#section3">Appointment Booking</a>
          <a href="aboutus.html">About Us</a>
        </div>
        <div class="nav-right">
          <!-- <a href="#"><button class="btn login">Login</button></a> -->
          <a href="logout.php"><button class="btn logout">Log Out</button></a>
        </div>
      </section>

      <section class="contactUs">
        <div class="img"><img src="./image.png" alt="contactUs"></div>
        <div class="contactForm">
          <h1 style="text-align:center;">Contact Us</h1>
          <strong>Helpline Number:</strong> 1234567890<br>
          <strong>Helpline E-mail:</strong> plantcare@gmail.com
          <form action="" method="post">
           <p><strong>Name:</strong>  <?php echo $username; ?></p>
            <p><strong>Email:</strong>  <?php echo $email; ?></p>
            <p><strong>Contact No:</strong>  <?php echo $contact; ?></p>
            <p><strong>Message:</strong></p>
            <textarea name="Message" id="Message" style="border-radius:10px"></textarea><br>
            <input type="submit" value="submit">
          </form>
        </div>
      </section>
      
</body>
</html>
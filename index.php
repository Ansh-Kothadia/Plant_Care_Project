<?php
// if($_SERVER["REQUEST_METHOD"]=="POST")
// {
//     //Connecting to the database
//     $server="localhost";
//     $hostname="root";
//     $password="";
//     $database="plant_care";

//     //Creating a connection
//     $con=mysqli_connect($server,$hostname,$password,$database);

//     if(!$con)
//     {
//         die("Error occured because of ".$mysqli_connect_error($con));
//     }
//     else
//     {
//         $name=$_POST['name'];
//         $email=$_POST['email'];
//         $contactno=$_POST['contactno'];
//         $message=$_POST['Message'];

//         $sql="INSERT INTO `contactus` ( `name`, `email`, `contactno`, `message`) VALUES ( '$name' ,'$email', '$contactno','$message');"; //SQL Query for inserting the data into the database
//         $result1=mysqli_query($con,$sql);
//         header("Location: index.php");
//         exit();
//     }
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost";
    $hostname = "root";
    $password = "";
    $database = "plant_care";

    $con = mysqli_connect($server, $hostname, $password, $database);

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $contactno = $_POST['contactno'];
    $message = $_POST['Message'];

    $sql = "INSERT INTO `contactus` (`name`, `email`, `contactno`, `message`) 
            VALUES ('$name', '$email', '$contactno', '$message')";

    if (mysqli_query($con, $sql)) {
        // Redirect to same page to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Care Services</title>
    <link rel="stylesheet" href="index.css">
    <style>
         .contactUs{
    display: flex;
    /* flex-wrap: wrap; */
    justify-content: center;
    gap: 350px;
    margin: 50px auto;
    padding: 40px;
    /* background:white; */
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
    .contactUs img
    {
      height:130px;
    }
  }
  .contactUs input{
    height: 37px;
    width: 269px;
    border-radius: 6px;
    background: #7C9082;
    /* border: none; */
    color: white;
    cursor: pointer;
  }
         @media (max-width: 950px){
    .navbar{
        justify-content: center;
        flex-direction: column;
        gap: 23px;
    }
    .nav-left{
        /* display: flex;
        flex-direction: column;
        gap: 16px;
        transform: translate(32px, 10px);
        text-align: center; */
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        /* align-items: center; */
        text-align: center;
        gap: 16px;
        transform: translate(28px, 10px);
    }
    .nav-right{
        display: flex;
        flex-direction: column;
        gap: 13px;
        transform: translate(5px, 10px);
    }
    .btn .signup{
        transform: translate(-4px, -3px);
    }

  }
  #form{
    background-color: white;
    color: black;
  }
    </style>
</head>
<body>
    <div class="min-h-screen">

        <!-- Navbar Section -->
        <section class="navbar">
            <div class="nav-left">
              <a href="#home">Home</a>
              <a href="#section1">Services</a>
              <a href="#section2">Subscription</a>
              <a href="#section3">Appointment Booking</a>
              <a href="aboutus.html">About Us</a>
              <a href="#section4">Contact Us</a>
            </div>
            <div class="nav-right">
              <a href="login.php"><button class="btn login">Login</button></a>
              <a href="signup.html"><button class="btn signup">Signup</button></a>
            </div>
          </section>
          

        <!-- Hero Section -->
        <section class="hero" id="home">
            <div class="hero-image">
                <!-- <img src="https://images.unsplash.com/photo-1518495973542-4542c06a5843" alt="Plant care background"> -->
                <img src="nature-plants-macro-depth-of-field-wallpaper-preview.jpg" alt="Plant care background">
                <div class="overlay"></div>
            </div>
            <div class="hero-content">
                <div class="badge">Professional Plant Care</div>
                <h1>PLANT CARE</h1>
                <p>Expert plant care services at your convenience</p>
                <!-- <button class="btn btn-primary" onclick="handleBookAppointment()">Book Appointment</button> -->
                <button class="btn btn-primary" onclick="window.location.href='signup.html'">Book Appointment</button>
            </div>
        </section>

        <!-- Services Section -->
        <section class="services" id="section1">
            <div class="container">
                <div class="section-header">
                    <div class="badge">Our Services</div>
                    <h2>Premium Plant Care Services</h2>
                    <p>Choose from our range of professional plant care services</p>
                </div>
                <div class="services-grid" id="services-container">
                    <!-- Service Card 1 -->
                    <div class="card">
                        <div class="card-icon">💧</div>
                        <h3 class="card-title">Plant Watering</h3>
                        <p>Regular watering schedule tailored to your plants' needs</p>
                        <div class="card-footer">
                            <span class="card-price">₹999</span>
                            <!-- <button class="btn btn-primary" onclick="handleLearnMore('Plant Watering')">Learn More</button> -->
                            <button class="btn btn-primary" onclick="window.location.href='signup.html'">Learn More</button>
                        </div>
                    </div>
                    
                    <!-- Service Card 2 -->
                    <div class="card">
                        <div class="card-icon">🌲</div>
                        <h3 class="card-title">Pruning Service</h3>
                        <p>Expert pruning to promote healthy growth</p>
                        <br>
                        <div class="card-footer">
                            <span class="card-price">₹1,999</span>
                            <!-- <button class="btn btn-primary" onclick="handleLearnMore('Pruning Service')">Learn More</button> -->
                            <button class="btn btn-primary" onclick="window.location.href='signup.html'">Learn More</button>
                        </div>
                    </div>
                    
                    <!-- Service Card 3 -->
                    <div class="card">
                        <div class="card-icon">🌱</div>
                        <h3 class="card-title">Soil Testing</h3>
                        <p>Comprehensive soil analysis and treatment</p>
                        <br>
                        <div class="card-footer">
                            <span class="card-price">₹1,499</span>
                            <!-- <button class="btn btn-primary" onclick="handleLearnMore('Soil Testing')">Learn More</button> -->
                            <button class="btn btn-primary" onclick="window.location.href='signup.html'">Learn More</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Subscription Plans Section -->
        <section class="subscription-plans" id="section2">
            <div class="container">
                <div class="section-header">
                    <div class="badge">Subscription Plans</div>
                    <h2>Choose Your Care Plan</h2>
                    <p>Select the perfect plant care subscription that suits your needs</p>
                </div>
                <div class="plans-grid" id="plans-container">
                    <!-- Silver Plan -->
                    <div class="card">
                        <div class="plan-header">
                            <div class="plan-icon" style="background-color: #9F9EA1;"></div>
                            <h3 class="card-title">Silver Plan</h3>
                            <div class="card-price">₹1,999<span class="price-period">/monthly</span></div>
                        </div>
                        <ul class="plan-features">
                            <li><span class="check-icon">✓</span> Basic plant health monitoring</li>
                            <li><span class="check-icon">✓</span> Monthly watering service</li>
                            <li><span class="check-icon">✓</span> Basic pruning service</li>
                            <li><span class="check-icon">✓</span> Email support</li>
                        </ul>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <!-- <button class="btn btn-white btn-full" onclick="handleSubscribe('Silver Plan')">
                            Subscribe Now
                        </button> -->
                        <button class="btn btn-white btn-full" onclick="window.location.href='signup.html'">
                            Subscribe Now
                        </button>
                    </div>
                    
                    <!-- Gold Plan (Popular) -->
                    <div class="card popular">
                        <div class="badge popular-badge">Most Popular</div>
                        <div class="plan-header">
                            <div class="plan-icon" style="background-color: #FFD700;"></div>
                            <h3 class="card-title">Gold Plan</h3>
                            <div class="card-price">₹4,999<span class="price-period">/quarterly</span></div>
                        </div>
                        <ul class="plan-features">
                            <li><span class="check-icon">✓</span> Advanced plant health monitoring</li>
                            <li><span class="check-icon">✓</span> Bi-weekly watering service</li>
                            <li><span class="check-icon">✓</span> Monthly pruning service</li>
                            <li><span class="check-icon">✓</span> Soil testing quarterly</li>
                            <li><span class="check-icon">✓</span> Priority email & phone support</li>
                            <li><span class="check-icon">✓</span> Plant nutrition consultation</li>
                        </ul>
                        <br>
                        <br>
                        <!-- <button class="btn btn-primary btn-full" onclick="handleSubscribe('Gold Plan')">
                            Subscribe Now
                        </button> -->
                        <button class="btn btn-primary btn-full" onclick="window.location.href='signup.html'">
                            Subscribe Now
                        </button>
                    </div>
                    
                    <!-- Platinum Plan -->
                    <div class="card">
                        <div class="plan-header">
                            <div class="plan-icon" style="background-color: #E5E4E2;"></div>
                            <h3 class="card-title">Platinum Plan</h3>
                            <div class="card-price">₹9,999<span class="price-period">/yearly</span></div>
                        </div>
                        <ul class="plan-features">
                            <li><span class="check-icon">✓</span> Premium plant health monitoring</li>
                            <li><span class="check-icon">✓</span> Weekly watering service</li>
                            <li><span class="check-icon">✓</span> Bi-weekly pruning service</li>
                            <li><span class="check-icon">✓</span> Monthly soil testing</li>
                            <li><span class="check-icon">✓</span> 24/7 priority support</li>
                            <li><span class="check-icon">✓</span> Seasonal plant rotation</li>
                            <li><span class="check-icon">✓</span> Custom nutrition plan</li>
                            <li><span class="check-icon">✓</span> Plant disease treatment</li>
                        </ul>
                        <!-- <button class="btn btn-white btn-full" onclick="handleSubscribe('Platinum Plan')">
                            Subscribe Now
                        </button> -->
                        <button class="btn btn-white btn-full" onclick="window.location.href='signup.html'">
                            Subscribe Now
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="contactUs" id="section4">
            <div class="img"><img src="./image.png" alt="contactUs"></div>
            <div class="contactForm">
              <h1 style="text-align:center;">Contact Us</h1>
              <strong>Helpline Number:</strong> 1234567890<br>
              <strong>Helpline E-mail:</strong> plantcare@gmail.com
              <form action="index.php" method="post">
               <br><p><strong>Name:</strong> <br><input type="text" id="form" name="name">
                <p><strong>Email:</strong>  <br><input type="email" name="email" id="form">
                <p><strong>Contact No:</strong> <br> <input type="text" name="contactno" id="form">
                <p><strong>Message:</strong></p>
                <textarea name="Message" id="Message" style="border-radius:10px"></textarea><br>
                <input type="submit" value="submit">
              </form>
            </div>
          </section>

        <!-- CTA Section -->
        <section class="cta" id="section3">
            <div class="container">
                <div class="cta-content">
                    <h2>Ready to give your plants the care they deserve?</h2>
                    <p>Book an appointment today and let our experts take care of your green companions</p>
                    <button class="btn btn-white" onclick="window.location.href='signup.html'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Schedule Now
                    </button>
                </div>
            </div>
        </section>

        
        <!-- Toast Container -->
        <div id="toast-container"></div>
    </div>
    <script src="index.js"></script>
</body>
</html>
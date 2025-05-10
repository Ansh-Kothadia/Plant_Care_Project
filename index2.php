<?php
// $exists = false;
// $server = "localhost";
// $hostname = "root";
// $password = "";
// $database = "plant_care";

// $con = mysqli_connect($server, $hostname, $password, $database);

// if (!$con) {
//     die("Error Occurred: Unable to connect to the database.");
// } else {
//     session_start();

//     // Redirect if not logged in
//     if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//         header("Location: login.php");
//         exit;
//     }

//     // Check if sno is set
//     if (!isset($_SESSION['id'])) {
//         echo "<div class='error' style='color:red;text-align:center;background:darkred'>Error: User session ID not found. Please log in again.</div>";
//         exit;
//     }

//     if ($_SERVER["REQUEST_METHOD"] == "POST") {
//         $subscription_no_query = "";

//         if (isset($_POST['silver'])) {
//             $subscription_no_query = "SELECT `subscription_no` FROM `subscription` WHERE subscription_name='Silver Plan'";
//         } elseif (isset($_POST['golden'])) {
//             $subscription_no_query = "SELECT `subscription_no` FROM `subscription` WHERE subscription_name='Golden Plan'";
//         } elseif (isset($_POST['platinum'])) {
//             $subscription_no_query = "SELECT `subscription_no` FROM `subscription` WHERE subscription_name='Platinum Plan'";
//         }

//         if (!empty($subscription_no_query)) {
//             $result = mysqli_query($con, $subscription_no_query);

//             if ($result && mysqli_num_rows($result) > 0) {
//                 $row = mysqli_fetch_assoc($result);
//                 $data = $row['subscription_no'];

//                 // Check if user already has this subscription
//                 $check_query = "SELECT * FROM `subscription_data` WHERE id='" . $_SESSION['id'] . "' AND subscription_no='$data'";
//                 $result1 = mysqli_query($con, $check_query);

//                 if ($result1 && mysqli_num_rows($result1) > 0) {
//                     $exists = true;
//                 } else {
//                     // Insert new subscription
//                     $insert_query = "INSERT INTO `subscription_data` (`id`, `subscription_no`, `created`) VALUES ('" . $_SESSION['id'] . "', '$data', current_timestamp())";
//                     $result_insert = mysqli_query($con, $insert_query);

//                     if (!$result_insert) {
//                         echo "<div class='error' style='color:red;text-align:center;background:darkred'>Error inserting subscription: " . mysqli_error($con) . "</div>";
//                     }
//                 }
//             } else {
//                 echo "<div class='error' style='color:red;text-align:center;background:darkred'>Subscription plan not found.</div>";
//             }
//         }
//     }
// }
?>
<?php
// $exists = false;
// $server = "localhost";
// $hostname = "root";
// $password = "";
// $database = "plant_care";

// $con = mysqli_connect($server, $hostname, $password, $database);

// if (!$con) {
//     die("Error Occurred: Unable to connect to the database.");
// } else {
//     session_start();

//     if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//         header("Location: login.php");
//         exit;
//     }

//     if (!isset($_SESSION['id'])) {
//         echo "<div class='error' style='color:red;text-align:center;background:darkred'>Error: User session ID not found. Please log in again.</div>";
//         exit;
//     }

//     // ✅ Always fetch user details
//     $user_id = $_SESSION['id'];
//     $sql = "SELECT username, email, contact FROM signup WHERE id = ?";
//     $stmt = mysqli_prepare($con, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $user_id);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_bind_result($stmt, $username, $email, $contact);
//     mysqli_stmt_fetch($stmt);
//     mysqli_stmt_close($stmt);

//     if ($_SERVER["REQUEST_METHOD"] == "POST") {
//         $subscription_no_query = "";

//         if (isset($_POST['silver'])) {
//             $subscription_no_query = "SELECT `subscription_no` FROM `subscription` WHERE subscription_name='Silver Plan'";
//         } elseif (isset($_POST['golden'])) {
//             $subscription_no_query = "SELECT `subscription_no` FROM `subscription` WHERE subscription_name='Golden Plan'";
//         } elseif (isset($_POST['platinum'])) {
//             $subscription_no_query = "SELECT `subscription_no` FROM `subscription` WHERE subscription_name='Platinum Plan'";
//         }

//         if (!empty($subscription_no_query)) {
//             $result = mysqli_query($con, $subscription_no_query);

//             if ($result && mysqli_num_rows($result) > 0) {
//                 $row = mysqli_fetch_assoc($result);
//                 $data = $row['subscription_no'];

//                 $check_query = "SELECT * FROM `subscription_data` WHERE id='" . $_SESSION['id'] . "' AND subscription_no='$data'";
//                 $result1 = mysqli_query($con, $check_query);

//                 if ($result1 && mysqli_num_rows($result1) > 0) {
//                     $exists = true;
//                 } else {
//                     $insert_query = "INSERT INTO `subscription_data` (`id`, `subscription_no`, `created`) VALUES ('" . $_SESSION['id'] . "', '$data', current_timestamp())";
//                     $result_insert = mysqli_query($con, $insert_query);

//                     if (!$result_insert) {
//                         echo "<div class='error' style='color:red;text-align:center;background:darkred'>Error inserting subscription: " . mysqli_error($con) . "</div>";
//                     }
//                 }
//             } else {
//                 echo "<div class='error' style='color:red;text-align:center;background:darkred'>Subscription plan not found.</div>";
//             }
//         }

//         // ✅ Handle message submission
//         $message = isset($_POST['Message']) ? $_POST['Message'] : '';

//         if (!empty($message)) {
//             $insert = "INSERT INTO `contactus` (`name`, `email`, `contactno`, `message`) VALUES ('$username', '$email', '$contact', '$message');";
//             mysqli_query($con, $insert);
//         }
//     }

//     mysqli_close($con);
// }
?>
<?php
$exists = false;
$server = "localhost";
$hostname = "root";
$password = "";
$database = "plant_care";

$con = mysqli_connect($server, $hostname, $password, $database);

if (!$con) {
    die("Error Occurred: Unable to connect to the database.");
} else {
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit;
    }

    if (!isset($_SESSION['id'])) {
        echo "<div class='error' style='color:red;text-align:center;background:darkred'>Error: User session ID not found. Please log in again.</div>";
        exit;
    }

    $user_id = $_SESSION['id'];
    $sql = "SELECT username, email, contact FROM signup WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $email, $contact);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $subscription_no_query = "";

        if (isset($_POST['silver'])) {
            $subscription_no_query = "SELECT `subscription_no` FROM `subscription` WHERE subscription_name='Silver Plan'";
        } elseif (isset($_POST['golden'])) {
            $subscription_no_query = "SELECT `subscription_no` FROM `subscription` WHERE subscription_name='Golden Plan'";
        } elseif (isset($_POST['platinum'])) {
            $subscription_no_query = "SELECT `subscription_no` FROM `subscription` WHERE subscription_name='Platinum Plan'";
        }

        if (!empty($subscription_no_query)) {
            $result = mysqli_query($con, $subscription_no_query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $data = $row['subscription_no'];

                $check_query = "SELECT * FROM `subscription_data` WHERE id='" . $_SESSION['id'] . "' AND subscription_no='$data'";
                $result1 = mysqli_query($con, $check_query);

                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $exists = true;
                } else {
                    $insert_query = "INSERT INTO `subscription_data` (`id`, `subscription_no`, `created`) VALUES ('" . $_SESSION['id'] . "', '$data', current_timestamp())";
                    $result_insert = mysqli_query($con, $insert_query);

                    if (!$result_insert) {
                        echo "<div class='error' style='color:red;text-align:center;background:darkred'>Error inserting subscription: " . mysqli_error($con) . "</div>";
                    }
                }
            } else {
                echo "<div class='error' style='color:red;text-align:center;background:darkred'>Subscription plan not found.</div>";
            }
        }

        // ✅ Handle message submission with redirect fix
        $message = isset($_POST['Message']) ? $_POST['Message'] : '';

        if (!empty($message)) {
            $insert = "INSERT INTO `contactus` (`name`, `email`, `contactno`, `message`) VALUES ('$username', '$email', '$contact', '$message');";
            if (mysqli_query($con, $insert)) {
                // ✅ REDIRECT after successful insert to avoid form resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "<div class='error' style='color:red;text-align:center;background:darkred'>Error inserting message: " . mysqli_error($con) . "</div>";
            }
        }
    }

    mysqli_close($con);
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Care Services</title>
    <link rel="stylesheet" href="index2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
         .contactUs{
    display: flex;
    /* flex-wrap: wrap; */
    justify-content: center;
    gap: 350px;
    margin: 50px auto;
    padding: 40px;
    background: white;
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
    border: none;
    color: white;
    cursor: pointer;
  }
    </style>
</head>
<body>
    <div class="min-h-screen">

        <!-- Navbar Section -->
        <section class="navbar">
            <div class="nav-left">
              <a href="profile.php"><i class='bx bx-user-circle'></i></a>
              <a href="#home">Home</a>
              <a href="#section1">Services</a>
              <a href="#section2">Subscription</a>
              <a href="#section3">Appointment Booking</a>
              <a href="aboutus.html">About Us</a>
              <a href="#section4">Contact Us</a>
            </div>
            <div class="nav-right">
              <!-- <a href="#"><button class="btn login">Login</button></a> -->
              <a href="logout.php"><button class="btn logout">Log Out</button></a>
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
                <button class="btn btn-primary" onclick="window.location.href='appointment.php'">Book Appointment</button>
            </div>
        </section>

        <?php
        if($exists==true)
        {
            echo "<div class='error' style='color:red;text-align: center;background: darkred'>Subscription is already Purchased!!!!!</div>";
        }
        ?>

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
                            <button class="btn btn-primary" onclick="handleLearnMore('Plant Watering')">Learn More</button>
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
                            <button class="btn btn-primary" onclick="handleLearnMore('Pruning Service')">Learn More</button>
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
                            <button class="btn btn-primary" onclick="handleLearnMore('Soil Testing')">Learn More</button>
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
                        <form action="index2.php" method="post">
                            <button class="btn btn-white btn-full" name="silver" onclick="handleSubscribe('Silver Plan')">
                                Subscribe Now
                            </button>
                        </form>
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
                        <form action="index2.php" method="post">
                            <button class="btn btn-primary btn-full" name="golden" onclick="handleSubscribe('Gold Plan')">
                                Subscribe Now
                            </button>
                        </form>
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
                        <form action="index2.php" method="post">
                            <button class="btn btn-white btn-full" name="platinum" onclick="handleSubscribe('Platinum Plan') ">
                                Subscribe Now
                            </button>
                        </form>
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
          <form action="index2.php" method="post">
           <br><p><strong>Name:</strong>  <?php echo $username; ?></p><br>
            <p><strong>Email:</strong>  <?php echo $email; ?></p><br>
            <p><strong>Contact No:</strong>  <?php echo $contact; ?></p><br>
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
                    <button class="btn btn-white" onclick="window.location.href='appointment.php'">
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
    <script src="index2.js"></script>
</body>
</html>
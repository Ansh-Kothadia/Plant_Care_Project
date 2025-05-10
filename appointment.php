<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$con = mysqli_connect("localhost", "root", "", "plant_care");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user_id = $_SESSION['id']; // ✅ USE LOGGED-IN USER'S ID

    if (!empty($date) && !empty($time)) {
        // Check if appointment already exists for this user
        $checkStmt = mysqli_prepare($con, "SELECT * FROM appointment WHERE user_id = ?");
        mysqli_stmt_bind_param($checkStmt, "i", $user_id);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            echo "<script>alert('You have already booked an appointment.'); window.location.href = 'index2.php';</script>";
        } else {
            // Book appointment
            $stmt = mysqli_prepare($con, "INSERT INTO appointment (user_id, appointment_date, appointment_time) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "iss", $user_id, $date, $time);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Appointment booked successfully!'); window.location.href = 'index2.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error booking appointment.');</script>";
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_stmt_close($checkStmt);
    } else {
        echo "<script>alert('Please select date and time.');</script>";
    }

    mysqli_close($con);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        *{
            margin: 0;
            padding: 0;
            font-family: 'poppins', sans-serif;
            box-sizing: border-box;
        }
        body{
            display: flex;
            margin-top: 8%;
            justify-content: center;
            justify-items: center;
            min-height: 100vh;
            background: url(nature-plants-macro-depth-of-field-wallpaper-preview.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        }
        .container{
            width: 420px;
            background: transparent;
            color: #fff;
            /* color: black; */
            border-radius: 10px;
            padding: 30px 40px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(3px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        #appointment{
            text-align: center;
            padding: 10px 10px;
            font-size: 30px;
            color: white;
        }
        .container .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
            /* text-align: center; */
            
            
        }
        .input-box input{
            width: 100%;
            height: 100%;
            background: transparent;
            font-size: 16px;
            /* color: aliceblue; */
            color: white;
            padding: 20px 45px 20px 20px;
            border: none;
            outline: none;
            /* border: 2px solid rgba(0, 0, 0, 0.379); */
            border:2px solid white;
            border-radius: 40px;
        }
        .input-box input::placeholder{
            /* color: rgb(255, 255, 255); */
            color: white;
        }
        .input-box label{
            color: white;
        }
        .Button .btn{
            /* text-align: center; */
            /* padding: 10px 10px; */
            margin-top: 30px;
            margin-bottom: 10px;
            width: 100%;
            height: 45px;
            /* background: aliceblue; */
            /* background: black; */
            background:white;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 16px;
            /* color: #333; */
            color: black;
            font-weight: 600;
        }
        .Button :hover{
            /* background: rgba(1, 1, 1, 0.699); */
            background: rgba(219, 219, 219, 0.7);
            cursor: pointer;
            /* color: aliceblue; */
            color: black;
            border-color: #fff;
        }
        
    </style>
</head>
<body>
    <form action="" method="post" id="myForm4">
        <div class="container">
            <div id="appointment">
                <h3>Book Appointment</h3>
            </div>
            <div class="input-box">
                <label for="date1">Select Date</label>
                <input type="date" name="date" placeholder="Enter Date">
                <!-- <i class='bx bxs-calendar'></i> -->
            </div>
            <div class="input-box">
                <label for="time1">Select Time</label>
                <input type="time" name="time"placeholder="Enter Time">
                <!-- <i class='bx bxs-time'></i> -->
            </div>
            <div class="Button">
                <button type="submit" class="btn">Book Appointment</button>
            </div>
        </div>
    </form>
</body>
</html>
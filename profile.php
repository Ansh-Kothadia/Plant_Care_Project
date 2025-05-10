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

$user_id = $_SESSION['id'];

$sql = "SELECT username, address, email, contact FROM signup WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $username, $address, $email, $contact,);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* background: #f0f0f0; */
            background: url(nature-plants-macro-depth-of-field-wallpaper-preview.jpg) no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            padding-top: 60px;
            margin:0;
        }
        .profile-box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .profile-data {
            margin-top: 20px;
        }
        .profile-data p {
            margin: 10px 0;
            font-size: 16px;
            color: #444;
        }
    </style>
</head>
<body>
    <div class="profile-box">
        <h2>Your Profile</h2>
        <div class="profile-data">
            <p><strong>Name:</strong> <?php echo $username; ?></p>
            <p><strong>Address:</strong> <?php echo $address; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Contact:</strong> <?php echo $contact; ?></p>
        </div>
    </div>
</body>
</html>
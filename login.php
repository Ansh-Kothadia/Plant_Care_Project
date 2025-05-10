<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$loginError = '';
$missingEmail = false;
$missingPassword = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $user = "root";
    $pass = "";
    $database = "plant_care";

    $con = mysqli_connect($servername, $user, $pass, $database);

    if (!$con) {
        die("Cannot connect to the database: " . mysqli_connect_error());
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $missingEmail = true;
    }

    if (empty($password)) {
        $missingPassword = true;
    }

    if (!$missingEmail && !$missingPassword) {
        $stmt = mysqli_prepare($con, "SELECT id, password FROM signup WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if ($password === $row['password']) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $row['id']; // Set sno here for index2.php compatibility
                header("Location: index2.php");
                exit();
            } else {
                $loginError = "Invalid email or password.";
            }
        } else {
            $loginError = "Invalid email or password.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($con);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('premium_photo-1676654935937-109c7936b8ff.jpeg') no-repeat;
            background-size: cover;
            background-position: center;
        }
        .container {
            width: 420px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 30px 40px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #fff;
        }
        .container h3 {
            text-align: center;
            font-size: 36px;
            color: black;
        }
        .input-box {
            position: relative;
            width: 100%;
            margin: 30px 0;
        }
        .input-box input {
            width: 100%;
            padding: 15px 45px 15px 20px;
            font-size: 16px;
            color: black;
            border-radius: 40px;
            border: 2px solid rgba(0, 0, 0, 0.4);
            background: transparent;
            outline: none;
        }
        .input-box input::placeholder {
            color: black;
        }
        .input-box i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: black;
        }
        .forget {
            text-align: right;
            font-size: 14px;
            margin: -15px 0 15px;
        }
        .forget a {
            color: black;
            text-decoration: none;
        }
        .forget a:hover {
            text-decoration: underline;
        }
        .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background: black;
            color: white;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 600;
        }
        .btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .register {
            text-align: center;
            margin-top: 20px;
            color: black;
        }
        .register a {
            color: black;
            text-decoration: none;
        }
        .register a:hover {
            text-decoration: underline;
            color: darkslategrey;
        }
        @media(max-width:460px)
        {
            .container{
                width: 310px;
                padding: 20px 40px;
            }
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <h3>Login</h3>
            <?php if ($loginError): ?>
                <p style="color:red; text-align:center;"><?php echo $loginError; ?></p>
            <?php endif; ?>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="forget">
                <a href="ForgetPassword.html">Forgot Password?</a>
            </div>
            <button type="submit" class="btn">Log in</button>
            <div class="register">
                <p>Don't have an account? <a href="Signup.html">Register</a></p>
            </div>
        </div>
    </form>
</body>
</html>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
// $exists = false;
// $success = false;
// $error = "";

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $username = $_POST['username'];
//     $contact = $_POST['contact'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $confirmpassword = $_POST['confirmpassword'];
//     $address = $_POST['address'];

//     $servername = "localhost";
//     $user = "root";
//     $pass = "";
//     $database = "plant_care";

//     $conn = mysqli_connect($servername, $user, $pass, $database);

//     if (!$conn) {
//         die("Connection failed: " . mysqli_connect_error());
//     }

//     // Check if user already exists
//     $check_sql = "SELECT * FROM signup WHERE email = ?";
//     $stmt = mysqli_prepare($conn, $check_sql);
//     mysqli_stmt_bind_param($stmt, "s", $email);
//     mysqli_stmt_execute($stmt);
//     $result = mysqli_stmt_get_result($stmt);

//     if (mysqli_num_rows($result) > 0) {
//         $exists = true;
//         $error = "User with this email already exists.";
//     } else {
//         if ($password === $confirmpassword) {
//             $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
//             $insert_sql = "INSERT INTO signup (username, contact, email, password, confirmpassword, address)
//                            VALUES (?, ?, ?, ?, ?, ?)";
//             $stmt = mysqli_prepare($conn, $insert_sql);
//             mysqli_stmt_bind_param($stmt, "ssssss", $username, $contact, $email, $hashedPassword, $confirmpassword, $address);

//             if (mysqli_stmt_execute($stmt)) {
//                 $success = true;
//             } else {
//                 $error = "Failed to register: " . mysqli_error($conn);
//             }
//         } else {
//             $error = "Passwords do not match.";
//         }
//     }

//     mysqli_close($conn);
// }
?>
<?php
$exists = false;
$success = false;
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $address = $_POST['address'];

    $servername = "localhost";
    $user = "root";
    $pass = "";
    $database = "plant_care";

    $conn = mysqli_connect($servername, $user, $pass, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if user already exists
    $check_sql = "SELECT * FROM signup WHERE email = ?";
    $stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $exists = true;
        $error = "User with this email already exists.";
    } else {
        if ($password === $confirmpassword) {
            // No hashing, store the password as plain text
            $insert_sql = "INSERT INTO signup (username, contact, email, password, confirmpassword, address)
                           VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insert_sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $username, $contact, $email, $password, $confirmpassword, $address);

            if (mysqli_stmt_execute($stmt)) {
                $success = true;
            } else {
                $error = "Failed to register: " . mysqli_error($conn);
            }
        } else {
            $error = "Passwords do not match.";
        }
    }

    mysqli_close($conn);
}
?>

<div class="container mt-4">
    <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            Account created successfully! <a href="login.php" class="alert-link">Click here to login</a>.
        </div>
    <?php elseif ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
</div>


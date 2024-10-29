<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start session to track login state

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";  // MySQL username
    $password = "";  // MySQL password
    $dbname = "fyp_database";  // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user = $_POST['username'];
    $pin = $_POST['pin'];

    // Query to check user
    $sql = "SELECT * FROM locations WHERE name = '$user' AND pin = '$pin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $user;
        $_SESSION['pin'] = $pin;
        header("Location: dashboard.php");  // Redirect to dashboard
        exit();
    } else {
        $error_message = "Incorrect username or PIN";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- HTML code remains the same -->
</head>
<body>
    <!-- Form remains the same -->
    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
</body>
</html>

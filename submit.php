<?php
// Database connection
$servername = "localhost";
$username = "root"; // change this according to your settings
$password = ""; // change this according to your settings
$dbname = "your_database"; // your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $conn->real_escape_string($_POST['editor1']);

    $sql = "INSERT INTO content (content) VALUES ('$content')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to display page after successful submission
        header("Location: display.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

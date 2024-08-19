<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

if ($id) {
    // Fetch the image name before deleting the record
    $sql = "SELECT image FROM your_table WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $image = $row['image'];

        // Delete the record from the database
        $sql = "DELETE FROM your_table WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            // Delete the image file from the server
            if ($image) {
                unlink('uploads/' . $image);
            }
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Record not found.";
    }
}

$conn->close();
?>

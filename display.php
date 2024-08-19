<?php
// Database connection
$servername = "localhost";
$username = "root"; // change this according to your settings
$password = ""; // change this according to your settings
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, content FROM content ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Submitted Content:</h2>";
    echo "<table style='width: 100%; border-collapse: collapse;' border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>ID</th><th>Content</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='width: 10%;'>" . $row['id'] . "</td>";
        echo "<td style='width: 90%;'>" . $row['content'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No content found.";
}

$conn->close();
?>

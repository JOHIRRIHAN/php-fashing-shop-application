<?php
session_start();

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

// Fetch and display data from the database
$sql = "SELECT id, title, paragraph, image FROM your_table ORDER BY created_at DESC";
$result = $conn->query($sql);

$cards = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $edit_delete_links = '';
        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            $edit_delete_links = '<a href="update.php?id=' . $row["id"] . '">Edit</a> | 
                                  <a href="delete.php?id=' . $row["id"] . '">Delete</a>';
        }
        
        $cards .= '<div class="content-item">
                        <img src="uploads/' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["title"]) . '">
                        <div class="content-body">
                            <h3 class="content-title">' . htmlspecialchars($row["title"]) . '</h3>
                            <p class="content-paragraph">' . htmlspecialchars($row["paragraph"]) . '</p>
                            ' . $edit_delete_links . '
                        </div>
                    </div>';
    }
} else {
    echo "No records found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Records</title>
    <style>
        .content-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .content-item img {
            width: 100%;
            height: auto;
            display: block;
        }
        .content-body {
            padding: 15px;
        }
        .content-title {
            margin: 0 0 10px;
            font-size: 1.25em;
            color: #333;
        }
        .content-paragraph {
            margin: 0;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>View Records</h1>
    <div class="content-container">
        <?php echo $cards; ?>
    </div>
</body>
</html>

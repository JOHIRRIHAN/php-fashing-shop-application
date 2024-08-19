<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
</head>
<body>
    <h1>Add New Record</h1>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="paragraph">Paragraph:</label>
        <textarea id="paragraph" name="paragraph" required></textarea><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/jpeg, image/png" required><br><br>

        <input type="submit" value="Submit">
    </form>

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

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = $conn->real_escape_string($_POST['title']);
    $paragraph = $conn->real_escape_string($_POST['paragraph']);

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_name = $_FILES['image']['name'];
        $img_tmp_name = $_FILES['image']['tmp_name'];
        $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed_ext = array('jpg', 'jpeg', 'png');

        if (in_array($img_ext, $allowed_ext)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ext;
            $img_upload_path = __DIR__ . '/uploads/' . $new_img_name; // Use absolute path

            // Check if uploads directory exists
            if (!is_dir(__DIR__ . '/uploads')) {
                mkdir(__DIR__ . '/uploads', 0755, true); // Create the directory if it does not exist
            }

            // Attempt to move the uploaded file
            if (move_uploaded_file($img_tmp_name, $img_upload_path)) {
                // Insert data into the database
                $sql = "INSERT INTO your_table (title, paragraph, image) VALUES ('$title', '$paragraph', '$new_img_name')";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Failed to upload image. Check directory permissions.";
            }
        } else {
            echo "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
        }
    }
}

$conn->close();
?>
</body>
</html>

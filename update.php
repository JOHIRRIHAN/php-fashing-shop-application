<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
</head>
<body>
    <h1>Update Record</h1>
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
    $title = $paragraph = $image = '';

    if ($id) {
        $sql = "SELECT title, paragraph, image FROM your_table WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $paragraph = $row['paragraph'];
            $image = $row['image'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
                $img_upload_path = 'uploads/' . $new_img_name;
                if (move_uploaded_file($img_tmp_name, $img_upload_path)) {
                    // Update data in the database
                    $sql = "UPDATE your_table SET title='$title', paragraph='$paragraph', image='$new_img_name' WHERE id=$id";

                    if ($conn->query($sql) === TRUE) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Failed to upload image.";
                }
            } else {
                echo "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
            }
        } else {
            // Update data without changing the image
            $sql = "UPDATE your_table SET title='$title', paragraph='$paragraph' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
    ?>

    <form action="update.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required><br><br>

        <label for="paragraph">Paragraph:</label>
        <textarea id="paragraph" name="paragraph" required><?php echo htmlspecialchars($paragraph); ?></textarea><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/jpeg, image/png"><br><br>
        <?php if ($image): ?>
            <img src="uploads/<?php echo htmlspecialchars($image); ?>" alt="Current Image" width="100"><br>
        <?php endif; ?>

        <input type="submit" value="Update">
    </form>
</body>
</html>

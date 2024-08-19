<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CKEditor Form</title>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


</head>
<body>
    
    <form action="submit.php" method="post">
        <textarea name="editor1" id="editor1" rows="10" cols="80">
            Enter your content here...
        </textarea>
        <script>
            CKEDITOR.replace('editor1');
        </script>
        <br>
        <input type="submit" value="Submit">
    </form>
    
</body>
</html>

<?php

require_once 'functions/web.php';
require_once 'functions/post.php';
require_once 'functions/db_connection.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$active = null;

if (!isLoggedIn()) {
    alertMessage('You must sign in first');
    redirect('signin.php');
}

if (isset($_POST['submit'])) {
    // Debugging statement
    echo 'Form submitted';

    createPost(
        $_POST['title'],
        $_POST['description'],
        currentUserId()
    );

    if ($_FILES['image']["size"] > 0) {
        // Debugging statement
        echo 'Image upload detected';

        // Get the ID of the new post
        $new_id = getSelectedUserPosts(currentUserId())[0]["id"];
        move_uploaded_file($_FILES['image']['tmp_name'], "photos/" . $new_id . ".jpg");
    }

    if ($_FILES['file']["size"] > 0) {
        // Debugging statement
        echo 'File upload detected';

        // Get the ID of the new post
        $new_id = getSelectedUserPosts(currentUserId())[0]["id"];
    
        if (isset($_FILES['file']['name']) && $_FILES['file']['error'] == 0) {
            $allowedExtensions = ['pdf', 'docx'];
            $fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        
            if (in_array(strtolower($fileType), $allowedExtensions)) {
                $newFileName = "files/" . $new_id . "." . $fileType;
        
                if (move_uploaded_file($_FILES['file']['tmp_name'], $newFileName)) {
                    echo "File upload successful!";
                } else {
                    echo "Error moving the uploaded file.";
                }
            } else {
                echo "Invalid file type. Only PDF and DOCX files are allowed.";
            }
        } else {
            echo "No file uploaded or there was an upload error.";
        }
    }
    
    alertMessage('Post Created Successfully');
    redirect('index.php');
} else {
    echo 'Form not submitted'; // Debug line
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add post | PostYourKnowledge</title>
    <?php require_once 'components/styles.php' ?>
</head>

<body>
    <?php require_once 'components/navbar.php' ?>
    <div class="container">
        <div class="container mt-4 mb-4">
            <form action="create_post.php" method="post" enctype="multipart/form-data">
                <div class="row justify-content-md-center">
                    <div class="col-md-12 col-lg-8">
                        <div class="form-group">
                            <h4 class="mt-4">Title</h4>
                            <input name="title" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <h4 class="mt-4">Description</h4>
                            <textarea name="description" id="editor"></textarea>
                        </div>
                        <div class="form-group">
                            <h4 class="mt-4">Choose image</h4>
                            <input type="file" name="image" accept="image/*" id="imageInput">
                        </div>
                        <div class="form-group">
                            <h4 class="mt-4">Choose PDF or DOCX</h4>
                            <input type="file" name="file" accept=".pdf,.docx">
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/8tt0fl0vvnmfjkq16qwr12taosb8zftqrshxtf5yhq4ct37z/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            menubar: false,
        });
    </script>
</body>

</html>
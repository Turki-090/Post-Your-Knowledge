<?php
require_once 'functions/web.php';
require_once 'functions/post.php';
require_once 'functions/db_connection.php';

$active = null;

if (!isLoggedIn()) {
    redirect('signin.php');
}

if (!isset($_GET['post_id']) && !isset($_POST['post_id'])) {
    redirect('my_posts.php');
}

if (isset($_POST['submit'])) {
    updatePost(
        $_POST['title'],
        $_POST['description'],
        $_POST['post_id']
    );
    if ($_FILES['image']["size"] > 0) {
    $targetDirectory = 'photos/';
    $targetFile = $targetDirectory . $_POST['post_id'].'.jpg'; 
    if (file_exists($targetFile)) {
        unlink($targetFile);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
    }
    else{
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            }
        }
    elseif (($_POST['check'])) {
    $targetDirectory = 'photos/';
    $targetFile = $targetDirectory . $_POST['post_id'].'.jpg';
    unlink($targetFile);
    }
    alertMessage('Updated Successfully');
    redirect('index.php');  
}

$post = getPost($_GET['post_id'] ?? $_POST['post_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit post | Bid&Own</title>
    <?php require_once 'components/styles.php' ?>
</head>

<body>
    <?php require_once 'components/navbar.php' ?>
    <div class="container">
        <div class="container mt-4 mb-4">
            <form action="edit_post.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure, you want to update the post?')">
                <div class="row justify-content-md-center">
                    <div class="col-md-12 col-lg-8">
                        <div class="form-group">
                        <h4 class="mt-4">Title</h4>
                            <input name="title" value="<?php echo $post['title'] ?>" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                        <h4 class="mt-4">Description</h4>
                            <textarea name="description" id="editor" required><?php echo htmlspecialchars_decode($post['description']) ?></textarea>
                        </div>
                        <h4 class="mt-4">Current image</h4>
                        <img height="200px" src="photos.php?id=<?php echo $post['id']; ?>"><br>
                        <div class="form-group">
                            <?php
                            $file = "photos/" . $post['id'] . ".jpg";

                            if (file_exists($file)) { echo '<input type="checkbox" name="check" id="checkBox">
                                <label> Remove current image</label>'; }
                            ?>
                        <h4 class="mt-4">Choose image</h4>
                        <input type="file" name="image" accept="image/*" id="imageInput">
                        </div>
                        <input type="hidden" name="post_id" value="<?php echo $_GET['post_id'] ?? $_POST['post_id'] ?>">
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
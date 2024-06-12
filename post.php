<?php
session_start();
require_once 'functions/web.php';
require_once 'functions/db_connection.php';
require_once 'functions/post.php';
require_once 'functions/bid.php';
$active = null;
if (!isset($_SESSION['post_id'])) {
    redirect('index.php');
}
if(isset($_COOKIE['user_id'])){
    $id = $_COOKIE['user_id'];
}
$post_id = $_SESSION['post_id'];
if (isLoggedIn())
    $current_user_id = currentUserId();

if (isset($_POST['bid'])) {
    if (!isLoggedIn()) {
        alertMessage('You must sign in first');
        redirect('signin.php');
    }
    createBid($_POST['bid_bid'], $post_id, $current_user_id);
}

if (isset($_POST['delete'])) {
    deletebid($_POST['bid_id']);
}
$post = getPost($post_id);
$bids = getPostBids($post_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post | PostYourKnowledge</title>
    <?php require_once 'components/styles.php' ?>
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked)>input {
            position: absolute;
            top: -9999px;
        }
        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }
        .rate:not(:checked)>label:before {
            content: '★ ';
        }
        .rate>input:checked~label {
            color: #ffc700;
        }
        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }
        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }
        .btn {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        margin-right: 10px;
    }
    .btn i {
        margin-right: 5px;
    }
    .btn-success {
        background-color: #28a745;
        color: white;
    }
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    </style>
</head>
<body>
    <?php require_once 'components/navbar.php' ?>
    <div class="container mt-4">
        <br>
        <h2 class="mt-4">Post</h2>
        <div class="card mb-2">
        <div class="card-body">
    <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
    <p class="card-text"><?php echo htmlspecialchars_decode($post['description']); ?></p>
    <h6 class="mt-4">Posted By: <a href="profile.php?id=<?php echo $post['user_id']; ?>" class="text-success"><?php echo htmlspecialchars($post['username']); ?></a></h6>
    <p class="text-muted"><?php echo htmlspecialchars($post['created_at']); ?></p>
    <div class="card-photo">
        <img height="100px" src="photos.php?id=<?php echo $post['id']; ?>" alt="Post Image">
    </div>
    <div>
    <?php
    // Possible file extensions
    $extensions = ['pdf', 'docx'];

    // Iterate through possible file extensions to check for file existence
    foreach ($extensions as $ext) {
        $filePath = "files/" . $post['id'] . "." . $ext;

        // Check if file exists
        if (file_exists($filePath)) {
            // If file exists, show the download button with the correct file extension
            echo '<a href="download.php?id=' . $post['id'] . '&ext=' . $ext . '" class="btn btn-primary mt-3" download>Download File</a>';
            break; // Stop the loop if file is found
        }
    }
    ?>


</div>
    </div>

</div>

        <div class="mt-4">
            <?php
            if (count($bids) === 0) {
                echo '<h4 class="text-muted mt-4">No Comments yet be the first one to comment</h4>';
            } else {
                echo '<h4 class="mt-4"> ' . count($bids) . ' Comments</h4>';
                foreach ($bids as $bid) {
                    ?>
                    <form method="post" action="#" onsubmit="return confirm('Are you sure you want to delete the bid?')">
                    <?php 
                    echo'
                    <div class="card mb-2">
                        <div class="card-body">
                        <p class="card-text">' .  htmlspecialchars_decode($bid['bid'])  . '</p>
                            <h6 class="mt-4">Comment By: <a href="profile.php?id='. $bid['user_id'].'" class="text-success">' . $bid['username'] . '</a></h6>
                            <p class="text-muted"> Created at: ' .  $bid['created_at']  . '</p>'; ?>
                            <?php
                                if ((isset($_COOKIE['user_id']) && $id == $bid['user_id']) ) {
                                    ?>
                                    <?php echo'
                                    <input type="hidden" name="bid_id" value="' . $bid['id'] . '"/>
                                    <button name="delete" type="submit" class="btn btn-danger">Delete</button>';
                                ?>
                                <?php 
                                }
                                echo '</div>
                                </div>
                                </form>';
                                }   
                }
            ?>
        </div>
        <h2 class="mt-4">Add your comment</h2>
        <form action="post.php" method="post" onsubmit="return validateAndSubmit()">
            <div class="row justify-content-md-center">
                <div class="col-lg-12 mt-4">
                    <div class="form-group">
                        <textarea name="bid_bid" id="editor"></textarea>
                    </div>
                    <button name="bid" type="submit" class="btn btn-primary" >Submit</button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <br>
    <script src="https://cdn.tiny.cloud/1/8tt0fl0vvnmfjkq16qwr12taosb8zftqrshxtf5yhq4ct37z/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
          function validateAndSubmit() {
        // Get the TinyMCE instance
        var editor = tinymce.get('editor');
        // Get the content from the TinyMCE instance
        var content = editor.getContent();
        if (content.trim() === '') {
            alert('Please fill the comment field.');
            return false;
        } else {
            // If the content is not empty, submit the form
            var formObject = document.getElementById('myForm');
            formObject.submit();
        }
    }
        function autoSubmit() {
            var formObject = document.forms['theForm'];
            formObject.submit();
        }
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | numlist bullist indent outdent | charmap | removeformat',
            menubar: false,
        });
    </script>
</body>
</html>
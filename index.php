<?php
session_start();
require_once 'functions/web.php';
require_once 'functions/db_connection.php';
require_once 'functions/post.php';
$active = 'home';
if (isset($_GET['post_id'])) {
    $_SESSION['post_id'] = $_GET['post_id'];
    redirect('post.php');
}
if (isset($_POST['post_id'])) {
    redirect('signin.php');
    deletePost($_POST['post_id']);

}

$posts = getLast10Posts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | PostYourKnowledge</title>
    <?php require_once 'components/styles.php' ?>
    <style type="text/css">
        .card-photo {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-photo img {
            width: 10em;
        }
        .card.mb-4 {
            flex-direction: row;
        }
        .btn, .btn-primary {
            background-color: red; /* Set background color and override other styles */
            color: white; /* Ensure text color is white */
        }
        .btn:hover, .btn-primary:hover {
            background-color: #809E77 !important; /* Light green on hover, using !important to ensure override */
            color: black; /* Text color on hover */
        }
        .card-link {
            color: #809E77;
            font-size: 30px;
        }
        .card-link:hover {
            color: green;
            text-decoration: underline;
        }
        .user-link {
            color: #809E77;
        }
        .user-link:hover {
            color: black;
        }
        .about-section {
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .about-section h1 {
            font-size: 36px;
            color: #333;
        }
        .about-section p {
            font-size: 18px;
            line-height: 1.6;
            color: #666;
        }
    </style>
</head>
<body>
    <?php require_once 'components/navbar.php' ?>
    <div class="container mt-4">
        <div class="about-section mb-4">
        <?php if(isLoggedIn() && currentUserId() == 1): ?>
    <h1 style="color: red; text-align: center;">You Are in ADMIN mode</h1>
<?php endif; ?>


 
            <h1>PostYourKnowledge</h1>
            <p>PostYourKnowledge is a vibrant online platform where users can share, 
                discuss, and discover a wide array of topics. 
                Our mission is to foster a global community of knowledge-sharing enthusiasts, 
                enabling everyone to learn and grow together. Join us to post your insights, 
                engage in meaningful discussions, and expand your horizons.</p>
        </div>
        <a href="create_post.php" class="btn btn-primary" style="color:white">Add Post</a>
        <hr>
        <h1>Recent Posts:</h1>
        <hr>
        <?php
            foreach ($posts as $post) {
                ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <a class="card-link" href="index.php?post_id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
                            <div class="card-subtitle text-muted">
                            <h6 class="mt-4"></h6>
                        <h6 class="mt-1">Comments: <?php echo $post['bids_count']; ?></h6>
                        <h6 class="mt-4">Posted By: <a href="profile.php?id=<?php echo $post['user_id']; ?>" class="text-success"><?php echo $post['username']; ?></a></h6>
                       <p class="text-muted"><?php echo $post["created_at"]; ?></p>
                            </div>
                            <?php if(isLoggedIn() && currentUserId() == 1): ?>
                                <form method="post" action="#" onsubmit="return confirm('Are you sure you want to delete the post?')">
                            <a href="edit_post.php?post_id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>"/>
                            <button name="delete" type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <?php endif;?>

                        </div>
                        <div class="card-photo">
                        <a href="index.php?post_id=<?php echo $post['id']; ?>"><img src="photos.php?id=<?php echo $post['id']; ?>"></a>
                        </div>
                    </div>
                <?php
            }
            ?>
    </div>
</body>
</html>
<?php
require_once 'functions/db_connection.php';
require_once 'functions/post.php';
require_once 'functions/web.php';

$active = null;

if (!isset($_GET['search'])) {
    redirect('index.php');
}

$posts = searchPosts($_GET['search']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | PostYourKnowledge</title>
    <?php require_once 'components/styles.php' ?>
    <style type="text/css">
        .card-photo{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-photo img{
            width: 10em;
        }
        .card.mb-4{
            flex-direction: row;
        }
        .btn:hover btn-primary {
        background-color: #809E77;
        color: black;
    }

    .card-link {
        color:  #809E77;
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
    </style>
</head>

<body>
    <?php require_once 'components/navbar.php' ?>
    <div class="container mt-4">
        <br>
        <h1>Result:</h1>
        <hr>
        <br>
        <div class="card-holder">
            <?php
            foreach ($posts as $post) {
               $img = "";
                if (htmlspecialchars_decode($post["description"])) {
                   $parsed = parseTag(htmlspecialchars_decode($post["description"]), "img");
                    if (array_key_exists("src", $parsed)) {
                        $img = $parsed["src"];
                    }
                }
                ?>
                   <div class="card mb-4" >
                        <div class="card-body">
                            <a class="card-link" href="index.php?post_id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
                            <div class="card-subtitle text-muted">
                            <h6 class="mt-4"></h6>
                        <h6 class="mt-1">Comments: <?php echo $post['bids_count']; ?></h6>
                        <h6 class="mt-4">Posted By: <a href="profile.php?id=<?php echo $post['user_id']; ?>" class="text-success"><?php echo $post['username']; ?></a></h6>
                       <p class="text-muted"><?php echo $post["created_at"]; ?></p>
                            </div>
                        </div>
                        <div class="card-photo">
                        <a href="index.php?post_id=<?php echo $post['id']; ?>"> <img src="photos.php?id=<?php echo $post['id']; ?>"></a>
                        </div>
                    </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
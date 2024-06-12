<!-- Display current user posts with pagination and can edit, delete, add, search -->
<?php
require_once 'functions/db_connection.php';
require_once 'functions/web.php';
require_once 'functions/post.php';

if (isset($_POST['delete'])) {
    deletePost($_POST['post_id']);
}
if (!isLoggedIn()) {
    alertMessage('You must sign in first');
    redirect('index.php');
}

$active = 'my_posts';

$posts = getCurrentUserPosts($_GET['page'] ?? 1);
$pagination_count = getCurrentUserPaginationCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts | PostYourKnowledge</title>
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
        <a href="create_post.php" class="btn btn-primary">Add Post</a>
        <h1 class="mt-2">My Posts:</h1>
        <hr>
        <div class="card-holder">
            <?php
            foreach ($posts as $post) {
               

                ?>
                <form method="post" action="#" onsubmit="return confirm('Are you sure you want to delete the post?')">
                <div class="card mb-4" >
                <div class="card-body">
                    <a class="card-link" href="index.php?post_id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
                    <div class="card-subtitle text-muted">
                    <h6 class="mt-4"></h6>
                <h6 class="mt-1">Comments: <?php echo $post['bids_count']; ?></h6>
                 <p class="text-muted"><?php echo $post["created_at"]; ?></p>
                 <a href="edit_post.php?post_id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                 <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>"/>
                 <button name="delete" type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
                <div class="card-photo">
                <a href="index.php?post_id=<?php echo $post['id']; ?>"> <img src="photos.php?id=<?php echo $post['id']; ?>"></a>
                </div>
                
            </div>
            </form>
                <?php
            }
        echo "</div>";
        
         if($pagination_count > 1){ 
        echo '

            <nav aria-label="Page navigation example">
                <ul class="pagination">';
        if (isset($_GET['page']) && $_GET['page'] != 1){
            echo ' <li class="page-item"><a class="page-link" href="my_posts.php?page=1">Previous</a></li>';
        }
        for ($i = 1; $i <= $pagination_count; $i++) {
            if ($i === ($_GET['page'] ?? 1))
                echo '
                <li class="page-item"><a class="page-link active" style="background-color: lightgrey" href="my_posts.php?page=' . $i . '">' . $i  . '</a></li>
                ';
            elseif(isset($_GET['page']) && $i == $_GET['page'])
                echo '
                <li class="page-item"><a class="page-link active" style="background-color: lightgrey" href="my_posts.php?page=' . $i . '">' . $i  . '</a></li>
                ';
            else
                echo '
                <li class="page-item"><a class="page-link" href="my_posts.php?page=' . $i . '">' . $i. '</a></li>
                ';
        }
        if (!isset($_GET['page']))
            echo '
                <li class="page-item"><a class="page-link" href="my_posts.php?page=2">Next</a></li>
            </ul>
            </nav>';
        else
            if ($pagination_count != (int) $_GET["page"])
                echo '
                    <li class="page-item"><a class="page-link" href="my_posts.php?page=' . (($_GET['page'] ?? 1) + 1) . '">Next</a></li>
                </ul>
                </nav>';
            }  
            elseif ($pagination_count == 1){
                echo'
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                <li class="page-item page-link active" style="background-color: lightgrey">1</li>
                </ul>
                </nav>';
            }
            elseif ($pagination_count == 0){
                echo '<h4 class="text-muted mt-4">You have no posts</h4>';
            }
        ?>
    </div>
</body>

</html>
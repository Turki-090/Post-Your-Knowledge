<!-- Display current user bids with pagination and can edit, delete, add, search -->
<?php
require_once 'functions/db_connection.php';
require_once 'functions/web.php';
require_once 'functions/bid.php';

if (!isLoggedIn()) {
    alertMessage('You must sign in first');
    redirect('index.php');
}

if (isset($_POST['delete'])) {
    deletebid($_POST['bid_id']);
}

$active = 'my_bids';

$bids = getCurrentUserBids($_GET['page'] ?? 1);
$pagination_count = getCurrentUserPaginationCount_bids();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Comments | PostYourKnowledge</title>
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
        <h1 class="mt-2">My Comments:</h1>
        <hr>
        <?php
        foreach ($bids as $bid) {
        ?>
            <form method="post" action="#" onsubmit="return confirm('Are you sure you want to delete the bid?')">
            <?php 
            echo'
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-text"> 
                        ' . htmlspecialchars_decode($bid['bid']) . '
                        </h4>
                        <a class="card-link" href="index.php?post_id=' . $bid['post_id'] . '">Go To post</a>
                        <p class="text-muted"> Created at: ' .  $bid['created_at']  . '</p>
                        <input type="hidden" name="bid_id" value="' . $bid['id'] . '"/>
                        <button name="delete" type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>';
            
        }

        if($pagination_count > 1){ 
        echo '

            <nav aria-label="Page navigation example">
                <ul class="pagination">';
        if (isset($_GET['page']) && $_GET['page'] != 1){
            echo ' <li class="page-item"><a class="page-link" href="my_bids.php?page=1">Previous</a></li>';
        }
        for ($i = 1; $i <= $pagination_count; $i++) {
            if ($i === ($_GET['page'] ?? 1))
                echo '
                <li class="page-item"><a class="page-link active" style="background-color: lightgrey" href="my_bids.php?page=' . $i . '">' . $i  . '</a></li>
                ';
                elseif(isset($_GET['page']) && $i == $_GET['page'])
                echo '
                <li class="page-item"><a class="page-link active" style="background-color: lightgrey" href="my_bids.php?page=' . $i . '">' . $i  . '</a></li>
                ';
            else
                echo '
                <li class="page-item"><a class="page-link" href="my_bids.php?page=' . $i . '">' . $i. '</a></li>
                ';
        }
        if (!isset($_GET['page']))
            echo '
                <li class="page-item"><a class="page-link" href="my_bids.php?page=2">Next</a></li>
            </ul>
            </nav>';
        else
            if ($pagination_count != (int) $_GET["page"])
                echo '
                    <li class="page-item"><a class="page-link" href="my_bids.php?page=' . (($_GET['page'] ?? 1) + 1) . '">Next</a></li>
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
        echo '<h4 class="text-muted mt-4">You have no Comments yet</h4>';
    }

        ?>
    </div>
</body>

</html>
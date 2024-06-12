<?php
require_once 'functions/db_connection.php';
require_once 'functions/web.php';
require_once 'functions/post.php';
require_once 'functions/user.php';

$active = 'profile';

if (!isLoggedIn()) {
    alertMessage('You must sign in first');
    redirect('signin.php');
}
if (isset($_GET["id"])) {
    $id = (int) $_GET['id'];
}else{
    $id = $_COOKIE['user_id'];
}

$user = getUser($id);

if (isset($_POST['submit'])) {
    if (updateProfile($_POST['name'], $_POST['contact_email'], $_POST['phone'], $id)) {
    alertMessage('Profile information updated successfully.');
   redirect('profile.php');
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | PostYourKnowledge</title>
    <?php require_once 'components/styles.php' ?>
    <style>
        .stylish-form {
            padding: 10px;
        }

        .stylish-form h2 {
            color: #809E77;
            margin-top: 50px;

        }

        .font_white {
            color: #fff !important;
        }

        .mar20 {
            margin: 20px;
        }

        .inner-section {
            background-color: #343a40;
            width: 550px;
            display: block;
            margin: 0 auto;
        }

        .inside-form {
            border-radius: 8px;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .inside-form h2 {
            font-weight: 700;
        }

        .inside-form ul {
            list-style-type: none;
            text-align: center;
            margin-top: 30px;
        }

        .inside-form ul>li {
            display: inline-block;
        }

        .inside-form ul>li>i {
            margin-top: 18px;
        }
        .input-group,
        .form-group {
            margin-bottom: 10px;
        }

        .input-group-addon {
            border: none;
            color: #FFFFFF;
            border-radius: 25px;
            padding: 10px;
        }

        .input-group .form-control,
        .input-group .form-control:focus,
        .input-group .form-control:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #FFFFFF;
            border-radius: 25px;
            border: none;
            font-size: 14px;
        }

        ::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */
            color: #fff !important;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            color: #fff !important;
        }

        :-ms-input-placeholder {
            /* IE 10+ */
            color: #fff !important;
        }

        :-moz-placeholder {
            /* Firefox 18- */
            color: #fff !important;
        }

        .footer {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        input::placeholder {
            color: #fff !important;
        }

        .btn-lg {
            font-size: 1em;
            border-radius: 0.25rem;
            padding: 15px 48px;
            background-color: #ffffff; /* Set button background to white */
            color: #343a40; /* Text color */
        }

        .btn-round {
            border-width: 1px;
            border-radius: 30px !important;
            padding: 11px 23px;
        }

        .btn-neutral,
        .btn-neutral:focus,
        .btn-neutral:hover {
            background-color: #ffffff;
            color:  #343a40;
        }
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
    <hr>
    <?php require_once 'components/navbar.php' ?>
    <div class="container mt-4">
        <div class="container-fluid stylish-form">
        <div class="row mar20">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="inner-section">
                    <form method="POST" action="#" onsubmit="return confirm('Are you sure, you want to update your profile?')">
                        <div class="mar20 inside-form">
                            <h2 class="font_white text-center">User Profile</h2>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil "></i></span>
                                <input maxlength="50" type="text" class="form-control" name="name" placeholder="Name" required value="<?php echo $user["name"] ?>" <?php if ((isset($_COOKIE['user_id']) && $id != $_COOKIE['user_id']) ||!isset($_COOKIE['user_id']) ) echo "disabled" ?>>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope "></i></span>
                                <input maxlength="50" type="email" class="form-control" name="contact_email" placeholder="Contact Email" value="<?php echo $user["contact_email"] ?>" <?php if ((isset($_COOKIE['user_id']) && $id != $_COOKIE['user_id']) ||!isset($_COOKIE['user_id']) ) echo "disabled" ?>>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock "></i></span>
                                <input maxlength="15" type="tel" class="form-control" name="phone" placeholder="Phone Number" value="<?php echo $user["phone"] ?>" <?php if ((isset($_COOKIE['user_id']) && $id != $_COOKIE['user_id']) ||!isset($_COOKIE['user_id']) ) echo "disabled" ?>>
                            </div>
                            <?php
                                if ((isset($_COOKIE['user_id']) && $id == $_COOKIE['user_id']) ) {
                                    ?>
                                        <div class="footer text-center">
                                    <button type="submit" name="submit" class="btn btn-neutral btn-round btn-lg">Update</button>
                                     </div>
                                    <?php
                                }
                                else{
                                    echo '<br>';
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <?php
                                if ((isset($_COOKIE['user_id']) && $id != $_COOKIE['user_id']) ||!isset($_COOKIE['user_id']) ) {
                                    ?>        
    
        <hr>
        <h1>List Of Posts:</h1>
        <hr>
        
        <?php
            $posts = getSelectedUserposts($id);
            if ($posts == null) {
                echo '<h4 class="text-muted mt-4">User ' . $user["name"] . ' has no posts</h4>';
            } else {
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
                                <p class="text-muted"><?php echo $post["created_at"]; ?></p>
                            </div>
                        </div>
                        <div class="card-photo">
                            <a href="index.php?post_id=<?php echo $post['id']; ?>"><img src="photos.php?id=<?php echo $post['id']; ?>"></a>
                        </div>
                    </div>
                    <?php
                }
            }
?>

    </div>
    <?php
                                }
                            ?>
</body>

</html>

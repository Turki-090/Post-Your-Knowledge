<?php

require_once 'functions/db_connection.php';
require_once 'functions/user.php';
require_once 'functions/web.php';

$active = null;

if (isLoggedIn()) {
    redirect('index.php');
}

if (isset($_POST['submit'])) {
    $login_success = login($_POST['email'], $_POST['password']);
    if($login_success){
    redirect('index.php');
    }
    else{
        alertMessage('Email and/or Password is incorrect');
    redirect('signin.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | PostYourKnowledge</title>
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
            background-color: #809E77;
            width: 350px;
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

        .icon-holder {
            background: #fff;
            border-radius: 50%;
            vertical-align: middle;
            height: 50px;
            width: 50px;
            text-align: center;
            margin-right: 20px;
        }

        .dsp-flex {
            display: -webkit-box;
            /* OLD - iOS 6-, Safari 3.1-6 */
            display: -moz-box;
            /* OLD - Firefox 19- (buggy but mostly works) */
            display: -ms-flexbox;
            /* TWEENER - IE 10 */
            display: -webkit-flex;
            /* NEW - Chrome */
            display: flex;
            /* NEW, Spec - Opera 12.1, Firefox 20+ */
            align-items: center;
            -webkit-align-items: center;
            justify-content: center
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
        }
        .btn-round {
            border-width: 1px;
            border-radius: 30px !important;
            padding: 11px 23px;
        }
        .btn-neutral,
        .btn-neutral:focus,
        .btn-neutral:hover {
            background-color: #FFFFFF;
            color: #809E77;
        }
    </style>
</head>
<body>
    <?php require_once 'components/navbar.php' ?>
    <div class="container-fluid stylish-form">
        <div class="row mar20">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="inner-section">
                    <form method="POST" action="#">
                        <div class="mar20 inside-form">
                            <h2 class="font_white text-center">SIGN IN</h2>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope "></i></span>
                                <input type="text" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock "></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <label>
                                    You don't have an account ? <a href="signup.php" target="_blank" style="color: #fff;">Sign up</a>
                                </label>
                            <div class="footer text-center">
                                <button type="submit" name="submit" class="btn btn-neutral btn-round btn-lg">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
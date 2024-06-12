<?php
require_once 'functions/db_connection.php';
require_once 'functions/user.php';
require_once 'functions/web.php';
$active = null;
if (isLoggedIn()) {
    alertMessage('You are already signed in !');
    // redirect('index.php');
}
if (isset($_POST['submit'])) {
    if (isset($_POST['terms'])) { // Check if terms checkbox is marked
        try {
            register($_POST['name'], $_POST['email'], $_POST['password']);
            redirect('signup.php'); // Optionally change this to a success page or login page
        } catch (\Exception $th) {
            alertMessage('This email is already used');
        }
    } else {
        alertMessage('Must agree with terms and conditions to proceed');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | PostYourKnowledge</title>
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

        .inside-form input[type="checkbox"] {
            margin-right: 5px;
        }

        .inside-form label {
            display: inline-block;
            vertical-align: middle;
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
                    <form method="POST" action="#" onsubmit="return validateForm();">
                        <div class="mar20 inside-form">
                            <h2 class="font_white text-center">SIGN UP</h2>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <label>
                                    You have already an account ? go to <a href="signin.php" target="_blank" style="color: #fff;">Sign in</a>
                                </label>
                            <div class="input-group">
                                <input type="checkbox" id="terms" name="terms" required>
                                <label for="terms">
                                    I agree to the <a href="terms_and_conditions.php" target="_blank" style="color: #fff;">Terms and Conditions</a>
                                </label>
                            </div>
                            <div class="footer text-center">
                                <button type="submit" name="submit" class="btn btn-neutral btn-round btn-lg">Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var terms = document.getElementById('terms').checked;
            if (!terms) {
                alert('Must agree with terms and conditions to proceed');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

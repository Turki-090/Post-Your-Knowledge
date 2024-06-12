<?php
require_once 'functions/db_connection.php';
require_once 'functions/user.php';
require_once 'functions/web.php';
$active = null;

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
    <title>Terms and Conditions | PostYourKnowledge</title>
    <?php require_once 'components/styles.php'; ?>
    <style>
        .stylish-form {
            padding: 10px;
            font-family: Arial, sans-serif;
        }

        .stylish-form h1, .stylish-form h2, .stylish-form h4 {
            color: #FFFFFF;
            margin-top: 20px;
            text-align: center;
        }

        .content {
            background-color: #809E77;
            color: #FFFFFF;
            width: 100%; /* Adjusted for full width on small screens */
            padding: 20px;
            border-radius: 8px;
            margin: 20px auto;
            line-height: 1.6;
        }

        .footer {
            margin-top: 40px;
            margin-bottom: 40px;
            text-align: center;
        }

        .btn-neutral, .btn-neutral:focus, .btn-neutral:hover {
            background-color: #FFFFFF;
            color: #809E77;
        }

        p, ul {
            margin-bottom: 15px;
        }

        ul {
            margin-left: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        @media (min-width: 768px) {
            .content {
                width: 50%; /* Adjust width for larger screens */
            }
        }
    </style>
</head>
<body>
    <?php require_once 'components/navbar.php' ?>
    <div class="container-fluid stylish-form">
        <div class="content">
            <h1>Terms and Conditions</h1>
        </div>
        
        <div class="content">
            <h2>Welcome to PostYourKnowledge!</h2>
            <p>These terms and conditions outline the rules and regulations for the use of PostYourKnowledge's Website, located at www.postyourknowledge.com</p>
            <p>By accessing this website we assume you accept these terms and conditions. Do not continue to use PostYourKnowledge if you do not agree to take all of the terms and conditions stated on this page.</p>
            
            <h2>Cookies</h2>
            <p>We employ the use of cookies. By accessing PostYourKnowledge, you agreed to use cookies in agreement with the PostYourKnowledge's Privacy Policy.</p>

            <h2>License</h2>
            <p>Unless otherwise stated, PostYourKnowledge and/or its licensors own the intellectual property rights for all material on PostYourKnowledge. All intellectual property rights are reserved. You may access this from PostYourKnowledge for your own personal use subjected to restrictions set in these terms and conditions.</p>

            <h2>User Behavior</h2>
            <h4>You must not :</h4> 
            <ul>
                <li>Republish material from PostYourKnowledge</li>
                <li>Sell, rent or sub-license material from PostYourKnowledge</li>
                <li>Reproduce, duplicate or copy material from PostYourKnowledge</li>
                <li>Redistribute content from PostYourKnowledge</li>
            </ul>

            <p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. PostYourKnowledge does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of PostYourKnowledge, its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, PostYourKnowledge shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.</p>

            <div class="footer">
    <?php if (!isLoggedIn()): ?>
        <a href="signup.php" class="btn btn-primary" style="color:white">Go to Sign-up</a>
    <?php endif; ?>
    <a href="index.php" class="btn btn-primary" style="color:white">Go to Home Page</a>
</div>


        </div>
    </div>
    <script>
        // Additional scripts can be added here if needed
    </script>
</body>
</body>
</html>
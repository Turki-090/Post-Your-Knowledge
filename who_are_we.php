<?php
session_start();
require_once 'functions/web.php';
require_once 'functions/db_connection.php';
require_once 'functions/post.php';
$active = 'home';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Who Are We | PostYourKnowledge</title>
    <?php require_once 'components/styles.php' ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style type="text/css">
        .container {
            margin-top: 20px;
        }
        .about-section {
            padding: 40px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        .team {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
        }
        .team-member {
            text-align: center;
            max-width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 150px; /* Adjust height as needed */
        }
        .team-member img {
            width: 100%;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .team-member h3 {
            font-size: 22px;
            margin-top: 15px;
            color: #333;
        }
        .team-member p {
            font-size: 16px;
            color: #809E77;
        }
        .linkedin-container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .linkedin-container a {
            color: #0e76a8;
            font-size: 24px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php require_once 'components/navbar.php' ?>
    <div class="container">
        <div class="about-section">
            <h1>Who Are We</h1>
            <p>Welcome to PostYourKnowledge!
                 We are a team of passionate individuals dedicated to sharing and spreading knowledge across the globe.
                  Our platform allows users to post, share, and discuss various topics to help everyone learn and grow together.</p>
        </div>
        <div class="team">
            <div class="team-member">
                <h3>Turki Almufarrej</h3>
                <p>Founder & Developer</p>
                <div class="linkedin-container">
                    <a href="https://www.linkedin.com/in/turki-almufarrej-182547202/" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
            <div class="team-member">
                <h3>Faisal Aladdad</h3>
                <p>Co-founder & Documentarian</p>
                <div class="linkedin-container">
                    <a href="https://www.linkedin.com/in/faisal-aladdad-8636a7265/" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
            <div class="team-member">
                <h3>Abdulrahman Al-Otaibi</h3>
                <p>Co-founder & Designer</p>
                <div class="linkedin-container">
                    <a href="https://www.linkedin.com/in/abdulrhaman-nasser-606965309" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php

require_once 'functions/web.php';

if (isset($_POST['logout'])) {
    logout();
}
alertMessage('You have logged out successfully');
redirect('index.php');

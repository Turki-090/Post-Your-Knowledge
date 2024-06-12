<?php
	if (!isset($_GET["id"])) {
		exit();
	}

    $file = "photos/" . $_GET['id'] . ".jpg";

	if (!file_exists($file)) {
		 $file = "photos/0.jpg";
	}

    header('Content-Type: image/jpeg');
    header('Content-Length: ' . filesize($file));
    echo file_get_contents($file);
?>


<?php
if (!isset($_GET["id"])) {
    exit("No file specified.");
}

$file_id = $_GET['id'];

// Check for both PDF and DOCX files
$pdf_path = "files/" . $file_id . ".pdf";
$docx_path = "files/" . $file_id . ".docx";

if (file_exists($pdf_path)) {
    $file_path = $pdf_path;
    $content_type = 'application/pdf';
} elseif (file_exists($docx_path)) {
    $file_path = $docx_path;
    $content_type = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
} else {
    exit("File not found.");
}

// Set headers for file download
header('Content-Type: ' . $content_type);
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Length: ' . filesize($file_path));
readfile($file_path);
?>

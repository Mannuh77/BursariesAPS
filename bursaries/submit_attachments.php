<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'kibweziwest';

$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$user_id = $_SESSION['user_id'];
$upload_dir = __DIR__ . '/uploads/';  // Make sure this directory exists and is writable

// Create upload directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Helper function to upload a single file and return new filename or false
function uploadFile($file, $upload_dir) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $file['tmp_name'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        // Create a unique filename to avoid conflicts
        $new_filename = uniqid() . '.' . $ext;
        $destination = $upload_dir . $new_filename;
        if (move_uploaded_file($tmp_name, $destination)) {
            return $new_filename;
        }
    }
    return false;
}

// Upload required files
$birthCertificate = $_FILES['birthCertificate'] ?? null;
$admissionLetter = $_FILES['admissionLetter'] ?? null;
$feesStructure = $_FILES['feesStructure'] ?? null;
$faithLetter = $_FILES['faithLetter'] ?? null;
$otherDocuments = $_FILES['otherDocuments'] ?? null;

if (!$birthCertificate || !$admissionLetter || !$feesStructure) {
    die("Required files are missing.");
}

// Upload files
$birthCertFile = uploadFile($birthCertificate, $upload_dir);
$admissionLetterFile = uploadFile($admissionLetter, $upload_dir);
$feesStructureFile = uploadFile($feesStructure, $upload_dir);
$faithLetterFile = null;

if ($faithLetter && $faithLetter['error'] !== UPLOAD_ERR_NO_FILE) {
    $faithLetterFile = uploadFile($faithLetter, $upload_dir);
}

// Upload multiple other documents if any
$otherDocumentsFiles = [];
if ($otherDocuments && isset($otherDocuments['name']) && is_array($otherDocuments['name'])) {
    for ($i = 0; $i < count($otherDocuments['name']); $i++) {
        if ($otherDocuments['error'][$i] === UPLOAD_ERR_OK) {
            $tmp_name = $otherDocuments['tmp_name'][$i];
            $ext = pathinfo($otherDocuments['name'][$i], PATHINFO_EXTENSION);
            $new_filename = uniqid() . '.' . $ext;
            $destination = $upload_dir . $new_filename;
            if (move_uploaded_file($tmp_name, $destination)) {
                $otherDocumentsFiles[] = $new_filename;
            }
        }
    }
}

// Convert other documents array to JSON string for storage
$otherDocumentsJson = !empty($otherDocumentsFiles) ? json_encode($otherDocumentsFiles) : null;

// Insert into DB
$sql = "INSERT INTO attachments (
    user_id, birth_certificate, admission_letter, fees_structure, faith_letter, other_documents
) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

$stmt->bind_param(
    "isssss",
    $user_id,
    $birthCertFile,
    $admissionLetterFile,
    $feesStructureFile,
    $faithLetterFile,
    $otherDocumentsJson
);

if ($stmt->execute()) {
    echo "<script>alert('Attachments uploaded successfully.'); window.location.href = 'next_step.php';</script>";
} else {
    echo "<script>alert('Failed to save attachments: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$mysqli->close();
?>

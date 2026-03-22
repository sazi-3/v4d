<?php
require_once __DIR__ . '/../adding/db.php';
require_once __DIR__ . '/../adding/functions.php';
session_start();

header('Content-Type: application/json');

if (!is_admin()) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_FILES['image'])) {
    echo json_encode(['error' => 'No image uploaded']);
    exit;
}

$file = $_FILES['image'];
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
$temp_path = $file['tmp_name'];

// 1. Check for standard PHP Errors (0 is OK)
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['error' => "PHP upload error: " . $file['error']]);
    exit;
}

// 2. Local validation for debugging
$allowed_ext = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
if (!in_array($ext, $allowed_ext)) {
    echo json_encode(['error' => "Extension .$ext not allowed"]);
    exit;
}

// 3. Create destination and ensure it exists
$dest_dir = __DIR__ . '/../uploads/tournaments/';
if (!is_dir($dest_dir)) {
    mkdir($dest_dir, 0777, true);
}

// Try native upload first to avoid function overhead
$filename = uniqid('t_', true) . '.' . $ext;
$target_path = $dest_dir . $filename;

if (move_uploaded_file($temp_path, $target_path)) {
    // SUCCESS
    $url = base_url('uploads/tournaments/' . $filename);
    echo json_encode(['url' => $url]);
} else {
    // FAIL
    echo json_encode([
        'error' => "Failed to move uploaded file.",
        'debug' => [
            'target' => $target_path,
            'is_writable' => is_writable($dest_dir),
            'temp_exists' => file_exists($temp_path)
        ]
    ]);
}

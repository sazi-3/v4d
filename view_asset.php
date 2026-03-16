<?php
/**
 * view_asset.php - Securely serves assets from outside the web root.
 * Location: inside htdocs (or project subfolder)
 */

// 1. Path to the private uploads folder (one level above htdocs/v4d)
$base_path = realpath(__DIR__ . '/../uploads_v4d');

// 2. Identify the file from the URL parameter
$requested_file = $_GET['file'] ?? '';

if (!$requested_file) {
    header("HTTP/1.0 400 Bad Request");
    exit("File parameter is missing.");
}

// 3. Security: Prevent directory traversal
// We resolve the absolute path and ensure it's strictly inside the base_path
$full_path = realpath($base_path . DIRECTORY_SEPARATOR . $requested_file);

if ($full_path && strpos($full_path, $base_path) === 0 && is_file($full_path)) {
    // 4. Detect MIME type and serve
    $mime = mime_content_type($full_path);
    
    // Set headers
    header("Content-Type: $mime");
    header("Content-Length: " . filesize($full_path));
    
    // Optional: Cache for 1 day to improve performance on InfinityFree
    header("Cache-Control: public, max-age=86400");
    
    // 5. Serve the image
    readfile($full_path);
    exit;
} else {
    // 404 if path is invalid, traversal attempt, or file doesn't exist
    header("HTTP/1.0 404 Not Found");
    exit("Asset not found.");
}

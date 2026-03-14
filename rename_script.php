<?php
$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__));
foreach ($dir as $file) {
    if ($file->isFile() && $file->getExtension() === 'php' && strpos($file->getFilename(), 'rename_script') === false) {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        $original = $content;

        // General rules for includes/...
        $content = str_replace('/includes/db.php', '/adding/db.php', $content);
        $content = str_replace('/includes/functions.php', '/adding/functions.php', $content);
        $content = str_replace('/includes/header.php', '/adding/header.php', $content);
        $content = str_replace('/includes/footer.php', '/adding/footer.php', $content);
        
        $content = str_replace("'includes/db.php'", "'adding/db.php'", $content);
        $content = str_replace("'includes/functions.php'", "'adding/functions.php'", $content);
        $content = str_replace("'includes/header.php'", "'adding/header.php'", $content);
        $content = str_replace("'includes/footer.php'", "'adding/footer.php'", $content);

        $content = str_replace('"includes/db.php"', '"adding/db.php"', $content);
        $content = str_replace('"includes/functions.php"', '"adding/functions.php"', $content);
        $content = str_replace('"includes/header.php"', '"adding/header.php"', $content);
        $content = str_replace('"includes/footer.php"', '"adding/footer.php"', $content);

        // Fix user's broken admin/index.php path
        $content = str_replace("__DIR__ . '../includes/db.php'", "__DIR__ . '/../adding/db.php'", $content);
        $content = str_replace("__DIR__ . '../includes/functions.php'", "__DIR__ . '/../adding/functions.php'", $content);
        $content = str_replace("__DIR__ . '../adding/db.php'", "__DIR__ . '/../adding/db.php'", $content);
        $content = str_replace("__DIR__ . '../adding/functions.php'", "__DIR__ . '/../adding/functions.php'", $content);

        if ($content !== $original) {
            file_put_contents($path, $content);
            echo "Fixed $path\n";
        }
    }
}
echo "Done.\n";

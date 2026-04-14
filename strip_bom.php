<?php
$file = 'src/Controller/EvenementController.php';
$content = file_get_contents($file);
$content = preg_replace('/^[\xef\xbb\xbf]+/', '', $content);
file_put_contents($file, $content);
echo "BOM removed from $file\n";

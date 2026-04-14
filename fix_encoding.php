<?php
$dirs = [__DIR__ . '/src/Form', __DIR__ . '/templates'];

$replacements = [
    'Ã©' => 'é',
    'Ã‰' => 'É',
    'Ã¨' => 'è',
    'Ãˆ' => 'È',
    'Ãª' => 'ê',
    'Ã\\' => 'Ê', // sometimes 'ÃŠ'
    'ÃŠ' => 'Ê',
    'Ã«' => 'ë',
    'Ã»' => 'û',
    'Ã¢' => 'â',
    'Ã§' => 'ç',
    'Ã\xA0' => 'à',
    'Ã ' => 'à',
    'Ã®' => 'î',
    'Ã´' => 'ô',
    'lâ€™' => "l'",
    'dâ€™' => "d'",
    'quâ€™' => "qu'",
    'nâ€™' => "n'",
    'sâ€™' => "s'",
    'câ€™' => "c'",
];

function fixDir($dir, $replacements) {
    if (!is_dir($dir)) return;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isDir()) continue;
        
        $ext = pathinfo($file->getPathname(), PATHINFO_EXTENSION);
        if ($ext !== 'php' && $ext !== 'twig') continue;

        $content = file_get_contents($file->getPathname());
        $newContent = strtr($content, $replacements);
        
        if ($newContent !== $content) {
            file_put_contents($file->getPathname(), $newContent);
            echo "Fixed encoding in: " . $file->getPathname() . "\n";
        }
    }
}

foreach ($dirs as $dir) {
    fixDir($dir, $replacements);
}
echo "Done.\n";

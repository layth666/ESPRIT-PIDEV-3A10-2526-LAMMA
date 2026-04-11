<?php
/**
 * Lamma Project Setup Automation Script
 * This script copies folders from the download source to the public project directory
 * and runs doctrine:schema:update to create missing tables.
 */

$sourceBase = 'C:/Users/user/Downloads/eventcon-master/eventcon-master';
$publicDir = __DIR__;

function recursive_copy($src, $dst) {
    if (is_dir($src)) {
        if (!is_dir($dst)) @mkdir($dst, 0777, true);
        $files = scandir($src);
        foreach ($files as $file) {
            if ($file != "." && $file != "..") recursive_copy("$src/$file", "$dst/$file");
        }
    } elseif (file_exists($src)) {
        copy($src, $dst);
    }
}

header('Content-Type: text/html; charset=utf-8');
echo "<h1>🏔 Lamma Setup Assistant</h1>";

// 1. Asset Migration
echo "<h2>1. Migration des Assets...</h2>";
$folders = ['css', 'js', 'img', 'fonts', 'scss'];
foreach ($folders as $folder) {
    $src = $sourceBase . '/' . $folder;
    $dst = $publicDir . '/' . $folder;
    if (is_dir($src)) {
        echo "Copiage de '$folder'... ";
        recursive_copy($src, $dst);
        echo "✅<br>";
    }
}

// Logo spécifique
$logoSrc = 'C:/Users/user/Downloads/0e89343c-b791-4b35-94bb-455cf5b66aee-removebg-preview.png';
$logoDst = $publicDir . '/img/logo_lamma.png';
if (file_exists($logoSrc)) {
    echo "Migration du logo... ";
    copy($logoSrc, $logoDst);
    echo "🦆 ✅<br>";
}

// 2. Sync Database
echo "<h2>2. Synchronisation de la Base de Données...</h2>";
$projectRoot = dirname(__DIR__);
chdir($projectRoot);

$syncScript = $projectRoot . '/sync_db.php';
$syncContent = <<<'PHP'
<?php
use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__.'/vendor/autoload.php';
(new Dotenv())->bootEnv(__DIR__.'/.env');
$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();
$container = $kernel->getContainer();
$em = $container->get('doctrine.orm.entity_manager');
$conn = $em->getConnection();

echo "Désactivation des FK checks et Réinitialisation Complète...\n";
$conn->executeStatement("SET FOREIGN_KEY_CHECKS = 0;");

// DROP ALL TABLES AND VIEWS FOR CLEAN SYNC
$tables = $conn->iterateAssociative("SHOW FULL TABLES");
foreach($tables as $tableRow) {
    $tableName = current($tableRow);
    $tableType = next($tableRow);
    try {
        if ($tableType === 'VIEW') {
            echo "Suppression de la vue $tableName...\n";
            $conn->executeStatement("DROP VIEW IF EXISTS `$tableName`;");
        } else {
            echo "Suppression de la table $tableName...\n";
            $conn->executeStatement("DROP TABLE IF EXISTS `$tableName`;");
        }
    } catch (\Exception $e) {
        echo "Note: " . $e->getMessage() . "\n";
    }
}

echo "Recréation de la structure du projet LAMMA...\n";
$output = shell_exec("php bin/console doctrine:schema:update --force --no-interaction 2>&1");
echo $output;
$conn->executeStatement("SET FOREIGN_KEY_CHECKS = 1;");
PHP;

file_put_contents($syncScript, $syncContent);

$cmd = "php sync_db.php 2>&1";
$output = shell_exec($cmd);
echo "<pre style='background:#f4f4f4;padding:10px;'>$output</pre>";
@unlink($syncScript);

echo "<hr><p>Vous pouvez maintenant accéder à votre projet : <a href='/'>Accueil</a></p>";

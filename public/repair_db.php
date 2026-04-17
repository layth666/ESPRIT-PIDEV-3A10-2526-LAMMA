<?php
/**
 * REPAIR DATABASE SCHEMA (AUTO-SYNC)
 * This script allows you to synchronize your database schema with the new PHP entities 
 * directly from your browser. 
 * Use this to fix "Column not found" errors and allow data persistence (l'ajout).
 */

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Doctrine\ORM\Tools\SchemaTool;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/.env')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();
$container = $kernel->getContainer();
$entityManager = $container->get('doctrine.orm.entity_manager');

$schemaTool = new SchemaTool($entityManager);
$metadata = $entityManager->getMetadataFactory()->getAllMetadata();

try {
    // Generate the SQL for the update
    $sqls = $schemaTool->getUpdateSchemaSql($metadata, true);
    
    if (empty($sqls)) {
        echo "<h1>✅ Database is already up to date!</h1>";
        echo "<p>Your schema matches your entities perfectly.</p>";
    } else {
        echo "<h1>🛠️ Synchronizing Database...</h1>";
        echo "<ul>";
        foreach ($sqls as $sql) {
            echo "<li><code>$sql</code></li>";
        }
        echo "</ul>";
        
        $schemaTool->updateSchema($metadata, true);
        echo "<h2 style='color: green;'>✅ Success! Database repaired.</h2>";
        echo "<p>You can now add data ('l'ajout') in your forms.</p>";
    }
} catch (\Exception $e) {
    echo "<h2 style='color: red;'>❌ Error: " . $e->getMessage() . "</h2>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<hr><a href='/'>Retour à l'Accueil</a>";
?>

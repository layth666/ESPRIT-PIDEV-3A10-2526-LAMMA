<?php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'app:generate-repositories',
    description: 'Generates repository classes for all entities.',
)]
class GenerateRepositoriesCommand extends Command
{
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $finder = new Finder();
        $entityDir = __DIR__ . '/../Entity';
        $repoDir = __DIR__ . '/../Repository';

        if (!$this->filesystem->exists($entityDir)) {
            $io->error('The Entity directory does not exist.');
            return Command::FAILURE;
        }

        if (!$this->filesystem->exists($repoDir)) {
            $this->filesystem->mkdir($repoDir);
        }

        $finder->files()->in($entityDir)->name('*.php');

        foreach ($finder as $file) {
            $className = $file->getFilenameWithoutExtension();
            $repoClassName = $className . 'Repository';
            $repoFilePath = $repoDir . '/' . $repoClassName . '.php';

            $code = "<?php\n\nnamespace App\Repository;\n\n";
            $code .= "use App\Entity\\$className;\n";
            $code .= "use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;\n";
            $code .= "use Doctrine\Persistence\ManagerRegistry;\n\n";
            $code .= "/**\n * @extends ServiceEntityRepository<$className>\n */\n";
            $code .= "class $repoClassName extends ServiceEntityRepository\n{\n";
            $code .= "    public function __construct(ManagerRegistry \$registry)\n    {\n";
            $code .= "        parent::__construct(\$registry, $className::class);\n    }\n";
            $code .= "}\n";

            $this->filesystem->dumpFile($repoFilePath, $code);
            $io->success("Generated: src/Repository/$repoClassName.php");
        }

        $io->success('Repositories successfully generated.');
        return Command::SUCCESS;
    }
}
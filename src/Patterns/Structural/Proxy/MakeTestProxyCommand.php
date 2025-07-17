<?php

namespace App\Patterns\Structural\Proxy;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsCommand(
    name: 'make:test-proxy',
    description: 'Test command for the Proxy pattern',
)]
class MakeTestProxyCommand extends Command
{
    public function __construct(
        private readonly ImageLoaderInterface $imageLoader,
        #[Autowire('%kernel.project_dir%/public/Proxy')]
        private readonly string               $proxyFolderPath
    )
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->imageLoader->stream($this->proxyFolderPath);

        $io->success('Image streaming completed successfully.');
        return Command::SUCCESS;
    }
}

<?php

namespace App\Patterns\Creational\Singleton;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\Cache\CacheInterface;

#[AsCommand(
    name: 'make:test-singleton',
    description: 'Add a short description for your command',
)]
class MakeTestSingletonCommand extends Command
{
    public function __construct(
        private CacheInterface $cache,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $key = 'test_singleton';
        $io = new SymfonyStyle($input, $output);
        CacheSingleton::getInstance()->setCache($this->cache);
        $cache = CacheSingleton::getInstance();

        if ($cache->get($key)) {
            $io->success('Test singleton already exists.');
            return Command::SUCCESS;
        }

        $cache->set($key, ['name' => 'Test Singleton', 'description' => 'This is a test singleton.']);
        $io->success('Test singleton created successfully.');

        return Command::SUCCESS;
    }
}

<?php

namespace App\SOLID\SRP;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-srp',
    description: 'Create a new test SRP command',
)]
class MakeTestSrpCommand extends Command
{
    public function __construct(
        private UserAuthService $userAuthService,
    )
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Single Responsibility Principle (SRP) Test');
        $io->section('Creating User Entity');
        $user = new User();
        $user->setName('John Doe')
            ->setEmail('john.doe@email.com')
            ->setPassword('Securepassword1234')
            ->setCreatedAt(new \DateTime());
        $io->text('User created successfully:');
        $io->section('Fake Login');
        $this->userAuthService->login($user);
        $io->success('User logged in successfully!');
        return Command::SUCCESS;
    }
}

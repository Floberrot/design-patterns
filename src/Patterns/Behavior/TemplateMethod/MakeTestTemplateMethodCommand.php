<?php

namespace App\Patterns\Behavior\TemplateMethod;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-template-method',
    description: 'Create a new test template method command',
)]
class MakeTestTemplateMethodCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Creating Test Template Method Command');
        $io->section('Generating Template Method Classes');
        $io->text('Creating Player, Wizard, and Warrior classes...');
        $io->info('Warrior');
        $warrior = new Warrior();
        $warrior->setUsername('WarriorUser')
            ->setAttackPower(100)
            ->setDefensePower(50)
            ->setStamina(200)
            ->setHealth(300)
            ->setLevel(1)
            ->setSwordName('Excalibur');
        $io->text($warrior->render());

        $io->success('Warrior created successfully!');
        $io->info('Wizard');
        $wizard = new Wizard();
        $wizard->setUsername('WizardUser')
            ->setAttackPower(80)
            ->setDefensePower(40)
            ->setMagicPower(120)
            ->setMana(150)
            ->setStamina(150)
            ->setHealth(250)
            ->setMana(200)
            ->setLevel(1);
        $io->text($wizard->render());

        $io->success('Wizard created successfully!');
        $io->info('Orc');
        $orc = new Orc();
        $orc->setUsername('OrcUser')
            ->setAttackPower(90)
            ->setDefensePower(60)
            ->setStamina(180)
            ->setHealth(280)
            ->setLevel(1)
            ->setDangerousness(5);
        $io->text($orc->render());
        $io->success('Orc created successfully!');
        $io->text('All classes created successfully!');
        return Command::SUCCESS;
    }
}

<?php

namespace App\Patterns\Creational\AbstractFactory;

use App\Patterns\Creational\AbstractFactory\Magento\MagentoCustomer;
use App\Patterns\Creational\AbstractFactory\Magento\MagentoOrder;
use App\Patterns\Creational\AbstractFactory\Magento\MagentoProduct;
use App\Patterns\Creational\AbstractFactory\WordPress\WordPressOrder;
use App\Patterns\Creational\AbstractFactory\WordPress\WordPressProduct;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'make:test-abstract-factory',
    description: 'All my commands are tests.',
)]
class MakeTestAbstractFactoryCommand extends Command
{
    public function __construct(
        private readonly EcommerceFactoryResolver $factoryResolver,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Abstract Factory Pattern Test');
        $io->section('Creating WordPress Factory');

        $factory = $this->factoryResolver->getFactory(EcommerceTypeEnum::WORDPRESS);
        $wordPressOrder = $factory->createOrder();
        if ($wordPressOrder instanceof WordPressOrder) {
            $io->success('WordPress Order created successfully.');
        } else {
            $io->error('Failed to create WordPress Order.');
        }
        $wordPressProduct = $factory->createProduct();
        if ($wordPressProduct instanceof WordPressProduct) {
            $io->success('WordPress Product created successfully.');
        } else {
            $io->error('Failed to create WordPress Product.');
        }

        try {
            $factory->createCustomer();
        } catch (\Throwable $exception) {
            if ($exception instanceof \LogicException && str_contains($exception->getMessage(), 'Wordpress has not customer')) {
                $io->success('Customer creation is not implemented for WordPress.');
            } else {
                $io->error('WordPress customer should not have customer creation implemented.');
            }
        }

        $io->section('Creating Magento Factory');
        $magentoFactory = $this->factoryResolver->getFactory(EcommerceTypeEnum::MAGENTO);
        $magentoOrder = $magentoFactory->createOrder();
        if ($magentoOrder instanceof MagentoOrder) {
            $io->success('Magento Order created successfully.');
        } else {
            $io->error('Failed to create Magento Order.');
        }
        $magentoProduct = $magentoFactory->createProduct();
        if ($magentoProduct instanceof MagentoProduct) {
            $io->success('Magento Product created successfully.');
        } else {
            $io->error('Failed to create Magento Product.');
        }
        $magentoCustomer = $magentoFactory->createCustomer();
        if ($magentoCustomer instanceof MagentoCustomer) {
            $io->success('Magento Customer created successfully.');
        } else {
            $io->error('Failed to create Magento Customer.');
        }

        return Command::SUCCESS;
    }
}

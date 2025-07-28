<?php

namespace App\Patterns\Behavior\Observer;

interface ObserverInterface extends \SplObserver
{

    public function supports(EventClientSupportedEnum $event): bool;
}

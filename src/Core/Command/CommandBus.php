<?php

namespace App\Core\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;
}

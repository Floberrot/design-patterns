<?php

namespace App\Core\Query;

interface QueryBus
{
    public function ask(Query $message): mixed;
}

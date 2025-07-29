<?php

namespace App\Patterns\Behavior\State\States;

use App\Patterns\Behavior\State\Document;
use App\Patterns\Behavior\State\DocumentState;

class DraftState extends DocumentState
{
    public function __construct(Document $document)
    {
        parent::__construct($document);
    }
}

<?php

namespace App\Patterns\Behavior\State\States;

use App\Patterns\Behavior\State\Document;
use App\Patterns\Behavior\State\DocumentState;
use App\Patterns\Behavior\State\DocumentStateEnum;

class RejectedState extends DocumentState
{
    protected const DocumentStateEnum DOCUMENT_STATE = DocumentStateEnum::REJECTED;

    public function __construct(Document $document)
    {
        parent::__construct($document);
    }
}

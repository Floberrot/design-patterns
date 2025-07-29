<?php

namespace App\Patterns\Behavior\State\States;

use App\Patterns\Behavior\State\Document;
use App\Patterns\Behavior\State\DocumentState;
use App\Patterns\Behavior\State\DocumentStateEnum;

class PendingState extends DocumentState
{
    protected const DocumentStateEnum DOCUMENT_STATE = DocumentStateEnum::PENDING;

    public function __construct(Document $document)
    {
        parent::__construct($document);
    }

    public function submit(): void
    {
        if ($this->document->getEmail() === null) {
            $this->document->setState(new RejectedState($this->document));
            echo "Document rejected due to missing email.\n";
            return;
        }

        $this->document->setState(new ApprovedState($this->document));
        echo "Document approved and ready for sending.\n";
    }
}

<?php

namespace App\Patterns\Creational\Prototype;

enum QuoteStatusEnum: string
{
    case SENT = 'sent';
    case DRAFT = 'draft';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';
}

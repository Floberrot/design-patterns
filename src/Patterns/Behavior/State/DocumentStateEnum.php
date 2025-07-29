<?php

namespace App\Patterns\Behavior\State;

enum DocumentStateEnum: string
{
    case DRAFT = 'draft';
    case APPROVED = 'approved';
    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case ARCHIVED = 'archived';
    case SENT = 'sent';

    public static function next(self $state): array
    {
        return match ($state) {
            self::DRAFT => [self::PENDING],
            self::PENDING => [self::APPROVED, self::REJECTED],
            self::APPROVED => [self::SENT],
            self::REJECTED => [self::ARCHIVED],
            self::ARCHIVED => [],
            self::SENT => [],
        };
    }

    public static function toStateClass(self $state): string
    {
        return ucfirst($state->value) . 'State';
    }
}

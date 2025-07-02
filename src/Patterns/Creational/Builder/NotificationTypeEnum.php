<?php

namespace App\Patterns\Creational\Builder;

enum NotificationTypeEnum: string
{
    case ALERT = 'alert';
    case WARNING = 'warning';
    case INFO = 'info';
    case SUCCESS = 'success';
    case ERROR = 'error';
}

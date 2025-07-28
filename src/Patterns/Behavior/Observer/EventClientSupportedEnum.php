<?php

namespace App\Patterns\Behavior\Observer;

enum EventClientSupportedEnum: string
{
    case USER_UPDATE = 'user.update';
    case DISCORD_NOTIFICATION = 'discord.notification';
    case EMAIL_NOTIFICATION = 'email.notification';
    case LOGGER_NOTIFICATION = 'logger.notification';
}

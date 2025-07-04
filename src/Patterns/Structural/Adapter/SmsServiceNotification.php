<?php

namespace App\Patterns\Structural\Adapter;

use App\Core\AbstractServices;
use Symfony\Component\Notifier\Message\SmsMessage;

// Pretending this is an external service that sends SMS notifications
class SmsServiceNotification extends AbstractServices
{
    public function push(string $number, string $message): void
    {
        $sms = new SmsMessage(
            $number,
            $message,
        );

        $this->getTwilioNotifier()->send($sms);
    }
}

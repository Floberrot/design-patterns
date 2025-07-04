<?php

namespace App\Patterns\Structural\Adapter;

class SmsNotificationAdapter implements NotificationInterface
{
    private string $phoneNumber;

    public function __construct(
        private SmsServiceNotification $smsServiceNotification,
    )
    {
    }

    public function send(string $message): void
    {
        $this->smsServiceNotification->push($this->phoneNumber, $message);
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }
}

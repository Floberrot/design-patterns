<?php

namespace App\Patterns\Behavior\Observer;

use App\Core\AbstractServices;
use SplSubject;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\RawMessage;

class EmailClientObserver extends Observer
{
    protected const array SUPPORTED_EVENTS = [
        EventClientSupportedEnum::EMAIL_NOTIFICATION,
        EventClientSupportedEnum::USER_UPDATE,
    ];

    public function __construct(
        private readonly AbstractServices $abstractServices,
    )
    {
    }

    public function update(SplSubject $subject): void
    {
        if (!$subject instanceof Client) {
            return;
        }

        $sender = new Address('test@test.com', 'Test Sender');
        $recipient = new Address($subject->getEmail(), 'Coucou ' . $subject->getName());

        $this->abstractServices->getMailer()->send(new RawMessage('Subject: Test Observer'), new Envelope(
            $sender,
            [$recipient]
        ));
    }
}

<?php

namespace App\Patterns\Structural\Adapter;

use App\Core\AbstractServices;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\RawMessage;

class EmailNotification extends AbstractServices implements NotificationInterface
{

    public function send(string $message): void
    {
        $sender = new Address('test@test.com', 'Test Sender');
        $recipient = new Address('coucou@coucou.com', 'Coucou Recipient');
        $this->getMailer()->send(new RawMessage($message), new Envelope(
            $sender,
            [$recipient]
        ));
    }
}

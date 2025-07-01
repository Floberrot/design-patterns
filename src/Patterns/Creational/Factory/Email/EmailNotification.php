<?php

namespace App\Patterns\Creational\Factory\Email;

use App\Core\AbstractServices;
use App\Patterns\Creational\Factory\Notification;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\RawMessage;

final class EmailNotification extends AbstractServices implements Notification
{
    /**
     * @throws TransportExceptionInterface
     *
     */
    public function send(): void
    {
        // here we optionally add more logic or parameters to have a more complex email
        $sender = new Address('test@test.com', 'Test Sender');
        $recipient = new Address('coucou@coucou.com', 'Coucou Recipient');
        $this->getMailer()->send(new RawMessage('Subject: Test Email'), new Envelope(
            $sender,
            [$recipient]
        ));
    }
}

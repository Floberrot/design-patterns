<?php

namespace App\Core;

use Psr\Container\ContainerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Contracts\Service\Attribute\SubscribedService;
use Symfony\Contracts\Service\ServiceMethodsSubscriberTrait;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class AbstractServices implements ServiceSubscriberInterface
{
    use ServiceMethodsSubscriberTrait;

    protected ContainerInterface $container;

    #[SubscribedService('mailer')]
    public function getMailer(): MailerInterface
    {
        return $this->container->get('mailer');
    }

    #[SubscribedService('discord')]
    public function getDiscordNotifier(): ChatterInterface
    {
        return $this->container->get('discord');
    }
}

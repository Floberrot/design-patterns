<?php

namespace App\Patterns\Behavior\ChainOfResponsibility\Handlers;

use App\Core\AbstractServices;
use App\Patterns\Behavior\ChainOfResponsibility\AbstractHandler;
use App\Patterns\Behavior\ChainOfResponsibility\PokemonMessage;
use App\Patterns\Creational\Builder\NotificationDirector;
use App\Patterns\Creational\Builder\NotificationTypeEnum;
use App\Patterns\Creational\Builder\SimpleDiscordNotification\SimpleDiscordNotificationBuilder;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'command.bus')]
class NotifyUserHandler extends AbstractHandler
{
    public const int DEFAULT_PRIORITY = 1;

    public function __construct(
        #[TaggedIterator('app.pokemon', indexAttribute: 'step', defaultPriorityMethod: 'getPriority')]
        iterable                                 $steps,
        private SimpleDiscordNotificationBuilder $simpleDiscordNotificationBuilder,
        private AbstractServices                 $abstractServices,
    )
    {
        parent::__construct($steps);
    }

    public function __invoke(PokemonMessage $message): void
    {
        $message->io->title('Notify User Handler');
        if ($message->email === '' || $message->sortedPokemonData === null) {
            $message->io->error('No email provided or no sorted Pokemon data available to notify.');
            $this->exit();
            return;
        }

        $director = new NotificationDirector(
            $this->simpleDiscordNotificationBuilder
        );

        $data = [
            'title' => 'Pokemon Notification',
            'body' => 'Here is the information about your Pokemon: name: ' .
                $message->sortedPokemonData->getName() . ', type: '
                . implode(', ', $message->sortedPokemonData->getTypes()) . ', abilities: ' .
                implode(', ', $message->sortedPokemonData->getAbilities())
                . ', height: ' . $message->sortedPokemonData->getHeight() . ', weight: '
                . $message->sortedPokemonData->getWeight(),
            'footer' => 'Thank you for using our service',
            'author' => 'Pokemon Bot',
            'type' => NotificationTypeEnum::SUCCESS,
        ];

        $notification = $director->make($data);
        $this->abstractServices->getDiscordNotifier()->send($notification->content);

        $message->io->success('User notified successfully via Discord.');
        $this->setNext();
        $this->handle($message);
    }
}

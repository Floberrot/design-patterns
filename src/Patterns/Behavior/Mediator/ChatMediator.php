<?php

namespace App\Patterns\Behavior\Mediator;

class ChatMediator
{
    public string $currentMessage = '';
    private bool $isFinished = false;
    private ChatRoom $chatRoom;
    private LoggerService $loggerService;
    private NotificationService $notificationService;
    private ProfanityFilterService $profanityFilterService;


    public function receiveMessage(string $message, User $user): void
    {
        $this->currentMessage = $message;

        if ($this->profanityFilterService->containsProfanity($message)) {
            $this->profanityFilterService->filter($message, $user);

            $this->notificationService->sendNotification(
                sprintf('Your message contains inappropriate content, %s.', $user->getPseudo()),
                $this->chatRoom->name
            );
            return;
        }

        $this->notifyChatRoom($message, $user);
    }


    public function saveFilteredMessage(string $message, User $user): void
    {
        $this->currentMessage = $message;

        $this->notifyChatRoom($message, $user);
    }

    public function notifyChatRoom(string $message, User $user): void
    {
        $this->chatRoom->addMessage($message, $user);
    }

    public function notifyChatRoomUser(User $user, User $from, string $message): void
    {
        $this->notificationService->sendNotification(
            sprintf('Message TO %s: %s FROM %s', $user->getPseudo(), $message, $from->getPseudo()),
            $this->chatRoom->name
        );
    }

    public function logNotification(string $message): void
    {
        $this->loggerService->log(
            sprintf('Notification sent: %s', $message),
            'info'
        );
    }

    public function finished(): void
    {
        $this->isFinished = true;
        $this->currentMessage = '';
        $this->currentUser = null;
    }

    public function setChatRoom(ChatRoom $chatRoom): void
    {
        $this->chatRoom = $chatRoom;
    }

    public function setLoggerService(LoggerService $loggerService): void
    {
        $this->loggerService = $loggerService;
    }

    public function setNotificationService(NotificationService $notificationService): void
    {
        $this->notificationService = $notificationService;
    }

    public function setProfanityFilterService(ProfanityFilterService $profanityFilterService): void
    {
        $this->profanityFilterService = $profanityFilterService;
    }
}

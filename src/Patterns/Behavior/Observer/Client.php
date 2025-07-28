<?php

namespace App\Patterns\Behavior\Observer;

use SplObserver;

final class Client implements \SplSubject
{
    /**
     * @var SplObserver[]
     */
    private array $observers = [];
    private self $oldState;

    public function __construct(
        private string $name,
        private string $email
    )
    {
    }

    public function attach(SplObserver $observer): void
    {
        if (in_array($observer, $this->observers, true)) {
            return;
        }

        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer): void
    {
        if (!in_array($observer, $this->observers, true)) {
            return;
        }

        $this->observers = array_filter(
            $this->observers,
            fn(SplObserver $obs) => $obs !== $observer
        );
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function specificNotify(EventClientSupportedEnum $event): void
    {
        foreach ($this->observers as $observer) {
            if ($observer->supports($event)) {
                $observer->update($this);
            }
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return sprintf(
            'Client: %s, Email: %s',
            $this->name,
            $this->email
        );
    }

    public function update(?string $name, ?string $email, bool $discordOnly = false): void
    {
        $this->oldState = new self($this->name, $this->email);

        if ($name !== null) {
            $this->name = $name;
        }

        if ($email !== null) {
            $this->email = $email;
        }

        if ($discordOnly) {
            $this->specificNotify(EventClientSupportedEnum::DISCORD_NOTIFICATION);
            return;
        }

        $this->notify();
    }

    public function getOldState(): self
    {
        return $this->oldState;
    }
}

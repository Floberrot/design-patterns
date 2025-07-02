<?php

namespace App\Patterns\Creational\Prototype;

use App\Patterns\Creational\Singleton\ParameterBag;

class Quote implements Cloneable
{
    public function __construct(
        Author $author,
    )
    {
        $this->author = $author;
        $this->date = new \DateTimeImmutable();
        $this->status = QuoteStatusEnum::SENT;
    }

    public string $number;

    public string $text;

    private Author $author;

    private \DateTimeImmutable $date;

    public Customer $customer;

    public Address $address;

    private QuoteStatusEnum $status;

    public function clone(): Cloneable
    {
        return clone $this;
    }

    public function __clone(): void
    {
        $this->date = new \DateTimeImmutable();
        $this->status = QuoteStatusEnum::DRAFT;
        $this->author = ParameterBag::getInstance()->get('newAuthor');
        // deep clone to avoid shared references (Shallow clone would keep the same references, bad practice)
        $this->address = clone $this->address;
        $this->customer = clone $this->customer;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function getStatus(): QuoteStatusEnum
    {
        return $this->status;
    }
}

<?php

namespace App\Patterns\Behavior\ChainOfResponsibility;

use InvalidArgumentException;

class Pokemon
{
    private string $name;
    private string $height;
    private string $weight;
    private array $abilities = [];
    private array $types = [];
    private array $moves = [];

    public static function fromArray(array $data): self
    {
        $pokemon = new self();
        $pokemon->name = $data['name'];
        $pokemon->height = $data['height'];
        $pokemon->weight = $data['weight'];
        $pokemon->abilities = array_map(
            fn($ability) => $ability['ability']['name'],
            $data['abilities'] ?? []
        );
        $pokemon->types = array_map(
            fn($type) => $type['type']['name'],
            $data['types']
        );
        $pokemon->moves = array_map(
            fn($move) => $move['move']['name'],
            $data['moves']
        );

        if (count($pokemon->types) > 2) {
            throw new InvalidArgumentException('A Pokémon cannot have more than two types.');
        }

        return $pokemon;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function getAbilities(): array
    {
        return $this->abilities;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function getMoves(): array
    {
        return $this->moves;
    }

    public function __toString(): string
    {
        return sprintf(
            "Name: %s, Height: %s, Weight: %s, Abilities: %s, Types: %s",
            $this->name,
            $this->height,
            $this->weight,
            implode(', ', $this->abilities),
            implode(', ', $this->types)
        );
    }

    public function get(): array
    {
        return [
            'name' => $this->name,
            'height' => $this->height,
            'weight' => $this->weight,
            'abilities' => $this->abilities,
            'types' => $this->types,
            'moves' => $this->moves,
        ];
    }
}

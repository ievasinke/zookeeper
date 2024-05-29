<?php

namespace App;
class Food
{
    private string $name;
    private int $amount;

    public function __construct(string $name, int $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function reduceBy(int $reduceAmount)
    {
        $this->amount -= $reduceAmount;
    }

    public static function getFoodByFavorite(array $foods, string $name): ?Food
    {
        $favoriteFood = null;
        foreach ($foods as $food) {
            if ($food->getName() === $name) {
                $favoriteFood = $food;
            }
        }
        return $favoriteFood;
    }
}
<?php

namespace App;

use App\Food;
use App\Activity;

class Animal
{
    private string $name;
    private int $happinessLevel;
    private string $favoriteFood;
    private int $foodReserves = 100;

    public function __construct(string $name, int $happinessLevel, string $favoriteFood)
    {
        $this->name = $name;
        $this->happinessLevel = $happinessLevel;
        $this->favoriteFood = $favoriteFood;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHappinessLevel(): int
    {
        return $this->happinessLevel;
    }

    public function getFavoriteFood(): string
    {
        return $this->favoriteFood;
    }

    public function getFoodReserves(): int
    {
        return $this->foodReserves;
    }

    public function play()
    {
        $this->happinessLevel += 10;
        $this->foodReserves += 10;
    }

    public function work()
    {
        $this->happinessLevel -= 5;
        $this->foodReserves -= 10;
    }

    public function feed(Food $food)
    {
        if ($food->getName() === $this->favoriteFood) {
            $this->happinessLevel += 5;
            $this->foodReserves += 10;
        } else {
            $this->happinessLevel -= 5;
            $this->foodReserves -= 10 * 2;
        }
    }

    public function pet()
    {
        $this->happinessLevel += 5;
    }
}
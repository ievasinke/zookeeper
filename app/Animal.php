<?php

namespace App;

use App\Food;
use App\Activity;
use Carbon\Carbon;

class Animal
{
    private string $name;
    private int $happinessLevel;
    private string $favoriteFood;
    private int $foodReserves = 100;
    private string $lastFed;

    public function __construct(string $name, int $happinessLevel, string $favoriteFood)
    {
        $this->name = $name;
        $this->happinessLevel = $happinessLevel;
        $this->favoriteFood = $favoriteFood;
        $this->lastFed = Carbon::now()->subHours(3);
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

    public function getLastFed(): string
    {
        return $this->lastFed;
    }

    public function play()
    {
        $this->lastFed = Carbon::now()->addSeconds(5);
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
            $this->lastFed = Carbon::now();
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
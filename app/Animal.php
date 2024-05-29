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

    public function play(array $foods)
    {
        $favoriteFood = Food::getFoodByFavorite($foods, $this->favoriteFood);
        $this->lastFed = Carbon::now()->addSeconds(5);
        $this->happinessLevel += 10;
        $foodConsumption = 10;
        $this->foodReserves += $foodConsumption;
        $favoriteFood->reduceBy($foodConsumption);
    }

    public function work()
    {
        $this->happinessLevel -= 5;
        $foodConsumption = 10;
        $this->foodReserves -= $foodConsumption;
    }

    public function feed(Food $food)
    {
        $foodConsumption = 10;
        if ($food->getName() === $this->favoriteFood) {

            $this->happinessLevel += 5;
            $this->foodReserves += $foodConsumption;
            $this->lastFed = Carbon::now();
            $food->reduceBy($foodConsumption);
        } else {
            $this->happinessLevel -= 5;
            $this->foodReserves -= $foodConsumption * 2;
            $food->reduceBy($foodConsumption * 2);
        }
    }

    public function pet()
    {
        $this->happinessLevel += 5;
    }
}
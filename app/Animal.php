<?php

namespace app;

use App\Food;
use Carbon\Carbon;

class Animal
{
    private string $name;
    private int $happinessLevel;
    private string $favoriteFood;
    private int $foodReserves = 100;
    private string $lastFed;
    const FOOD_CONSUMPTION = 10;


    public function __construct(
        string $name,
        int    $happinessLevel,
        string $favoriteFood
    )
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

    public function play(array $foods): void
    {
        $favoriteFood = Food::getFoodByFavorite($foods, $this->favoriteFood);
        $this->lastFed = Carbon::now()->addSeconds(5);
        $this->happinessLevel += 10;
        $this->foodReserves += self::FOOD_CONSUMPTION;
        $favoriteFood->reduceBy(self::FOOD_CONSUMPTION);
    }

    public function work(): void
    {
        $this->happinessLevel -= 5;
        $this->foodReserves -= self::FOOD_CONSUMPTION;
    }

    public function feed(Food $food): void
    {
        if ($food->getName() === $this->favoriteFood) {

            $this->happinessLevel += 5;
            $this->foodReserves += self::FOOD_CONSUMPTION;
            $this->lastFed = Carbon::now();
            $food->reduceBy(self::FOOD_CONSUMPTION);
        } else {
            $this->happinessLevel -= 5;
            $this->foodReserves -= self::FOOD_CONSUMPTION * 2;
            $food->reduceBy(self::FOOD_CONSUMPTION * 2);
        }
    }

    public function pet(): void
    {
        $this->happinessLevel += 5;
    }
}
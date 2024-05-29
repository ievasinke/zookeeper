<?php

namespace App;

use App\Animal;
use App\Food;

class Activity
{
    public function play(Animal $animal, array $foods)
    {
        $animal->play($foods);
    }

    public function work(Animal $animal)
    {
        $animal->work();
    }

    public function feed(Animal $animal, Food $food)
    {
        $animal->feed($food);
    }

    public function pet(Animal $animal)
    {
        $animal->pet();
    }
}
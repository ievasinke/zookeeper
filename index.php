<?php

require_once 'vendor/autoload.php';

use App\Activity;
use App\Animal;
use App\Food;
use Codedungeon\PHPCliColors\Color;

$animals = [
    new Animal('horse', 55, 'hay'),
    new Animal('rabbit', 75, 'carrot'),
    new Animal('panda', 60, 'bamboo'),
    new Animal('parrot', 80, 'seeds'),
];

$foods = [
    new Food('apple', 840),
    new Food('carrot', 220),
    new Food('cucumber', 420),
    new Food('seeds', 390),
    new Food('bamboo', 555),
    new Food('hay', 160),
];

function displayAnimals($animals)
{
    echo "Select an animal:\n";
    foreach ($animals as $index => $animal) {
        echo "[$index] ",
        Color::bold_purple(), "{$animal->getName()}'s ", Color::reset(),
        "favorite food is ",
        Color::green(), "{$animal->getFavoriteFood()}.\n", Color::reset(),
            "(Happiness: {$animal->getHappinessLevel()}, " .
            "Food Reserves: {$animal->getFoodReserves()})\n";
    }
}

function displayFoods($foods)
{
    echo "Select food to feed:\n";
    foreach ($foods as $index => $food) {
        echo "[$index] {$food->getName()} (Amount: {$food->getAmount()})\n";
    }
}

$activity = new Activity();

while (true) {
    displayAnimals($animals);
    $animalIndex = (int)readline("Enter the number of the animal you want to interact with: ");
    if (!isset($animals[$animalIndex])) {
        echo "Invalid selection. Please try again.\n";
        continue;
    }

    $selectedAnimal = $animals[$animalIndex];

    echo "You selected {$selectedAnimal->getName()}.\n";
    echo "What do you want to do?\n";
    echo "[1] Play\n";
    echo "[2] Work\n";
    echo "[3] Feed\n";
    echo "[4] Pet\n";
    echo "[0] Exit\n";

    $action = (int)readline("Enter the number of the action: ");

    if ($action === 0) {
        break;
    }

    switch ($action) {
        case 1:
            $activity->play($selectedAnimal);
            echo "You played with {$selectedAnimal->getName()}.\n";
            break;
        case 2:
            $activity->work($selectedAnimal);
            echo "You made {$selectedAnimal->getName()} work.\n";
            break;
        case 3:
            displayFoods($foods);
            $foodIndex = (int)readline("Enter the number of the food you want to give: ");
            if (!isset($foods[$foodIndex])) {
                echo "Invalid selection. Please try again.\n";
                break;
            }
            $selectedFood = $foods[$foodIndex];
            $activity->feed($selectedAnimal, $selectedFood);
            echo "You fed {$selectedAnimal->getName()} with {$selectedFood->getName()}.\n";
            break;
        case 4:
            $activity->pet($selectedAnimal);
            echo "You petted {$selectedAnimal->getName()}.\n";
            break;
        default:
            echo "Invalid action. Please try again.\n";
            break;
    }

    echo "Current status of {$selectedAnimal->getName()}: 
    Happiness: {$selectedAnimal->getHappinessLevel()}, 
    Food Reserves: {$selectedAnimal->getFoodReserves()}.\n";
}

echo Color::bold_cyan(), "Goodbye!\n";
<?php

require_once 'vendor/autoload.php';

use App\Activity;
use App\Animal;
use App\Food;
use Codedungeon\PHPCliColors\Color;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\ConsoleOutput;

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
    echo Color::bold_purple(), "Select an animal:\n", Color::reset();
    $outputAnimal = new ConsoleOutput();
    $tableAnimal = new Table($outputAnimal);
    $tableAnimal
        ->setHeaders(['Index', 'Animal', 'Favorite food', 'Happiness', 'Food reserves'])
        ->setRows(array_map(function ($index, $animal) {
            return [
                $index,
                $animal->getName(),
                $animal->getFavoriteFood(),
                $animal->getHappinessLevel(),
                $animal->getFoodReserves()
            ];
        }, array_keys($animals), $animals))
        ->render();
}

function displayFoods($foods)
{
    echo Color::bold_purple(), "Select food to feed:\n", Color::reset();
    $outputFood = new ConsoleOutput();
    $tableFood = new Table($outputFood);
    $tableFood
        ->setHeaders(['Index', 'Food', 'Amount'])
        ->setRows(array_map(function ($index, $food) {
            return [$index, $food->getName(), $food->getAmount()];
        }, array_keys($foods), $foods))
        ->render();
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
    $outputActivities = new ConsoleOutput();
    $tableActivities = new Table($outputActivities);
    $tableActivities
        ->setHeaders(['Index', 'Activity'])
        ->setRows([
            ['1', 'Play'],
            ['2', 'Work'],
            ['3', 'Feed'],
            ['4', 'Pet'],
            ['0', 'Exit'],
        ])
        ->render();

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
            echo Color::bold_cyan(), "You petted {$selectedAnimal->getName()}.\n", Color::reset();
            break;
        default:
            echo "Invalid action. Please try again.\n";
            break;
    }

    echo "Current status of {$selectedAnimal->getName()}: 
    Happiness: {$selectedAnimal->getHappinessLevel()}, 
    Food Reserves: {$selectedAnimal->getFoodReserves()}.\n";
}

echo Color::bold_cyan(), "Goodbye!\n", Color::reset();
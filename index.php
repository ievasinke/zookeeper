<?php

require_once 'vendor/autoload.php';

use App\Activity;
use App\Animal;
use App\Food;
use Codedungeon\PHPCliColors\Color;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\ConsoleOutput;

$animals = [
    new Animal('horse', 55, 'plant'),
    new Animal('rabbit', 75, 'vegetable'),
    new Animal('panda', 60, 'plant'),
    new Animal('parrot', 80, 'grain'),
];

$foods = [
    new Food('fruit', 840),
    new Food('vegetable', 220),
    new Food('grain', 390),
    new Food('plant', 555),
];

function displayAnimals($animals)
{
    echo Color::bold_purple(), "Select an animal:\n", Color::reset();
    $outputAnimal = new ConsoleOutput();
    $tableAnimal = new Table($outputAnimal);
    $tableAnimal
        ->setHeaders(['Index', 'Animal', 'Favorite food', 'Happiness', 'Food reserves', 'Last meal'])
        ->setRows(array_map(function ($index, $animal) {
            return [
                $index,
                $animal->getName(),
                $animal->getFavoriteFood(),
                $animal->getHappinessLevel(),
                $animal->getFoodReserves(),
                $animal->getLastFed()
            ];
        }, array_keys($animals), $animals))
        ->render();
}

function displayFoods($foods, $selectedAnimal)
{
    echo Color::bold_purple(), "Select food to feed {$selectedAnimal->getname()}:\n", Color::reset();
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
        echo Color::blue(), "Invalid selection. Please try again.\n", Color::reset();
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
            $activity->play($selectedAnimal, $foods);
            echo
            Color::bold_cyan(),
            "You played with {$selectedAnimal->getName()}.\n",
            Color::reset();
            break;
        case 2:
            $activity->work($selectedAnimal);
            echo
            Color::bold_cyan(),
            "You made {$selectedAnimal->getName()} work.\n",
            Color::reset();
            break;
        case 3:
            displayFoods($foods, $selectedAnimal);
            $foodIndex = (int)readline("Enter the number of the food you want to give: ");
            if (!isset($foods[$foodIndex])) {
                echo Color::blue(), "Invalid selection. Please try again.\n", Color::reset();
                break;
            }
            $selectedFood = $foods[$foodIndex];
            $activity->feed($selectedAnimal, $selectedFood);
            echo
            Color::bold_cyan(),
            "You fed {$selectedAnimal->getName()} with {$selectedFood->getName()}.\n",
            Color::reset();
            break;
        case 4:
            $activity->pet($selectedAnimal);
            echo
            Color::bold_cyan(),
            "You petted {$selectedAnimal->getName()}.\n",
            Color::reset();
            break;
        default:
            echo Color::blue(), "Invalid action. Please try again.\n", Color::reset();
            break;
    }

    echo "Current status of {$selectedAnimal->getName()}: 
    Happiness: {$selectedAnimal->getHappinessLevel()}, 
    Food Reserves: {$selectedAnimal->getFoodReserves()}.\n";
}

echo Color::bold_cyan(), "Goodbye!\n", Color::reset();
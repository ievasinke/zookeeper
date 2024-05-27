# Zookeeper

Zookeeper is a simple PHP application where you can interact with animals. Each animal has its own happiness level and a
preferred type of food. You can perform various actions with the animals, such as playing, working, feeding, and petting
them.

# Features

Play with Animals: Increases the animal's happiness but decreases its food reserves.
Work with Animals: Decreases both the animal's happiness and its food reserves.
Feed Animals: Increases the animal's happiness and food reserves if you give the correct food. If the wrong food is
given, the animal's happiness decreases and food reserves drop twice as much.
Pet Animals: Increases the animal's happiness.

# Getting Started

## Prerequisites

PHP installed on your machine.

Composer installed for dependency management.

### Usage

1. Select an animal to interact with from the list provided.

2. Choose an action:
    - Play with the animal
    - Make the animal work
    - Feed the animal
    - Pet the animal
3. Follow the prompts to see the changes in the animal's happiness and food reserves.

### Classes and Methods

#### Animal Class

Represents an animal with properties for name, happiness level, favorite food, and food reserves.

- `play():` Increases happiness, decreases food reserves.
- `work():` Decreases happiness, decreases food reserves.
- `feed(Food $food):` Adjusts happiness and food reserves based on the food given.
- `pet():` Increases happiness.

### Food Class

Represents food with properties for name and amount.

### Activity Class

Handles the various actions that can be performed on an animal.

- `play(Animal $animal):` Plays with the animal.
- `work(Animal $animal):` Makes the animal work.
- `feed(Animal $animal, Food $food):` Feeds the animal.
- `pet(Animal $animal):` Pets the animal.
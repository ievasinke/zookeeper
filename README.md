# Zookeeper

Zookeeper is a simple PHP application where you can interact with animals. Each animal has its own happiness level and a
preferred type of food. You can perform various actions with the animals, such as playing, working, feeding, and petting
them.

## Features

* Play with Animals: Increases the animal's happiness and food reserves.
* Work with Animals: Decreases both the animal's happiness and its food reserves.
* Feed Animals: Increases the animal's happiness and food reserves if you give the correct food. If the wrong food is
  given, the animal's happiness decreases and food reserves drop twice as much.
* Pet Animals: Increases the animal's happiness.

## Getting Started

### Prerequisites

PHP >= 7.4 installed on your machine.

Composer (https://getcomposer.org/) installed for managing dependencies

### Installation:

Clone the repository:
```git clone https://github.com/yourusername/zookeeper.git```

Navigate to the project directory:
```cd zookeeper```
Install dependencies using Composer:
```composer install```

### Usage

1. Run the application

```php index.php```

2. Select an animal to interact with from the list provided.

3. Choose an action:
    - Play with the animal
    - Make the animal work
    - Feed the animal
    - Pet the animal
4. Follow the prompts to see the changes in the animal's happiness and food reserves.

### Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

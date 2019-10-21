# Rock Paper Scissors

An example package used to demonstrate dependencies in [DGMD E-2 Web Programming for Beginners with PHP](https://hesweb.dev/e2).



## Installation
```php
composer require susanbuck/rock-paper-scissors
```


## Usage
```php
require __DIR__.'/vendor/autoload.php';

use RPS\Game;

$game = new Game();

# Eack invocation of the `play` method will play and track a new round of player (given move) vs. computer
$game->play('rock');
$game->play('paper');
$game->play('scissors');

# An array of the results for each round (player move, computer move, whether player won) can be accessed from the `getResults` method
var_dump($game->getResults());
```
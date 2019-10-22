# Rock Paper Scissors

An example package used to demonstrate dependencies in [DGMD E-2 Web Programming for Beginners with PHP](https://hesweb.dev/e2).



## Installation
```php
composer require susanbuck/rock-paper-scissors
```


## Usage
Basic example:

```php
require __DIR__.'/vendor/autoload.php';

use RPS\Game;

$game = new Game();

# Each invocation of the `play` method will play and track a new round of player (given move) vs. computer
$game->play('rock');
```

The Game class accepts three constructor parameters:

+ `bool persistResults`
    + Indicates whether or not results should be persisted to the SESSION
    + Defaults to `false`
+ `int $maxResults`
    + Indicates the max # of results to record in the SESSION
    + Defaults to `5`
+ `string $timezone`
    + Indicates what timezone each round should be recorded in
    + Defaults to `'America/New_York'`


## Methods

## `play(String $move): array`
Accepts a string of either `'rock'`, `'paper'`, or `'scissors'`.

Will halt the execution of the program if an invalid move is given.

Returns an array of results:
```
[
    'player' => player's move
    'computer' => computer's move
    'outcome' => outcome (won, lost, tie)
    'timestamp' => timestamp for when the round was played
];
```

## `getResults(): array`
Returns an array of the last x results, where x is `$maxResults`.

Returns null if `$persistResults` is set to `false`.


## `clearResults(): void`
Clears the session of results
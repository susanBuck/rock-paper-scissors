<?php

require $_SERVER['DOCUMENT_ROOT'].'/../src/Game.php';

$game = new RPS\Game(true);

$game->play('rock');

var_dump($game->getResults());

# Make sure we can start a new instance without warning about session being already started
$game2 = new RPS\Game(true);
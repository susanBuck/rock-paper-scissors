<?php

require $_SERVER['DOCUMENT_ROOT'].'/src/Game.php';

$game = new RPS\Game(true);

$game->play('rock');



var_dump($game->getResults());

<?php

namespace RPS;

class Game
{
    private $results;

    public function play(string $move)
    {
        if (!$this->validate($move)) {
            die('Invalid move: '.$move);
        }

        $computer = $this->getRandomMove();

        if ($computer == $move) {
            $outcome = 'tie';
        } elseif ($move == 'rock' and $computer == 'scissors' or $move == 'paper' and $computer == 'rock' or $move == 'scissors' and $computer == 'paper') {
            $outcome = 'win';
        } else {
            $outcome = 'loose';
        }

        $this->results[] = [
            'player' => $move,
            'computer' => $computer,
            'outcome' => $outcome
        ];

        return $outcome;
    }

    public function getResults()
    {
        return $this->results;
    }

    private function validate($move)
    {
        return in_array($move, ['rock', 'paper', 'scissors']);
    }

    private function getRandomMove()
    {
        return ['rock','paper','scissors'][rand(0, 1)];
    }
}

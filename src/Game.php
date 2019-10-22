<?php

namespace RPS;

class Game
{
    private $persistResults;
    private $maxResults;
    private $sessionKey = 'RPS_Results';


    /**
     * __construct
     *
     * @param bool $persistResults Whether or not results should be stored to the SESSION
     * @param int $maxResults The max number of results to be stored to the session
     * @param string $timezone The timezone to use for the results timestamp
     * @return void
     */
    public function __construct(bool $persistResults = false, int $maxResults = 5, string $timezone = 'America/New_York')
    {
        session_start();

        date_default_timezone_set($timezone);

        if ($persistResults) {
            $this->maxResults = $maxResults;
            $this->persistResults = $persistResults;
        } else {
            $this->clearResults();
        }
    }

    
    /**
     * play
     * Invoke with a move: rock, paper or scissors
     * Returns an array of results with player, computer, outcome, timestamp
     *
     * @param string $move
     * @return array
     */
    public function play(string $move)
    {
        if (!$this->validate($move)) {
            die('Invalid move: '.$move);
        }

        $computer = $this->getRandomMove();

        if ($computer == $move) {
            $outcome = 'tie';
        } elseif ($move == 'rock' and $computer == 'scissors' or $move == 'paper' and $computer == 'rock' or $move == 'scissors' and $computer == 'paper') {
            $outcome = 'won';
        } else {
            $outcome = 'lost';
        }

        $results = [
            'player' => $move,
            'computer' => $computer,
            'outcome' => $outcome,
            'timestamp' => date('F j, Y, g:i:s a')
        ];

        if ($this->persistResults) {
            $this->persistResults($results);
        }

        return $results;
    }

    /**
     * getResults
     * Retrieve the results from the session
     * @return void
     */
    public function getResults()
    {
        return $_SESSION[$this->sessionKey] ?? null;
    }


    /**
     * clearResults
     * Clear the results from the session
     *
     * @return void
     */
    public function clearResults()
    {
        $_SESSION[$this->sessionKey] = null;
    }


    /**
     * persistResults
     * Persist the results to the session
     *
     * @param array $results
     * @return void
     */
    private function persistResults(array $results)
    {
        # Get the existing session data
        $_SESSION[$this->sessionKey] = $this->getResults() ?? [];

        # Add these results to the start
        array_unshift($_SESSION[$this->sessionKey], $results);
        
        # Use array slice to make sure we're only includeing 0 up to maxResults
        $_SESSION[$this->sessionKey] = array_slice($_SESSION[$this->sessionKey], 0, $this->maxResults);
    }


    /**
     * validate
     * Confirm the given move is valid
     * @param string $move
     * @return void
     */
    private function validate(string $move)
    {
        return in_array($move, ['rock', 'paper', 'scissors']);
    }


    /**
     * getRandomMove
     * Get a random move of rock, paper, or scissors
     * @return void
     */
    private function getRandomMove()
    {
        return ['rock','paper','scissors'][rand(0, 1)];
    }
}

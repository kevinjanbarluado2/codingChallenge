<?php
require "../vendor/autoload.php";

class Entrant
{
    public $winningMoment;
    public $chance;

    public function getWinningMoment()
    {
        return $this->winningMoment;
    }

    public function getChance()
    {

        return $this->chance;
    }
}

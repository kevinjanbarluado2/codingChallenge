<?php

$entrant = new Entrant();


header('Content-type: application/json');


echo $entrant->getWinningMoment();

?>
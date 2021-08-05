<?php
require "../classes/entrant.class.php";

header('Content-type: application/json');
$entrant = new Entrant();

if (isset($_POST['set']) && is_numeric($_POST['set'])) {
    $winningMoment = $_POST['set'];
    $entrant->winningMoment = $winningMoment;
    echo json_encode(array('status' => 'success', 'message' => "Winning Moment is {$winningMoment}", 'winning-moment' => $winningMoment));
} elseif (isset($_POST['set']) && !is_numeric($_POST['set'])) {
    echo json_encode(array('status' => 'failed', 'message' => 'must be numeric'));
} else {
    echo json_encode(array('Entrant' => ($entrant->getWinningMoment()==null)?'You must set it first by using post in this url. For example: set=5':$entrant->getWinningMoment()));
}

<?php
require "../classes/mechanics.class.php";

header('Content-type: application/json');
$mechanics = new Mechanics();

if (isset($_POST['set']) && is_numeric($_POST['set'])) {
    $chance = $_POST['set'];
    $mechanics->chance = $chance;
    echo $mechanics->updateChance();
    
} elseif (isset($_POST['set']) && !is_numeric($_POST['set'])) {
    echo json_encode(array('status' => 'failed', 'message' => 'must be numeric'));
} else {
    echo $mechanics->getChance();
}

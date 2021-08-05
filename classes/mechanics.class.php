<?php

use Dotenv\Dotenv;

require "../vendor/autoload.php";

class Mechanics
{
    public $winningMoment;
    public $chance;
    private $conn;
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable('../');
        $dotenv->load();
        $this->conn = new mysqli($_ENV['host'], $_ENV['username'], $_ENV['password'], $_ENV['database']);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function updateWinningMoment()
    {

        $sql = "UPDATE mechanics_table SET value='{$this->winningMoment}' WHERE type='winning_moment'";
        if ($this->conn->query($sql) === TRUE) {
            $message = "updated winning moment successfully";
        } else {
            $message =  "Error updating record: " . $this->conn->error;
        }

        return json_encode(array('status' => 'success', 'message' => "{$message}", 'winning-moment' => $this->winningMoment));
    }

    public function updateChance()
    {

        $sql = "UPDATE mechanics_table SET value='{$this->chance}' WHERE type='chance'";
        if ($this->conn->query($sql) === TRUE) {
            $message = "updated chance successfully";
        } else {
            $message =  "Error updating record: " . $this->conn->error;
        }
        return json_encode(array('status' => 'success', 'message' => "{$message}", 'chance' => $this->chance));
    }

    public function getWinningMoment()
    {
        $sql = "SELECT value FROM mechanics_table WHERE type='winning_moment'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return json_encode(array('value'=>$row['value']));
            }
        } else {
            return json_encode(array('value'=>null));
        }
    }

    public function getChance()
    {
        $sql = "SELECT value FROM mechanics_table WHERE type='chance'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return json_encode(array('value'=>$row['value']));
            }
        } else {
            return json_encode(array('value'=>null));
        }
    }
}

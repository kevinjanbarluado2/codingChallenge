<?php

use Dotenv\Dotenv;

require "./vendor/autoload.php";


class Promotion
{

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable('./');
        $dotenv->load();
        $this->conn = new mysqli($_ENV['host'], $_ENV['username'], $_ENV['password'], $_ENV['database']);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function insert($arr)
    {
        $winningMoment = $this->getWinningMoment();
        $chance = $this->getChance();
        $name = $arr['client'];
        $email = $arr['email'];
        $mechanics = $arr['mechanics'];
        $myTime = time();
        $win=false;
        if ($myTime >= $winningMoment && $mechanics == "winning_moment") {
            $win = true;
        }

        $result = $this->conn->query("SELECT COUNT(*) FROM `entrant_table` WHERE mechanics='chance'");
        $row = $result->fetch_row();
        $winChance = $row[0] + 1;
        if ($mechanics == "chance" && $chance == $winChance) {
            $win = true;
        }

        $sql = "INSERT INTO entrant_table (name, email, mechanics,timestamp,win)
        VALUES ('$name', '$email', '$mechanics','$myTime','$win')";

        if ($this->conn->query($sql) === TRUE) {
            $message =  "Added Entrant successfully";
        } else {
            $message = "Error: " . $sql . "<br>" . $this->conn->error;
        }
        return json_encode(array('message' => $message,'win'=>$win));
    }

    public function getWinningMoment()
    {
        $sql = "SELECT value FROM mechanics_table WHERE type='winning_moment'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row['value'];
            }
        } else {
        }
    }

    public function getChance()
    {
        $sql = "SELECT value FROM mechanics_table WHERE type='chance'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row['value'];
            }
        } else {
        }
    }
}

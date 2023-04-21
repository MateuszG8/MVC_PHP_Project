<?php

class Baza
{
    private $mysqli; //uchwyt do BD

    public function __construct()
    {
        require_once "connect.php";
        $this->mysqli = new mysqli($host, $db_user, $db_password, $db_name);
        /* sprawdz połączenie */
        if ($this->mysqli->connect_error) {
            printf("Nie udało sie połączenie z serwerem: %s\n",
                $mysqli->connect_error);
            exit();
        }
        /* zmien kodowanie na utf8 */
        if ($this->mysqli->set_charset("utf8")) {
            //udało sie zmienić kodowanie
        }
    } //koniec funkcji konstruktora

    function __destruct()
    {
        $this->mysqli->close();
    }

    public function select($sql)
    {
        $selected = $this->mysqli->query($sql);
        return $selected;
    }
    public function insert($sql): bool
    {
        if( $this->mysqli->query($sql)) return true; else return false;
    }

    public function getMysqli()
    {
        return $this->mysqli;
    }
    public function delete($sql){
        if ($this->mysqli->query($sql) === TRUE) {
            echo "<h1>Record deleted successfully</h1>";
        } else {
            echo "<h1>Error deleting record: </h1>" .$this->mysqli->error;
        }
    }

}

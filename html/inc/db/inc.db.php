<?php
class Database
{
    const CONF_LOCATION = "../.database";

    private $_user;
    private $_passwd;
    private $_dsn;
    private $_pdo;

    public function __construct()
    {
        $content = file_get_contents(self::CONF_LOCATION);
        if (strlen($content) > 0) {
            // TODO fix trailing \n in gitlab variable
            $content = str_replace("\n", "", $content) ;
            $this->_user = explode("|", $content)[0];
            $this->_passwd = explode("|", $content)[1];
            if($_SERVER["HTTP_HOST"] == "localhost") {
                $this->_dsn = "mysql:host=openvet.tk;dbname=openvet";
            } else {
                $this->_dsn = "mysql:host=localhost;dbname=openvet";
            }

            $this->_pdo = new PDO($this->_dsn, $this->_user, $this->_passwd);
            echo "Connected to the database<br />";

            /*$stmt = $this->_pdo->query("SELECT * FROM vet");
            while ($row = $stmt->fetch()) {
                echo $row['name']." ".$row['subname']."<br />\n";
            }*/
        }
    }

    public function insertVet($name, $subname){

        $sql = "INSERT INTO vet (name, subname) VALUES ('$name','$subname')";

        $this->_pdo->query($sql);

        echo "Vet inserted<br />";

    }

    public function clearDatabase(){

        $sql = "DELETE FROM vet";

        $this->_pdo->query($sql);

        echo "Database cleared<br />";

    }

    public function displayAllVets(){

        $stmt = $this->_pdo->query("SELECT * FROM vet");
        while ($row = $stmt->fetch()) {
            echo $row['name']." ".$row['subname']."<br />\n";
        }

    }
}

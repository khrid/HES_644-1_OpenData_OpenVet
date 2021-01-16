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
            //echo "Connected to the database<br />";

            /*$stmt = $this->_pdo->query("SELECT * FROM vet");
            while ($row = $stmt->fetch()) {
                echo $row['name']." ".$row['subname']."<br />\n";
            }*/
        }
    }

    public function insertVet($name, $street, $city, $phone, $email){

        $sql = "INSERT INTO vet (name, street, city, phone, email) VALUES ('$name','$street','$city','$phone','$email')";

        $this->_pdo->query($sql);

        //echo "Vet inserted<br />";

    }

    public function clearDatabase(){

        $sql = "DELETE FROM vet";

        $this->_pdo->query($sql);

        //echo "Database cleared<br />";

    }

    public function displayAllVets(){
        $stmt = $this->_pdo->query("SELECT * FROM vet ORDER BY name");
        while ($row = $stmt->fetch()) {
            //echo $row['name']." ".$row['subname']."<br />\n";
            echo "<div class=\"col-lg-6 col-md-6 col-sm-12\">
                <div class=\"team-item\">
                    <div class=\"team-content\">
                        <h4>";
            echo $row['name'];
            echo "</h4>
                        <p>";
            echo $row['street'];
            echo "<br>";
            echo $row['city'];
            echo "</p>
                        <h6>Contact</h6>

                        <p>Tél : ";
            echo $row['phone'];
            echo "<br>
                            E-mail : ";
            echo $row['email'];
            echo "</p>
                    </div>
                </div>
            </div>";
        }
    }

    public function displayVetsCount(){
        $stmt = $this->_pdo->query("SELECT COUNT(*) AS vetscount FROM vet");
        echo "<strong>".$stmt->fetch()['vetscount']."</strong>";
    }

    public function displayCitiesCount(){
        $stmt = $this->_pdo->query("SELECT COUNT(DISTINCT city) as citiescount FROM vet");
        echo "<strong>".$stmt->fetch()['citiescount']."</strong>";
    }

}

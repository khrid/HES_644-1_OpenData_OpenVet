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
            $this->_user = explode("|", $content)[0];
            $this->_passwd = explode("|", $content)[1];
            if($_SERVER["HTTP_HOST"] == "localhost") {
                $this->_dsn = "mysql:host=openvet.tk;dbname=openvet";
            } else {
                $this->_dsn = "mysql:host=localhost;dbname=openvet";
            }
            $this->_pdo = new PDO($this->_dsn, $this->_user, $this->_passwd);
            $stmt = $this->_pdo->query("SELECT * FROM test_david");
            while ($row = $stmt->fetch()) {
                echo $row['name']."<br />\n";
            }
        }
    }
}
<?php
class Database
{
    const CONF_LOCATION = "../.database";

    private $_user;
    private $_passwd;
    private $_dsn = "mysql:host=openvet.tk;dbname=openvet";
    private $_pdo;

    public function __construct()
    {
        $content = file_get_contents(self::CONF_LOCATION);
        if (strlen($content) > 0) {
            $this->_user = explode("|", $content)[0];
            $this->_passwd = explode("|", $content)[1];
            $this->_pdo = new PDO($this->_dsn, $this->_user, $this->_passwd);
        }
    }
}
<?php
namespace Ilnaz;

class DataBase 
{
    const DB_HOST = "localhost";
    const DB_LOGIN = "root";
    const DB_PASSWORD = "rootsqladm";
    const DB_NAME = "purephp";

    protected $_db;

    public function __construct() 
    {
        $sdn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME;
        $this->_db = new \PDO($sdn, self::DB_LOGIN, self::DB_PASSWORD);
    }

    public function __destruct() 
    {
        unset($this->_db);
    }

    public function exec($sql) 
    {
        return $this->_db->exec($sql);
    }

    public function query($sql) 
    {
        return $this->_db->query($sql);
    }

    public function insertUser($login, $pass, $email) 
    {
        $sql = "INSERT INTO users(login, pass, email)"
                . "VALUES('$login', '$pass', '$email')";
        $res = $this->_db->exec($sql);
        if (!$res) {
            return false;
        }
        return true;
    }

    public function isTrueUser($login, $pass) 
    {
        $sql = "SELECT pass FROM users WHERE login='$login'";
        $stn = $this->_db->query($sql);

        $result = $stn->fetch(\PDO::FETCH_OBJ);
        if (!empty($result)) {
            $hash = (string) $result->pass;
            if (password_verify($pass, $hash)) {
                return true;
            }
        }
        return false;
    }

    public function sqlError() 
    {
        return $this->_db->errorInfo();
    }

}

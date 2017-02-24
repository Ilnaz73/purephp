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
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(login, pass, email)"
                . "VALUES(:login , :hash, :email)";
        $stm = $this->_db->prepare($sql);
        $stm->bindParam(':login', $login);
        $stm->bindParam(':hash', $hash);
        $stm->bindParam(':email', $email);
        $res = $stm->execute();

        if (!$res) {
            return false;
        }
        return true;
    }

    public function isTrueUser($login, $pass) 
    {
        $sql = "SELECT pass FROM users WHERE login=:login";
        $stm = $this->_db->prepare($sql);
        $stm->bindParam(':login', $login);
        $stm->execute();
        
        $result = $stm->fetch(\PDO::FETCH_OBJ);
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

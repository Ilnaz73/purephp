<?php
class DataBase{
    const DB_HOST = "localhost";
    const DB_LOGIN =  "root";
    const DB_PASSWORD = "rootsqladm";
    const DB_NAME = "purephp";
    protected $_db;
    function __construct() {
        $sdn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME;
        $this->_db = new PDO($sdn, self::DB_LOGIN, self::DB_PASSWORD);  
    }
    
    function __destruct() {
        unset($this->_db);
    }
           
    function exec($sql){
        return $this->_db->exec($sql);
    }
    
    function query($sql){
        return $this->_db->query($sql);
    }
    
    function insertUser($login, $pass, $email, $session){
        $sql = "INSERT INTO users(login, pass, email, session)"
                . "VALUES('$login', '$pass', '$email', '$session')";
        $res = $this->_db->exec($sql);
        if(!$res){
            return false;
        }
        return true;
    }

    function isTrueUser($login, $pass){
        $sql = "SELECT pass FROM users WHERE login='$login'";
        $stn = $this->_db->query($sql);

        $result = $stn->fetch(PDO::FETCH_OBJ);
        if($result->pass == $pass){
            return true;
        }
        else{
            return false;
        }
    }
    
    function sqlError(){
        return $this->_db->errorInfo();
    }
}

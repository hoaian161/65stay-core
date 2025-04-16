<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"])."/core/lib/init.php");

class Auth {
    private $user;
    private $username;
    private $password;
    
    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
        $this->user =  Database::call("SELECT * FROM `account` WHERE `username` = '".$this->username."'", 1);;
    }

    public function login() {
        if($this->user["ID"]) {
            if($this->user["password"] === $this->password) {
                return 1;
            }
        }

        return 0; 
    }

    public function register() {
        if (!Validate::alnum($this->username, 6, 30)) {
            return 0;
        } else if (!Validate::textSpecial($this->password, 8, 30)) {
            return -1;
        } else if ($this->user["ID"]) {
            return -2;
        }
        
        Database::call("INSERT INTO `account` (`username`, `password`) VALUES ('".$this->username."', '".$this->password."')");
        return 1;
    }   
}
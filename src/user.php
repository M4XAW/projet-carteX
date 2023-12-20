<?php
require_once 'config.php';

class userManager
{
public $id;
public $username;
public $email;
public $password;

public function __construct($id, $username, $email, $password) {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;

}
public function getId() {
    return $this->id;

}
public function getUsername() {
    return $this->username;

}
public function getEmail() {
    return $this->email;
}
public function getPassword() {
    return $this->password;
}


  

}
?>
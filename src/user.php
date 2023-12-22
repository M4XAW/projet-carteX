<?php
require_once 'config.php';

class userManager
{
public $id;
public $username;
public $email;
public $password;
// ici on a un constructeur qui prend en paramètre les attributs de la classe
public function __construct($id, $username, $email, $password) {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;

}
// ici on a des getters et des setters pour chaque attribut de la classe
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
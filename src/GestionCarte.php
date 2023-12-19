<?php

Class card {
    private $id;
    private $name;
    private $description;
    private $type;
    private $image;
    private $race;
    private $SetName;
    private $cardarchetype;
    private $setcode;
    private $setrarity;

public function __construct($id, $name, $description, $type, $image, $race, $setname, $cardarchetype, $setcode, $setrarity) {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->type = $type;
    $this->image = $image;
    $this->race = $race;
    $this->setname = $setname;
    $this->cardarchetype = $cardarchetype;
    $this->setcode = $setcode;
    $this->setrarity = $setrarity;

}

public function getId() {
    return $this->id;
}

public function getName() {
    return $this->name;
}

public function getDescription() {
    return $this->description;
}

public function getType() {
    return $this->type;
}

public function getImage() {
    return $this->image;
}

public function race(){
    return $this->race;
}

public function SetName(){
    return $this->setname;
}

public function cardarchetype(){
    return $this->cardarchetype;
}

public function setcode(){
    return $this->setcode;
}

public function setrarity(){
    return $this->setrarity;
}

public function setId($id) {
    $this->id = $id;
}



public function setDescription($description) {
    $this->description = $description;
}

public function setType($type) {
    $this->type = $type;
}

public function setImage($image) {
    $this->image = $image;
}

public function setrace($race){
    $this->race = $race;
}

public function setSetName($setname){
    $this->setname = $setname;
}

public function setcardarchetype($cardarchetype){
    $this->cardarchetype = $cardarchetype;
}

public function setsetcode($setcode){
    $this->setcode = $setcode;
}

public function setsetrarity($setrarity){
    $this->setrarity = $setrarity;
}




}

?>

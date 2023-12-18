<?php

class Cartes {
    private $id;
    private $name;
    private $description;
    private $type;
    private $image;
    private $race;
    private $setname;
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
    $this->cardarchetype = $cardarchetype;
}
}   
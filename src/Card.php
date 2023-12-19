<?php
class Card {
    public $name;
    public $type;
    public $frame_type;
    public $description;
    public $race;
    public $archetype;
    public $set_name;
    public $set_code;
    public $set_rarity;
    public $set_rarity_code;
    public $set_price;
    public $image_url;

    public function __construct(
        $name,
        $type,
        $frame_type,
        $Description,
        $Race,
        $Archetype,
        $Set_Name,
        $Set_Code,
        $Set_Rarity,
        $Set_Rarity_Code,
        $Set_Price,
        $Image_URL
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->frame_type = $frame_type;
        $this->description = $Description;
        $this->Race = $Race;
        $this->Archetype = $Archetype;
        $this->Set_Name = $Set_Name;
        $this->Set_Code = $Set_Code;
        $this->Set_Rarity = $Set_Rarity;
        $this->Set_Rarity_Code = $Set_Rarity_Code;
        $this->Set_Price = $Set_Price;
        $this->Image_URL = $Image_URL;
    }


    public function getname() {
        return $this->name;
    }

    public function gettype() {
        return $this->type;
    }

    public function getframe_type() {
        return $this->frame_type;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getRace() {
        return $this->race;
    }

    public function getArchetype() {
        return $this->archetype;
    }

    public function getSet_Name() {
        return $this->set_name;
    }

    public function getSet_Code() {
        return $this->set_code;
    }

    public function getSet_Rarity() {
        return $this->set_rarity;
    }

    public function getSet_Rarity_Code() {
        return $this->set_rarity_code;
    }

    public function getSet_Price() {
        return $this->set_price;
    }

    public function getImage_URL() {
        return $this->image_url;
    }


    public function setname($name) {
        $this->name = $name;
    }

    public function settype($type) {
        $this->type = $type;
    }

    public function setframe_type($frame_type) {
        $this->frame_type = $frame_type;
    }

    public function setDescription($Description) {
        $this->Description = $Description;
    }

    public function setRace($Race){
        $this->Race = $Race;
    }

    public function setArchetype($Archetype) {
        $this->Archetype = $Archetype;
    }

    public function setSet_Name($Set_Name) {
        $this->Set_Name = $Set_Name;
    }

    public function setSet_Code($Set_Code) {
        $this->Set_Code = $Set_Code;
    }

    public function setSet_Rarity($Set_Rarity) {
        $this->Set_Rarity = $Set_Rarity;
    }

    public function setSet_Rarity_Code($Set_Rarity_Code) {
        $this->Set_Rarity_Code = $Set_Rarity_Code;
    }

    public function setSet_Price($Set_Price) {
        $this->Set_Price = $Set_Price;
    }

    public function setImage_URL($Image_URL) {
        $this->Image_URL = $Image_URL;
    }


    
}


?>
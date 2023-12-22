<?php
class Card {
    private $name;
    private $type;
    private $frame_type;
    private $description;
    private $race;
    private $archetype;
    private $set_name;
    private $set_code;
    private $set_rarity;
    private $set_rarity_code;
    private $set_price;
    private $image_url;


    public function __construct(
        $name = "",
        $type = "",
        $frame_type = "",
        $Description = "",
        $Race = "",
        $Archetype = "",
        $Set_Name = "",
        $Set_Code = "",
        $Set_Rarity = "",
        $Set_Rarity_Code = "",
        $Set_Price = "",
        $Image_URL = ""
    ) {{
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
    
    public function setDescription($description) {
        $this->description = $description;
    }
    
    public function setRace($race) {
        $this->race = $race;
    }
    
    public function setArchetype($archetype) {
        $this->archetype = $archetype;
    }
    
    public function setSet_Name($set_name) {
        $this->set_name = $set_name;
    }
    
    public function setSet_Code($set_code) {
        $this->set_code = $set_code;
    }
    
    public function setSet_Rarity($set_rarity) {
        $this->set_rarity = $set_rarity;
    }
    
    public function setSet_Rarity_Code($set_rarity_code) {
        $this->set_rarity_code = $set_rarity_code;
    }
    
    public function setSet_Price($set_price) {
        $this->set_price = $set_price;
    }
    
    public function setImage_URL($image_url) {
        $this->image_url = $image_url;
    }


    
}


?>
<?php
class Card {
    public $Nom;
    public $Type;
    public $Frame_Type;
    public $Description;
    public $Race;
    public $Archetype;
    public $Set_Name;
    public $Set_Code;
    public $Set_Rarity;
    public $Set_Rarity_Code;
    public $Set_Price;
    public $Image_URL;

    public function __construct(
        $Nom,
        $Type,
        $Frame_Type,
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
        $this->Nom = $Nom;
        $this->Type = $Type;
        $this->Frame_Type = $Frame_Type;
        $this->Description = $Description;
        $this->Race = $Race;
        $this->Archetype = $Archetype;
        $this->Set_Name = $Set_Name;
        $this->Set_Code = $Set_Code;
        $this->Set_Rarity = $Set_Rarity;
        $this->Set_Rarity_Code = $Set_Rarity_Code;
        $this->Set_Price = $Set_Price;
        $this->Image_URL = $Image_URL;
    }


    public function getNom() {
        return $this->Nom;
    }

    public function getType() {
        return $this->Type;
    }

    public function getFrame_Type() {
        return $this->Frame_Type;
    }

    public function getDescription() {
        return $this->Description;
    }

    public function getRace() {
        return $this->Race;
    }

    public function getArchetype() {
        return $this->Archetype;
    }

    public function getSet_Name() {
        return $this->Set_Name;
    }

    public function getSet_Code() {
        return $this->Set_Code;
    }

    public function getSet_Rarity() {
        return $this->Set_Rarity;
    }

    public function getSet_Rarity_Code() {
        return $this->Set_Rarity_Code;
    }

    public function getSet_Price() {
        return $this->Set_Price;
    }

    public function getImage_URL() {
        return $this->Image_URL;
    }


    public function setNom($Nom) {
        $this->Nom = $Nom;
    }

    public function setType($Type) {
        $this->Type = $Type;
    }

    public function setFrame_Type($Frame_Type) {
        $this->Frame_Type = $Frame_Type;
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
<?php
class Card {
    public $ID_Carte;
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
        $ID_Carte,
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
        $this->ID_Carte = $ID_Carte;
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
}


?>
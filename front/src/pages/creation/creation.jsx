import React, { useState } from "react";
import axios from "axios"; // Assurez-vous d'installer axios avec `npm install axios`
import "./creation.scss";

export default function Creation() {
  const [card, setCard] = useState({
    name: "",
    type: "",
    description: "",
    race: "",
    archetype: "",
    set_name: "",
    set_rarity: "",
    set_price: "",
    image_url: "",
  });

  const handleChange = (event) => {
    const { name, value } = event.target;
    setCard((prevCard) => ({
      ...prevCard,
      [name]: value,
    }));
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    try {
      const response = await axios.post('http://localhost:8000/api/creation', card);
      console.log(response.data);
    } catch (error) {
      console.error("Erreur lors de la création de la carte", error);
    }
  };

  return (
    <div className="creationPage">
      <h2>Création</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          name="name"
          value={card.name}
          onChange={handleChange}
          placeholder="Nom de la carte"
        />
        <input
          type="text"
          name="type"
          value={card.type}
          onChange={handleChange}
          placeholder="Type de carte"
        />
        <input
          type="text"
          name="description"
          value={card.description}
          onChange={handleChange}
          placeholder="Description"
        />
        <input
          type="text"
          name="race"
          value={card.race}
          onChange={handleChange}
          placeholder="Race"
        />
        <input
          type="text"
          name="archetype"
          value={card.archetype}
          onChange={handleChange}
          placeholder="Archetype"
        />
        <input
          type="text"
          name="set_name"
          value={card.set_name}
          onChange={handleChange}
          placeholder="Nom set_name"
        />
        <input
          type="text"
          name="set_rarity"
          value={card.set_rarity}
          onChange={handleChange}
          placeholder="Nom set_rarity"
        />
        <input
          type="number"
          name="set_price"
          value={card.set_price}
          onChange={handleChange}
          placeholder="Nom set_price"
        />
        <input
          type="text"
          name="image_url"
          value={card.image_url}
          onChange={handleChange}
          placeholder="Nom image_url"
        />
        <button className="buttonValid" type="submit">Créer la Carte</button>
      </form>
    </div>
  );
}

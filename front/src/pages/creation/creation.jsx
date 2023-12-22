import React, { useState } from "react";
import axios from "axios"; // Assurez-vous d'installer axios avec `npm install axios`
import "./creation.scss";
import { useNavigate } from 'react-router-dom';

import { useAuth } from '../../auth/authContext';

export default function Creation() {
  const { token } = useAuth();
  const navigate = useNavigate();
  const [errorMessage, setErrorMessage] = useState("");

  const [card, setCard] = useState({ // Initialisation de l'état card
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

  const handleChange = (event) => { // Fonction de mise à jour de l'état card
    const { name, value } = event.target; // Récupération du nom et de la valeur de l'input
    setCard((prevCard) => ({ // Mise à jour de l'état card
      ...prevCard,
      [name]: value,
    }));
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    setErrorMessage(""); // Réinitialisez le message d'erreur
    try {
      const response = await axios.post('http://localhost:8000/api/card/create', card, {
        headers: {
          Authorization: `Bearer ${token}` // Ajout du token dans les headers
        }
      });
      if (response.data.success) {
        console.log(response.data);
        navigate('/cards/user');
      } else {
        // Gérer le cas où la carte existe déjà
        setErrorMessage(response.data.message);
      }
    } catch (error) {
      if (error.response && error.response.data) {
        setErrorMessage(error.response.data.message);
      } else {
        setErrorMessage("Une erreur inconnue s'est produite.");
      }
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
        <div className="imageUrlContainer">
          <input
            type="text"
            name="image_url"
            value={card.image_url}
            onChange={handleChange}
            placeholder="Nom image_url"
          />
          <a className="cardGenerate" href="https://www.cardmaker.net/yugioh/" target="_blank" rel="noreferrer">Générer l'image de la carte</a>
        </div>
        {errorMessage && <div className="incorrect">{errorMessage}</div>}
        <button className="buttonValid" type="submit">Créer la Carte</button>
      </form>
    </div>
  );
}

import React, { useEffect, useState } from 'react';
import axios from 'axios';
import './cards.scss';

export default function Cards() {
  const [cards, setCards] = useState([]); // État pour stocker les données des cartes

  useEffect(() => {
    displayCards();
  }, []);

  const displayCards = async () => {
    try {
      // Remplacez cette URL par celle de votre API Express
      const response = await axios.get('http://localhost:8000/api/cards');
      setCards(response.data); // Mise à jour de l'état avec les données des cartes
    } catch (error) {
      console.error('Erreur lors de la récupération des cartes:', error);
    }
  };

  return (
    <div className="cards">
      <h1>Cartes Yu-Gi-Oh!</h1>
      <div className="card-container">
        {cards.map((card) => (
          <div key={card.ID_Carte} className="card">
            <h3>{card.Nom}</h3>
            <p>Type : {card.Type}</p>
            <p>Description : {card.Description}</p>
            <p>Race : {card.Race}</p>
            <p>Archétype : {card.Archetype}</p>
            <p>Rareté : {card.Set_Rarity}</p>
            <p>Nom du Set : {card.Set_Name}</p>
            <p>Code du Set : {card.Set_Code}</p>
            <p>Prix du Set : {card.Set_Price} $</p>
            <img src={card.Image_URL} alt={card.Nom} />
          </div>
        ))}
      </div>
    </div>
  );
}

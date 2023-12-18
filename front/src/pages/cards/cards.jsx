import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import "./cards.scss";

export default function Cards() {
  const [cards, setCards] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    displayCards();
  }, []);

  const displayCards = async () => {
    try {
      const response = await axios.get("http://localhost:8000/api/cards");
      setCards(response.data);
    } catch (error) {
      console.error("Erreur lors de la récupération des cartes:", error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="cards">
      <h1>Cartes Yu-Gi-Oh!</h1>
      <div className="card-container">
        {loading ? (
          <p>Chargement...</p>
        ) : (
          cards.map((card) => (
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
              <Link to={`/cards/${card.ID_Carte}`}>
                <img src={card.Image_URL} alt={card.Nom} />
              </Link>
            </div>
          ))
        )}
      </div>
    </div>
  );
}

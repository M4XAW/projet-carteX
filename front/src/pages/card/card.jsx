import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";
import "./card.scss";

export default function Card() {
  const { id } = useParams();
  const [card, setCard] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const displayCard = async () => {
      try {
        const response = await axios.get(
          `http://localhost:8000/api/card/${id}`
        );
        setCard(response.data);
      } catch (error) {
        console.error("Erreur lors de la récupération de la carte:", error);
      } finally {
        setLoading(false);
      }
    };

    displayCard();
  }, [id]);

  if (loading) {
    return <p>Chargement...</p>;
  }

  return (
    <div className="cardPage">
      <img className="cardImage" src={card.image_url} alt={card.name} />
      <div className="cardInfos">
        <h2 className="cardTitle">{card.name}</h2>
        <p>Type : {card.type}</p>
        <p>Description : {card.description}</p>
        <p>Race : {card.race}</p>
        <p>Archétype : {card.archetype}</p>
        <p>Rareté : {card.set_rarity}</p>
        <p>Nom du Set : {card.set_name}</p>
        <p>Code du Set : {card.set_code}</p>
        <p>Prix du Set : {card.set_price} $</p>
      </div>
    </div>
  );
}

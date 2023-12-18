import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import "./home.scss";

export default function Home() {
  const [cards, setCards] = useState([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState("");

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

  const handleSearchChange = (e) => {
    setSearchTerm(e.target.value.toLowerCase());
  };

  const filteredCards = searchTerm
    ? cards.filter((card) =>
        card.name.toLowerCase().includes(searchTerm)
      )
    : cards;

  return (
    <div className="homePage">
      <div className="filter">
        <input
          type="search"
          name="search"
          className="search"
          value={searchTerm}
          onChange={handleSearchChange}
          placeholder="Rechercher"
        />
      </div>
      <div className="cardContainer">
        {loading ? (
          <p>Chargement...</p>
        ) : (
          filteredCards.map((card) => (
            <div key={card.id} className="card">
              <Link to={`/card/${card.id}`}>
                <img src={card.image_url} alt={card.name} />
              </Link>
            </div>
          ))
        )}

        {filteredCards.length === 0 && (
          <p className="noResult">
            Aucune carte trouvée. Veuillez essayer un autre terme de recherche.
          </p>
        )}
      </div>
    </div>
  );
}

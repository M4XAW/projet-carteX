import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import axios from "axios";
import "./home.scss";

export default function Home() {
  const [cards, setCards] = useState([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState("");
  const [sortType, setSortType] = useState("name");
  const [sortOrder, setSortOrder] = useState("asc");

  useEffect(() => {
    displayCards();
  }, [sortType, sortOrder]);

  const toggleSortOrder = (type) => {
    if (sortType === type) {
      setSortOrder(sortOrder === "asc" ? "desc" : "asc");
    } else {
      setSortType(type);
      setSortOrder("asc");
    }
  };

  const displayCards = async () => {
    try {
      const response = await axios.get("http://localhost:8000/api/cards");
      let sortedData = response.data;

      sortedData.sort((a, b) => {
        if (sortType === "name") {
          return sortOrder === "asc"
            ? a.name.localeCompare(b.name)
            : b.name.localeCompare(a.name);
        } else if (sortType === "price") {
          const priceA = parseFloat(a.set_price);
          const priceB = parseFloat(b.set_price);
          return sortOrder === "asc" ? priceA - priceB : priceB - priceA;
        } else if (sortType === "rarity") {
          return sortOrder === "asc"
            ? a.set_rarity.localeCompare(b.set_rarity)
            : b.set_rarity.localeCompare(a.set_rarity);
        }
        return 0;
      });

      setCards(sortedData);
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
        <button className="sortButton" onClick={() => toggleSortOrder("name")}>
          Nom {sortType === "name" ? `(${sortOrder === "asc" ? "A-Z" : "Z-A"})` : ""}
        </button>
        <button className="sortButton" onClick={() => toggleSortOrder("price")}>
          Prix {sortType === "price" ? `(${sortOrder === "asc" ? "croissant" : "décroissant"})` : ""}
        </button>
        <button className="sortButton" onClick={() => toggleSortOrder("rarity")}>
          Rareté {sortType === "rarity" ? `(${sortOrder === "asc" ? "asc" : "desc"})` : ""}
        </button>
      </div>
      <div className="cardContainer">
        {loading ? (
          <p>Chargement...</p>
        ) : filteredCards.length === 0 ? (
          <p className="noResult">
            Aucune carte trouvée. Veuillez essayer un autre terme de recherche.
          </p>
        ) : (
          filteredCards.map((card) => (
            <div key={card.id} className="card">
              <Link to={`/card/${card.id}`}>
                <img src={card.image_url} alt={card.name} />
              </Link>
              <h3>{card.name}</h3>
              <p>{card.set_rarity}</p>
              <p>{card.set_price} $</p>
            </div>
          ))
        )}
      </div>
    </div>
  );
}

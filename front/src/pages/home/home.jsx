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

  const toggleSortOrder = (type) => { // Fonction de tri des cartes
    if (sortType === type) { // Si le type de tri est le même que le type de tri actuel
      setSortOrder(sortOrder === "asc" ? "desc" : "asc"); // Si l'ordre de tri est ascendant, le passer en descendant et vice-versa
    } else {
      setSortType(type); // Sinon, changer le type de tri
      setSortOrder("asc"); // Et remettre l'ordre de tri à ascendant
    }
  };

  const displayCards = async () => { // Fonction de récupération des cartes
    try {
      const response = await axios.get("http://localhost:8000/api/cards");
      let sortedData = response.data;

      sortedData.sort((a, b) => {
        if (sortType === "name") { // Si le type de tri est le nom
          return sortOrder === "asc" // Si l'ordre de tri est ascendant, trier par ordre alphabétique croissant, sinon décroissant
            ? a.name.localeCompare(b.name) // Utilisez la fonction localeCompare pour comparer les chaînes de caractères
            : b.name.localeCompare(a.name); 
        } else if (sortType === "price") { // Si le type de tri est le prix
          const priceA = parseFloat(a.set_price); // Convertissez les prix en nombre flottant
          const priceB = parseFloat(b.set_price);
          return sortOrder === "asc" ? priceA - priceB : priceB - priceA; // Si l'ordre de tri est ascendant, trier par ordre croissant, sinon décroissant
        } else if (sortType === "rarity") { // Si le type de tri est la rareté
          return sortOrder === "asc" // Si l'ordre de tri est ascendant, trier par ordre alphabétique croissant, sinon décroissant
            ? a.set_rarity.localeCompare(b.set_rarity) // Utilisez la fonction localeCompare pour comparer les chaînes de caractères
            : b.set_rarity.localeCompare(a.set_rarity);
        }
        return 0;
      });

      setCards(sortedData); // Mettez à jour l'état des cartes avec les données triées
    } catch (error) {
      console.error("Erreur lors de la récupération des cartes:", error);
    } finally {
      setLoading(false); // Mettez à jour l'état de chargement
    }
  };

  const handleSearchChange = (e) => { // Fonction de mise à jour du terme de recherche
    setSearchTerm(e.target.value.toLowerCase()); // Mettez à jour l'état du terme de recherche et convertissez-le en minuscules
  };

  const filteredCards = searchTerm // Filtrer les cartes en fonction du terme de recherche
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
        <div className="buttonsContainer">
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

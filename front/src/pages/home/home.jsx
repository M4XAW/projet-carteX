import React from "react";
import "./home.scss";

export default function Home() {
  return (
    <main className="home">
      {/* <div className="filter">
        <input
          type="search"
          name="search"
          className="search"
          value={searchTerm}
          onChange={handleSearchChange}
          placeholder="Rechercher un jeu"
        />
      </div> */}
      <div className="products">
        {/* {loading ? (
          <p>Chargement...</p>
        ) : (
          products.map((article) => (
            <Product
              key={article.id}
              id={article.id}
              image={article.images}
              titre={article.titre}
              description={article.description}
              plateforme={article.plateforme}
              price={article.prix}
            />
          ))
        )} */}

        {/* {products.length === 0 && (
          <p className="noResult">Aucun jeu trouvé. Veuillez essayer un autre terme de recherche.</p>
        )} */}
      </div>
    </main>
  );
}

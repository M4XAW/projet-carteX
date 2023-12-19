import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import "./header.scss";

export default function Header() {
  // État pour suivre si l'utilisateur est connecté
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  // Gestionnaire de déconnexion
  const handleLogout = () => {
    localStorage.removeItem("token");
    setIsLoggedIn(false); // Mettre à jour l'état après la déconnexion
    // Ajoutez ici toute logique supplémentaire nécessaire après la déconnexion
  };

  // Effet pour synchroniser l'état avec le localStorage
  useEffect(() => {
    const token = localStorage.getItem("token");
    setIsLoggedIn(token !== null);
  }, []);

  return (
    <header>
      <Link className="logo" to="/">
        <img
          src="https://occ-0-2794-2219.1.nflxso.net/dnm/api/v6/LmEnxtiAuzezXBjYXPuDgfZ4zZQ/AAAABdpYalFU9SD9K6dNwu9SlKsNaQ3AIGWFrN_uDy6R7N3TS5DHIatIETtgeqwC0kM01zJyor2znGql_ixTWzVueA-GllV7Hn03ygETN_Nd7oZA.png?r=81f"
          alt="logo"
        />
      </Link>
      <nav>
        <ul>
          {!isLoggedIn ? (
            // Si l'utilisateur n'est pas connecté
            <>
              <li>
                <Link to="/login">Connexion</Link>
              </li>
              <li>
                <Link to="/signup">Inscription</Link>
              </li>
            </>
          ) : (
            // Si l'utilisateur est connecté
            <>
              <li>
                <Link to="/">Cartes</Link>
              </li>
              <li>
                <Link to="/dashboard">Dashboard</Link>
              </li>
              <li>
                <button className="disconnect" onClick={handleLogout}></button>
              </li>
            </>
          )}
        </ul>
      </nav>
    </header>
  );
}

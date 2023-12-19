import React from "react";
import { Link } from "react-router-dom";
import "./header.scss";
import { useAuth } from "../../auth/AuthContext"; // Importez le hook useAuth

export default function Header() {
  const { isLoggedIn, setIsLoggedIn } = useAuth(); // Utilisez le hook useAuth pour accéder à l'état isLoggedIn

  // Gestionnaire de déconnexion
  const handleLogout = () => {
    localStorage.removeItem("token");
    setIsLoggedIn(false); // Mettre à jour l'état après la déconnexion
    // Ajoutez ici toute logique supplémentaire nécessaire après la déconnexion
  };

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

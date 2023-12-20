import React from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../../auth/authContext"; // Importez le hook useAuth
import "./header.scss";

export default function Header() {
  const { isLoggedIn, user, logout } = useAuth(); // Utilisez le hook useAuth pour accéder à l'état et aux fonctions de connexion/déconnexion
  const navigate = useNavigate();
  
  const handleLogout = () => {
    logout();
    navigate("/login");
  };

  const isAdmin = user && (user.username === 'admin' || user.id === 1);

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
            <>
              <li>
                <Link to="/login">Connexion</Link>
              </li>
              <li>
                <Link to="/signup">Inscription</Link>
              </li>
            </>
          ) : (
            <>
              {user && user.username ? (
                <li>
                  <small className="username">Connecté en tant que {user.username}</small>
                </li>
              ) : (
                <li>
                  <span>Error</span>
                </li>
              )}
              <li>
                <Link to="/">Cartes</Link>
              </li>
              <li>
                <Link to="/cards">Mes cartes</Link>
              </li>
              {isAdmin && (
                <li>
                  <Link to="/admin">Admin</Link>
                </li>
              )}
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

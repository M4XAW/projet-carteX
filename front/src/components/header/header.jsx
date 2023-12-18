import React from "react";
import { Link } from "react-router-dom";
import "./header.scss";

export default function Header() {
  return (
    <header>
      <Link className="logo" to="/">
        <img src="https://occ-0-2794-2219.1.nflxso.net/dnm/api/v6/LmEnxtiAuzezXBjYXPuDgfZ4zZQ/AAAABdpYalFU9SD9K6dNwu9SlKsNaQ3AIGWFrN_uDy6R7N3TS5DHIatIETtgeqwC0kM01zJyor2znGql_ixTWzVueA-GllV7Hn03ygETN_Nd7oZA.png?r=81f" alt="logo" />
      </Link>
      <nav>
        <ul>
          {/* Si l'utilisateur n'est pas connecté */}
            <>
              <li>
                <Link to="/login">Connexion</Link>
              </li>
              <li>
                <Link to="/register">Inscription</Link>
              </li>
            </>
          {/* ) : ( */}
            {/* <>
              <li>
                <Link to="/">Cartes</Link>
              </li>
              <li>
                <Link to="/">Compte</Link>
              </li>
              <li>
                <Link
                  className="disconnect"
                  to="/"
                  onClick={handleLogout}
                ></Link>
              </li>
            </> */}
          {/* )} */}
        </ul>
      </nav>
    </header>
  );
}

import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import axios from "axios";
import "./login.scss";
import { useAuth } from "../../auth/authContext"; // Importez le hook useAuth

export default function Login() {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [showPassword, setShowPassword] = useState(false);
  const [incorrect, setIncorrect] = useState(null);
  const navigate = useNavigate();
  const { login } = useAuth(); // Utilisez le hook useAuth pour accéder à la méthode login

  const handleShowPassword = () => {
    setShowPassword(!showPassword);
  };

  const isValidEmail = (email) => {
    return /\S+@\S+\.\S+/.test(email);
  };

  const handleLogin = async (e) => {
    e.preventDefault();

    if (!isValidEmail(email)) {
      setIncorrect("Email ou mot de passe incorrect");
      return;
    }

    try {
      const response = await axios.post("http://localhost:8000/api/login", {
        email,
        password,
      });

      if (response.status === 200) {
        login(response.data.token); // Mettez à jour le statut de connexion avec le token
        navigate("/"); // Redirigez vers la page d'accueil
      } else {
        console.error("Erreur lors de la connexion");
      }
    } catch (err) {
      console.error("Erreur inattendue", err);
      setIncorrect("Email ou mot de passe incorrect"); // Affichez un message d'erreur
    } finally {
      setEmail("");
      setPassword("");
    }
  };

  return (
    <div className="login">
      <div className="containerLogin">
        <form onSubmit={handleLogin}>
          <h2 className="title">Connexion</h2>
          <p>Connectez-vous à votre compte</p>          
          <label htmlFor="email">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="Entrez votre email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            autoComplete="email"
            required
          />
          <label htmlFor="password">Mot de passe</label>
          <div className="containerPassword">
            <input
              type={showPassword ? "text" : "password"}
              name="password"
              id="password"
              placeholder="Entrez votre mot de passe"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              autoComplete="current-password"
              required
            />
            <button
              type="button"
              className="passwordVisibility"
              onClick={handleShowPassword}
            ></button>
          </div>
          <button type="submit">Se connecter</button>
          {incorrect && <div className="incorrect">{incorrect}</div>}
        </form>
        <div className="notHaveAccount">
          <p>Vous n'avez pas de compte ?</p>
          <Link to="/signup">Inscrivez-vous</Link>
        </div>
      </div>
    </div>
  );
}

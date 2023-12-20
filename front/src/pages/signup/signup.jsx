import React, { useState } from "react";
import { Link } from "react-router-dom";
import { useNavigate } from "react-router-dom";
import "./signup.scss";

import axios from "axios";

export default function Signup() {
  const [showPassword, setShowPassword] = useState(false);
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [incorrect, setIncorrect] = useState(null); // New state variable for error
  const navigate = useNavigate();

  const handleShowPassword = () => {
    setShowPassword(!showPassword);
  };

  const isValidEmail = (email) => {
    return /\S+@\S+\.\S+/.test(email);
  };

  const isValidPassword = (password) => {
    // Oblige l'utilisateur à entrer un mot de passe de 6 caractères minimum
    return password.length >= 6;
  };

  const handleSignup = async (e) => {
    e.preventDefault();

    if (!isValidEmail(email)) {
      setIncorrect("Email invalide");
      return;
    }

    if (!isValidPassword(password)) {
      setIncorrect("Le mot de passe doit contenir au moins 6 caractères");
      return;
    }

    try {
      const response = await axios.post("http://localhost:8000/api/signup", {
        username,
        email,
        password,
      });

      if (response.status >= 200 && response.status < 300) {
        console.log("Inscription réussie");
        navigate("/login");
      }
    } catch (error) {
      if (error.response) {
        switch (error.response.status) {
          case 409:
            setIncorrect("Un utilisateur avec cet email existe déjà");
            break;
          case 500:
            setIncorrect("Problème de serveur, veuillez réessayer plus tard");
            break;
          default:
            setIncorrect(
              error.response.data.message ||
                "Une erreur est survenue lors de l'inscription"
            );
        }
      } else {
        console.error("Erreur lors de la requête", error.message);
        setIncorrect(
          "Problème de réseau ou erreur inconnue lors de l'inscription"
        );
      }
    }
  };

  return (
    <div className="signup">
      <div className="containerSignup">
        <form onSubmit={handleSignup}>
          <h2 className="title">Inscription</h2>
          <p>Créez votre compte</p>
          <label htmlFor="username">Nom d'utilisateur</label>
          <input
            type="text"
            name="username"
            id="username"
            placeholder="Entrez votre nom d'utilisateur"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
            required
          />
          <label htmlFor="email">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="Entrez votre email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
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
              required
            />
            <button
              type="button"
              className="passwordVisibility"
              onClick={handleShowPassword}
            ></button>
          </div>
          <button type="submit">Continuer</button>
        </form>
        {incorrect && <div className="incorrect">{incorrect}</div>}{" "}
        {/* On affiche un message d'erreur si le login a échoué */}
        <div className="haveAccount">
          <p>Déjà un compte ?</p>
          <Link to="/login">Connectez-vous</Link>
        </div>
      </div>
    </div>
  );
}

  import React, { useState } from "react";
  import { Link } from "react-router-dom";
  import { useNavigate } from "react-router-dom";
  import "./login.scss";

  import axios from "axios";

  export default function Login() {
    const [showPassword, setShowPassword] = useState(false);
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [incorrect, setIncorrect] = useState(null); // New state variable for error
    const navigate = useNavigate();

    const handleShowPassword = () => {
      setShowPassword(!showPassword);
    };

    const handleLogin = async (e) => {
      e.preventDefault();
      try {
          const response = await axios.post("http://localhost:8000/api/login", {
              email: email,
              password: password,
          });
  
          if (response.status === 200) {
              const { token } = response.data; // Récupération du token de la réponse
  
              // Stocker le token dans le localStorage
              localStorage.setItem("token", token);
  
              console.log("Connexion réussie");
              navigate("/");
          } else {
              console.error("Erreur lors de la connexion");
          }
      } catch (err) {
          console.error("Erreur inattendue", err);
          setIncorrect("Email ou mot de passe incorrect.");
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
          </form>
          {incorrect && <div className="incorrect">{incorrect}</div>} {/* On affiche un message d'erreur si le login a échoué */}
          <div className="notHaveAccount">
            <p>Vous n'avez pas de compte ?</p>
            <Link to="/signup">Inscrivez-vous</Link>
          </div>
        </div>
      </div>
    );
  }

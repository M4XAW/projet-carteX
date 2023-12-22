import React, { createContext, useState, useContext, useEffect } from 'react';
import { jwtDecode } from 'jwt-decode'; // Importation de la fonction de décodage du token

const AuthContext = createContext(null); // Création du contexte d'authentification

export const useAuth = () => useContext(AuthContext); // Création d'un hook pour utiliser le contexte d'authentification

export const AuthProvider = ({ children }) => { // Création du composant fournisseur du contexte d'authentification
  const [token, setToken] = useState(localStorage.getItem('token') || null); // Initialisation de l'état token
  const [isLoggedIn, setIsLoggedIn] = useState(false); // Initialisation de l'état isLoggedIn
  const [user, setUser] = useState(null); // Initialisation de l'état user

  useEffect(() => {
    const storedToken = localStorage.getItem('token'); // Récupération du token dans le localStorage
    if (storedToken) { // Si le token existe
      const decodedToken = jwtDecode(storedToken); // Décodage du token
      const isTokenExpired = decodedToken.exp * 1000 < Date.now(); // Vérification de la date d'expiration du token

      if (isTokenExpired) {
        logout(); // Déconnexion si le token est expiré
      } else {
        setUser({ username: decodedToken.username }); // Mise à jour de l'état user
        setIsLoggedIn(true); // Mise à jour de l'état isLoggedIn (connecté)
        setToken(storedToken); // Mise à jour de l'état token
      }
    }
  }, []);

  const login = (newToken) => { // Fonction de connexion
    localStorage.setItem('token', newToken); // Enregistrement du token dans le localStorage
    const decodedToken = jwtDecode(newToken); // Décodage du token
    setUser({ username: decodedToken.username }); // Mise à jour de l'état user
    setIsLoggedIn(true); // Mise à jour de l'état isLoggedIn (connecté)
    setToken(newToken); // Mise à jour de l'état token
  };

  const logout = () => { // Fonction de déconnexion
    localStorage.removeItem('token'); // Suppression du token dans le localStorage
    setIsLoggedIn(false); // Réinitialisez l'état isLoggedIn (déconnecté)
    setUser(null); // Réinitialisez l'état user
    setToken(null); // Réinitialisez l'état token
  };

  return (
    <AuthContext.Provider value={{ isLoggedIn, token, user, login, logout }}> 
      {children}
    </AuthContext.Provider>
  );  
};



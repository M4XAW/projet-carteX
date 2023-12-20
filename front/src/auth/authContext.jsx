import React, { createContext, useState, useContext, useEffect } from 'react';
import { jwtDecode } from 'jwt-decode'; // Importez jwtDecode

const AuthContext = createContext(null);

export const useAuth = () => useContext(AuthContext);

export const AuthProvider = ({ children }) => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [user, setUser] = useState(null); // Ajoutez cet état pour les informations de l'utilisateur

  useEffect(() => {
    const token = localStorage.getItem('token');
    if (token) {
      const decodedToken = jwtDecode(token);
      setUser({ username: decodedToken.username }); // Définissez l'utilisateur avec le nom d'utilisateur décodé
      setIsLoggedIn(true);
    }
  }, []);

  const login = (token) => {
    localStorage.setItem('token', token);
    const decodedToken = jwtDecode(token);
    setUser({ username: decodedToken.username }); // Mettez à jour l'état de l'utilisateur
    setIsLoggedIn(true);
  };

  const logout = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('userInfo'); // Assurez-vous de supprimer également les informations de l'utilisateur
    setIsLoggedIn(false);
    setUser(null); // Réinitialisez l'état de l'utilisateur
  };

  return (
    <AuthContext.Provider value={{ isLoggedIn, user, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
};

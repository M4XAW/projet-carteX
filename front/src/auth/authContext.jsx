import React, { createContext, useState, useContext, useEffect } from 'react';
import { jwtDecode } from 'jwt-decode';

const AuthContext = createContext(null);

export const useAuth = () => useContext(AuthContext);

export const AuthProvider = ({ children }) => {
  const [token, setToken] = useState(localStorage.getItem('token') || null);
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [user, setUser] = useState(null);

  useEffect(() => {
    const storedToken = localStorage.getItem('token');
    if (storedToken) {
      const decodedToken = jwtDecode(storedToken);
      setUser({ username: decodedToken.username });
      setIsLoggedIn(true);
      setToken(storedToken); // Mise à jour de l'état token
    }
  }, []);

  const login = (newToken) => {
    localStorage.setItem('token', newToken);
    const decodedToken = jwtDecode(newToken);
    setUser({ username: decodedToken.username });
    setIsLoggedIn(true);
    setToken(newToken); // Mise à jour de l'état token
  };

  const logout = () => {
    localStorage.removeItem('token');
    setIsLoggedIn(false);
    setUser(null);
    setToken(null); // Réinitialisez l'état token
  };

  return (
    <AuthContext.Provider value={{ isLoggedIn, token, user, login, logout }}>
      {children}
    </AuthContext.Provider>
  );  
};

import "./App.scss";
import { Routes, Route } from "react-router-dom";

import Header from "./components/header/header";
import Footer from "./components/footer/footer";
import Home from "./pages/home/home";
import Login from "./pages/login/login";
import Signup from "./pages/signup/signup";
import Card from "./pages/card/card";
import Creation from "./pages/creation/creation";
import Cards from "./pages/cards/cards";
import Admin from "./pages/admin/admin";
import Error from "./pages/error/error";

import { useAuth } from "./auth/authContext";

function App() {
  const { isLoggedIn } = useAuth();

  return (
    <div className="App">
        <Header />
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/login" element={<Login />} />
          <Route path="/signup" element={<Signup />} />
          {isLoggedIn && ( // Affichez les routes protégées uniquement si l'utilisateur est authentifié
            <>
              <Route path="/card/:id" element={<Card />} />
              <Route path="/cards/user" element={<Cards />} />
              <Route path="/creation" element={<Creation />} />
              <Route path="/admin" element={<Admin />} />
            </>
          )}
          <Route path="*" element={<Error />} />
        </Routes>
        <Footer />
    </div>
  );
}

export default App;

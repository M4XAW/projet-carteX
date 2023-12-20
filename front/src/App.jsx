import "./App.scss";
import { Routes, Route } from "react-router-dom";
import { AuthProvider } from "./auth/authContext";

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

function App() {
  return (
    <div className="App">
      <AuthProvider>
        <Header />
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/login" element={<Login />} />
          <Route path="/signup" element={<Signup />} />
          <Route path="/card/:id" element={<Card />} />
          <Route path="/cards" element={<Cards />} />
          <Route path="/creation" element={<Creation />} />
          <Route path="/admin" element={<Admin />} />
          <Route path="*" element={<Error />} />
        </Routes>
        <Footer />
      </AuthProvider>
    </div>
  );
}

export default App;

import './App.scss';
import { Routes, Route } from 'react-router-dom';

import Header from './components/header/header';
import Login from './pages/login/login';
import Register from './pages/register/register';
import Error from './pages/error/error';
import Footer from './components/footer/footer';
import Cards from './pages/cards/cards';

function App() {
  return (
    <div className="App">
      <Header />
      <Routes>
        <Route path="/" element={<Cards />} />
        <Route path="/cards:id" element={<Cards />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="*" element={<Error />} />
      </Routes>
      <Footer />
    </div>
  );
}

export default App;

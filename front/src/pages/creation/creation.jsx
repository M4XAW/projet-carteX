import React, { useState } from 'react';
import "./creation.scss";

export default function Creation() {
  const [card, setCard] = useState({
    name: '',
    type: '',
    description: '',
  });

  const handleChange = (event) => {
    const { name, value } = event.target;
    setCard(prevCard => ({
      ...prevCard,
      [name]: value
    }));
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    console.log(card);
  };

  return (
    <div className="creationPage">
      <h2>Création</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          name="name"
          value={card.name}
          onChange={handleChange}
          placeholder="Nom de la carte"
        />
        <input
          type="text"
          name="type"
          value={card.type}
          onChange={handleChange}
          placeholder="Type de carte"
        />
        <textarea
          name="description"
          value={card.description}
          onChange={handleChange}
          placeholder="Description"
        />
        <button type="submit">Créer la Carte</button>
      </form>
    </div>
  );
}

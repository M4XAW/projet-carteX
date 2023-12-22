import React, { useState } from "react";
import { useParams } from "react-router-dom";
import axios from "axios"; // Assurez-vous d'installer axios avec `npm install axios`
import "./edit.scss";
import { useNavigate } from 'react-router-dom';

import { useAuth } from '../../auth/authContext';

export default function Edit() {
    const { token } = useAuth();
    const { id } = useParams(); // Récupérez l'id de la carte dans l'URL
    const navigate = useNavigate(); // Initialisez le hook navigate

    const [card, setCard] = useState({ // Initialisez l'état de la carte avec les valeurs de la carte
        name: "",
        type: "",
        description: "",
        race: "",
        archetype: "",
        set_name: "",
        set_rarity: "",
        set_price: "",
        image_url: "",
    });

    const handleChange = (event) => { // Fonction de mise à jour de l'état de la carte
        const { name, value } = event.target;
        setCard((prevCard) => ({
            ...prevCard,
            [name]: value,
        }));
    };

    const handleSubmit = async (event) => { // Fonction de soumission du formulaire
        event.preventDefault();
        try {
            const response = await axios.put(`http://localhost:8000/api/card/update/${id}`, card, { // Requête PUT pour mettre à jour la carte
                headers: {
                    Authorization: `Bearer ${token}` // Ajout du token dans les headers
                }
            });

            console.log(response.data);
            navigate('/cards/user'); // Redirection vers la page des cartes de l'utilisateur
        } catch (error) {
            console.error("Erreur lors de la création de la carte", error);
        }
    };

    return (
        <div className="editPage">
          <h2>Modification</h2>
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
            <input
              type="text"
              name="description"
              value={card.description}
              onChange={handleChange}
              placeholder="Description"
            />
            <input
              type="text"
              name="race"
              value={card.race}
              onChange={handleChange}
              placeholder="Race"
            />
            <input
              type="text"
              name="archetype"
              value={card.archetype}
              onChange={handleChange}
              placeholder="Archetype"
            />
            <input
              type="text"
              name="set_name"
              value={card.set_name}
              onChange={handleChange}
              placeholder="Nom set_name"
            />
            <input
              type="text"
              name="set_rarity"
              value={card.set_rarity}
              onChange={handleChange}
              placeholder="Nom set_rarity"
            />
            <input
              type="number"
              name="set_price"
              value={card.set_price}
              onChange={handleChange}
              placeholder="Nom set_price"
            />
            <input
            type="text"
            name="image_url"
            value={card.image_url}
            onChange={handleChange}
            placeholder="Nom image_url"
            />
            <button className="buttonValid" type="submit">Modifier</button>
          </form>
        </div>
    );
}
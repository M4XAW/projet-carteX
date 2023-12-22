import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import { useAuth } from '../../auth/authContext';
import './cards.scss';

export default function Cards() {
    const [cards, setCards] = useState([]);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState(null);
    const { token } = useAuth();

    useEffect(() => {
        const fetchCards = async () => {
            try {
                const response = await axios.get('http://localhost:8000/api/cards/user', { // Requête GET pour récupérer les cartes de l'utilisateur
                    headers: {
                        Authorization: `Bearer ${token}` // Ajout du token dans les headers
                    }
                });
                setCards(response.data); // Mise à jour de l'état cards
            } catch (error) {
                console.error('Erreur lors de la récupération des cartes de l\'utilisateur:', error);
                setError(error);
            } finally {
                setIsLoading(false); // Fin du chargement
            }
        };

        fetchCards(); // Appel de la fonction fetchCards
    }, [token]);

    const handleDelete = async (cardId) => { // Fonction de suppression d'une carte
        try {
            const response = await axios.delete(`http://localhost:8000/api/card/delete/${cardId}`); // Requête DELETE pour supprimer une carte
    
            if (response.status === 204) { // Si la carte a bien été supprimée
                console.log('Carte supprimée avec succès');
    
                // Mettre à jour l'état pour enlever la carte supprimée
                setCards(cards.filter(card => card.id !== cardId));
            } else {
                console.error('Erreur lors de la suppression de la carte');
            }
        } catch (error) {
            console.error('Erreur lors de la suppression de la carte: ', error.message);
        }
    };

    if (isLoading) { 
        return <p>Chargement...</p>;
    }

    if (error) {
        return <p>Une erreur est survenue. Veuillez réessayer plus tard.</p>;
    }

    return (
        <div className="cardsPage">
            <div className="top">
                <h2>Mes cartes</h2>
                <Link to="/creation">Créer une carte</Link>
            </div>
            <div className="cards">
                {cards.length > 0 ? ( // Si l'utilisateur a des cartes
                    cards.map(card => (
                        <div key={card.id} className="card">
                                <img src={card.image_url} alt={card.name} />
                            <div className="cardInfos">
                                <p>{card.name}</p>
                                <p>{card.type}</p>
                            </div>

                            <div className="cardsButtons">
                                <Link className='view' to={`/card/${card.id}`}>Voir</Link>
                                <Link className='edit' to={`/edit/${card.id}`}>Modifier</Link>
                                <button className="delete" onClick={() => handleDelete(card.id)}>Supprimer</button>
                            </div>
                        </div>
                    ))
                ) : (
                    <p className="empty">Vous n'avez pas encore de cartes</p>
                )}
            </div>
        </div>
    );
}

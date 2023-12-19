const axios = require('axios');
const mariadb = require('mariadb');

// Remplacez ces informations par vos propres informations de connexion
const dbConfig = {
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'cartex',
    connectionLimit: 5
};

const url = 'https://db.ygoprodeck.com/api/v7/cardinfo.php'; // Remplacez par l'URL de votre API

const pool = mariadb.createPool(dbConfig);

async function main() {
    let conn;
    try {
        const response = await axios.get(url);
        const cards = response.data.data.slice(0, 300); // Limitez le nombre de cartes si nécessaire

        conn = await pool.getConnection();
        for (const card of cards) {
            const cardSet = card.card_sets ? card.card_sets[0] : {}; // Assumer le premier set si disponible
            const cardImage = card.card_images ? card.card_images[0] : {};
            const cardPrice = card.card_prices ? card.card_prices[0] : {};

            const query = `INSERT INTO Cartes (ID_Carte, Nom, Type, Frame_Type, Description, Race, Archetype, YGOPRODeck_URL, Set_Name, Set_Code, Set_Rarity, Set_Rarity_Code, Set_Price, Image_URL, Image_URL_Small, Image_URL_Cropped, Cardmarket_Price, TCGPlayer_Price, eBay_Price, Amazon_Price, CoolStuffInc_Price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`;
            const queryParams = [
                card.id, card.name, card.type, card.frameType, card.desc, card.race, card.archetype, card.ygoprodeck_url,
                cardSet.set_name, cardSet.set_code, cardSet.set_rarity, cardSet.set_rarity_code, cardSet.set_price,
                cardImage.image_url, cardImage.image_url_small, cardImage.image_url_cropped,
                cardPrice.cardmarket_price, cardPrice.tcgplayer_price, cardPrice.ebay_price, cardPrice.amazon_price, cardPrice.coolstuffinc_price
            ];

            await conn.query(query, queryParams);
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données de l\'API ou de l\'interaction avec la base de données:', error);
    } finally {
        if (conn) conn.release(); // libère la connexion
    }
}

main();
const axios = require('axios');

async function fetchSetRarity() {
    try {
        const url = 'https://db.ygoprodeck.com/api/v7/cardinfo.php';
        const response = await axios.get(url);

        if (response.data && response.data.data) {
            const setRarities = new Set();
            response.data.data.forEach(card => {
                if (card.card_sets) {
                    card.card_sets.forEach(set => {
                        if (set.set_rarity) {
                            setRarities.add(set.set_rarity);
                        }
                    });
                }
            });

            console.log("Set Rarities:", Array.from(setRarities));
        }
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

fetchSetRarity();


export function display_spectacles(spectacles) {
    let grille_spectacles = document.getElementById("grille_articles");
    grille_spectacles.innerHTML = "";
    spectacles.then(data => {
        data.forEach(element => {
            grille_spectacles.innerHTML += `
                <article>
                    <img src="${element.spectacle.image}" alt="">
                    <div>
                        <p>${element.spectacle.titre}</p>
                        <p>${element.spectacle.date}</p>
                        <p>${element.spectacle.horaire}</p>
                        <button id="${element.spectacle.id}" class="choisir-button">Choisir</button>                   
                    </div>
                </article>
            `
        })
        // Ajoutez des gestionnaires d'événements pour les boutons "Choisir" de la soirée
        const choisirButtons = document.querySelectorAll('.choisir-button');
        choisirButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Récupérez l'ID de la soirée associée au bouton
                const soireeId = button.id;
                chargerNouveauContenu('page_corps_soirees', soireeId);
            });
        });
    });
}

export function display_soiree(data_soiree) {
    let soiree = document.getElementById("grille_articles");
    soiree.innerHTML = "";
    data_soiree.then(data => {
        soiree.innerHTML += `
            <p>${data.soiree.id}</p>
        `
    });
    /*
    data_soiree.then(data => {
        data.forEach(element => {
            soiree.innerHTML += `
                <p>${element.soiree.id}</p>
                <p>${element.soiree.theme}</p>
            `
        })
    });

     */
}
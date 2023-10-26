
export function display_spectacles(spectacles) {
    let grille_spectacles = document.getElementById("grille_articles");
    grille_spectacles.innerHTML = "";
    spectacles.then(data => {
        data.forEach(element => {
            grille_spectacles.innerHTML += `
                <article>
                    <img src="">
                    <div>
                        <p>${element.spectacle.titre}</p>
                        <p>${element.spectacle.date}</p>
                        <p>${element.spectacle.horaire}</p>
                        <button>Choisir</button>
                    </div>
                </article>
            `

        })
    });
}
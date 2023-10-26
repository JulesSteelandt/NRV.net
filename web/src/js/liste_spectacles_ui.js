
export function display_spectacles(spectacles) {
    let grille_spectacles = document.getElementById("grille_articles");
    grille_spectacles.innerHTML = "";
    spectacles.then(data => {
        data.forEach(element => {
            grille_spectacles.innerHTML += `
                <p>test</p>
            `
        })
    });
}

    function chargerNouveauContenu(x,y,id) {

    document.getElementById('section_container').remove();

    fetch(x+'.html')
    .then(response => response.text())
    .then(newContent => {

    let newSection = document.createElement('div');
    newSection.setAttribute('id',y);
    document.getElementById('sec').appendChild(newSection);
    newSection.innerHTML = newContent;

        fetch('http://localhost:32107/soiree/'+id)
            .then(function(promise){
                promise.json()
                    .then(json => {
                        console.log(json);
                        document.getElementById("titre").innerHTML = `${json.data.soiree.nom}`;
                        document.getElementById("theme").innerHTML = `${json.data.soiree.theme}`;
                        document.getElementById("date").innerHTML = `${json.data.soiree.date}`;
                        document.getElementById("horaire").innerHTML = `${json.data.soiree.horaireDebut}`;
                        document.getElementById("lieu").innerHTML = `${json.data.soiree.Lieu.nom}`;

                        document.getElementById("plein").innerHTML = `${json.data.soiree.tarifNormal}`;
                        document.getElementById("reduit").innerHTML = `${json.data.soiree.tarifReduit}`;

                        let nb = json.data.spectacle.count;
                        document.getElementById("articleSpectacle").innerHTML ="";
                        for (let i=0;i<nb;i++) {
                            document.getElementById("articleSpectacle").innerHTML += `
                                <article class="spectacle">
                                <img src="../images/imgSpectacle.png" alt="imgSpec">
                                   <div id="infoSpectacle">
                                 <h3 id="titreSpectacle">${json.data.spectacle[i].titre}</h3>
                                 <h3 id="styleSpectacle">${json.data.spectacle[i].style}</h3>
                                </div>
                                   <div id="description">
                                 <h4>Description</h4>
                                 <p>${json.data.spectacle[i].description}</p>
                                </div>
                                <video></video>
                                </article>
                                `;
                        }
                    });
            });
    });
}
   /* <article>
        <img src="${element.spectacle.image}" alt="">
            <div id="infoSpectacle">
                <h3>${element.spectacle.titre}</h3>
                <h3>${element.spectacle.date}</h3>
                <h3>${element.spectacle.horaire}</h3>
            </div>
            <div>
                <div id="description">
                    <h4>Description</h4>
                    <p>${element.spectacle.description}</p>
                </div>
    </article>
    `
    });

    });*/


   // let boutonRemplacerContenu = document.getElementById('remplacerContenu');
   // boutonRemplacerContenu.addEventListener('click', chargerNouveauContenu("test"));




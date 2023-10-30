
    function chargerNouveauContenu(x,y) {

    document.getElementById('section_container').remove();

    fetch(x+'.html')
    .then(response => response.text())
    .then(newContent => {

    let newSection = document.createElement('div');
    newSection.setAttribute('id',y);
    document.getElementById('sec').appendChild(newSection);
    newSection.innerHTML = newContent;


});
}
   // let boutonRemplacerContenu = document.getElementById('remplacerContenu');
   // boutonRemplacerContenu.addEventListener('click', chargerNouveauContenu("test"));




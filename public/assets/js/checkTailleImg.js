// select img
// condition
// taille inf ok
// taille sup message + disabled envoyer
// eventListener sur input ?

const file = document.querySelector("#file");
const submit=document.querySelector('#submit');

document.addEventListener('click', showMeTheTruth);

function showMeTheTruth(event){
    if(event.target==submit){
        // je rentre
        console.log('yep');
        event.preventDefault();
        
    }

    for (const filer of file.files) {
        console.log(filer.name);
        console.log(filer.size);
    }
}

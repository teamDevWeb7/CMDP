const file = document.querySelector("#file");
let div=document.querySelector('#photoMod');

document.addEventListener('submit', showMeTheTruth);

function showMeTheTruth(event){
    for (const filer of file.files) {
        console.log(filer.name);
        console.log(filer.size);
        if(filer.size>2047674){
            div.classList.remove('cache');
            let divP=div.firstChild;
            divP.innerHTML=`La taille de ${filer.name} est supérieure à 2MO`;
            event.preventDefault();
        }
    }
}

function shutDown(){
    div.classList.add('cache');
}

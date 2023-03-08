// section emplacement réponse à droite
let endroit=document.getElementById('rep');

// div qui contient quest 
let div=document.querySelectorAll('div');

// tableau ttes img, commence ds le header
let img=document.querySelectorAll('img');

let quest=document.getElementById('quest');

// inchallah j aimerais que y ait la classe scroll quand depasse les 70vh
// if(quest.style.height>"70vh"){
//     alert('coucou');
//     quest.setAttribute("class", "scroll");
// }

// fonctions showNhide pour afficher et cacher les questions inside les thèmes
function showNhide(){
    if(div[2].getAttribute('class')==="hide"){
        div[2].setAttribute('class', 'show');
        img[3].style.rotate="45deg";
    }
    else{
        div[2].setAttribute("class", "hide");
        img[3].style.rotate="0deg";
    }
}

function showNhide2(){
    if(div[3].getAttribute('class')==="hide"){
        div[3].setAttribute('class', 'show');
        img[4].style.rotate="45deg";
    }
    else{
        div[3].setAttribute("class", "hide");
        img[4].style.rotate="0deg";
    }
}

function showNhide3(){
    if(div[4].getAttribute('class')==="hide"){
        div[4].setAttribute('class', 'show');
        img[5].style.rotate="45deg";
        // refermer les autres
        div[2].setAttribute("class", "hide");
        img[3].style.rotate="0deg";
        div[3].setAttribute("class", "hide");
        img[4].style.rotate="0deg";
    }
    else{
        div[4].setAttribute("class", "hide");
        img[5].style.rotate="0deg";
    }
}


// fonctions rep pour injecter le texte de la réponse
function rep(){
    endroit.innerHTML='lorem20';
}
function rep1(){
    endroit.innerHTML='sdefghjik'
}



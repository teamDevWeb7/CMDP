// utilisé dans la page devis pour changer les questions

let para1=document.getElementById('p1');
let para2=document.getElementById('p2');

let btnPreced=document.querySelectorAll('button');
let div=document.querySelectorAll('div');

// suivant
function swip(){
    // si je suis sur page 1 et que je vais sur page 2

        para1.removeAttribute('class');
        para1.style.left='-100vw';

        para2.removeAttribute('class');
        para2.setAttribute('class', 'left0');
        // para2.style.left='0';

        div[3].removeAttribute('class');
        div[3].setAttribute('class', 'pts1');
        div[4].setAttribute('class', 'pts2 bigger');
}

// retour en arriere
function swi(){
    // si je suis sur page 2 et que je retourne sur page 1
    if(para2.getAttribute("class")==="left0"){
        para1.style.left="0";
        para2.setAttribute("class", "left");

        div[4].removeAttribute('class');
        div[4].setAttribute('class', 'pts2');
        div[3].setAttribute('class', 'pts1 bigger');
    }
}

// fonction suivant de lapage 2 vers 3
function swipo(){
    alert('hamburger');
}
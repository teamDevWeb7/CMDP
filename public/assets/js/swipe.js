// utilisé dans la page devis pour changer les questions

let para1=document.getElementById('p1');
let para2=document.getElementById('p2');
let para3=document.getElementById('p3');
let para4=document.getElementById('p4');

let textArea=document.querySelector('textarea');

let div=document.querySelectorAll('div');

let pBalise=document.querySelectorAll('p');

let alerte=document.querySelectorAll('my-alert');

// suivant
function swip(){
    // si je suis sur page 1 et que je vais sur page 2

    // si user n'a rien selectionner
    if(Q1==null || Q1==''){
        alerte[0].removeAttribute('class');
        para1.style.filter='blur(3px)';
        die;
    }

        para1.removeAttribute('class');
        para1.style.left='-100vw';

        para2.removeAttribute('class');
        // para2.setAttribute('class', 'left0');
        para2.style.left='0';

        div[3].removeAttribute('class');
        div[3].setAttribute('class', 'pts1');
        div[4].setAttribute('class', 'pts2 bigger');
}
// va avec l alerte qui empeche de passer à la page suivante
function fermer(){
    alerte[0].setAttribute('class', 'hideAlert');
    para1.style.filter='none';
}
function fermer1(){
    alerte[1].setAttribute('class', 'hideAlert');
    para2.style.filter='none';
}

// retour en arriere
function swi(){
    // si je suis sur page 2 et que je retourne sur page 1
        para1.style.left="0";
        para2.style.left="-100vw";

        div[4].removeAttribute('class');
        div[4].setAttribute('class', 'pts2');
        div[3].setAttribute('class', 'pts1 bigger');
}

// fonction suivant de lapage 2 vers 3
function swipo(){

    if(besoins.length == 0){
        alerte[1].removeAttribute('class');
        
        para2.style.filter='blur(3px)';
        die;
        
    }
    para2.removeAttribute('class');
    para2.style.left='-100vw';

    para3.removeAttribute('class');
    // para3.setAttribute('class', 'cc');
    para3.style.left='0';

    div[4].removeAttribute('class');
    div[4].setAttribute('class', 'pts2');
    div[5].setAttribute('class', 'pts3 bigger');

}



// retour en arriere
function sw(){
    // si je suis sur page 3 et que je retourne sur page 2
        para2.style.left="0";
        para3.style.left="-100vw";

        div[5].removeAttribute('class');
        div[5].setAttribute('class', 'pts3');
        div[4].setAttribute('class', 'pts2 bigger');
}

// fonction suivant de lapage 3 vers 4
function swopo(){

    para3.removeAttribute('class');
    para3.style.left='-100vw';

    para4.removeAttribute('class');
    // para3.setAttribute('class', 'cc');
    para4.style.left='0';

    div[5].removeAttribute('class');
    div[5].setAttribute('class', 'pts3');
    div[6].setAttribute('class', 'pts4 bigger');

}

// retour de lapage 4 à 3
function swa(){
    // si je suis sur page 3 et que je retourne sur page 2
        para3.style.left="0";
        para4.style.left="-100vw";

        div[6].removeAttribute('class');
        div[6].setAttribute('class', 'pts4');
        div[5].setAttribute('class', 'pts3 bigger');
}
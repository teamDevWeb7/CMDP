// utilisé dans lapage devis pour faire le style et ramasser infos

let p=document.querySelectorAll('p');
let span=document.querySelectorAll('span');
let Q1;


// je mets dans une var Q1 la valeur que sélectionne l'user

// ajoute une class pr que user voit ce qu'il selectionne
p[1].addEventListener(
    'click',
    (event)=>{
        if(span[0].getAttribute('class')==='R'){
            span[0].setAttribute("class", "selected");
            span[1].setAttribute("class", "R");
            span[2].setAttribute("class", "R");
            Q1=span[0].textContent;
            // alert(Q1);
        }else{
            span[0].setAttribute("class", "R");
        }
    } 
)

// ajoute une class pr que user voit ce qu'il selectionne
p[2].addEventListener(
    'click',
    (event)=>{
        if(span[1].getAttribute('class')==='R'){
            span[1].setAttribute("class", "selected");
            span[0].setAttribute("class", "R");
            span[2].setAttribute("class", "R");
            Q1=span[1].textContent;
            // alert(Q1);
        }else{
            span[1].setAttribute("class", "R");
        }
    } 
)

// ajoute une class pr que user voit ce qu'il selectionne
p[3].addEventListener(
    'click',
    (event)=>{
        if(span[2].getAttribute('class')==='R'){
            span[2].setAttribute("class", "selected");
            span[1].setAttribute("class", "R");
            span[0].setAttribute("class", "R");
            Q1=span[2].textContent;
            // alert(Q1);
        }else{
            span[2].setAttribute("class", "R");
        }
    } 
)









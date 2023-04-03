// utilisé dans lapage devis pour faire le style et ramasser infos

let p=document.querySelectorAll('p');
let span=document.querySelectorAll('span');
var Q1;


// je mets dans une var Q1 la valeur que sélectionne l'user

// ajoute une class pr que user voit ce qu'il selectionne
p[2].addEventListener(
    'click',
    (event)=>{
        if(span[0].getAttribute('class')==='R'){
            span[0].setAttribute("class", "selected");
            span[1].setAttribute("class", "R");
            span[2].setAttribute("class", "R");
            Q1=span[0].textContent;
            alert(Q1);
        }else{
            span[0].setAttribute("class", "R");
            Q1='';
        }
    } 
)

// ajoute une class pr que user voit ce qu'il selectionne
p[3].addEventListener(
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
            Q1='';
        }
    } 
)

// ajoute une class pr que user voit ce qu'il selectionne
p[4].addEventListener(
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
            Q1='';
        }
    } 
)




// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


// deuxieme page, recueil besoins
let index;
var besoins=[];
let i;


// revetements
p[5].addEventListener(
    'click',
    (event)=>{
        if(span[3].getAttribute('class')==='R2'){
            span[3].setAttribute("class", "selecte");
            besoins.push(span[3].innerText);
        }else{
            span[3].setAttribute("class", "R2");

            // pr trouver index
            let retrouver= (element)=> element === span[3].innerText;
            index=besoins.findIndex(retrouver);

            // supprimer du tableau
            besoins.splice(index, 1);
        }
    } 
)
// menuiseries
p[6].addEventListener(
    'click',
    (event)=>{
        if(span[4].getAttribute('class')==='R2'){
            span[4].setAttribute("class", "selecte");
            besoins.push(span[4].innerText);
        }else{
            span[4].setAttribute("class", "R2");

            // pr trouver index
            let retrouver= (element)=> element === span[4].innerText;
            index=besoins.findIndex(retrouver);
            
            // supprimer du tableau
            besoins.splice(index, 1);
        }
    } 
)
// Isolation
p[7].addEventListener(
    'click',
    (event)=>{
        if(span[5].getAttribute('class')==='R2'){
            span[5].setAttribute("class", "selecte");
            besoins.push(span[5].innerText);
        }else{
            span[5].setAttribute("class", "R2");

            // pr trouver index
            let retrouver= (element)=> element === span[5].innerText;
            index=besoins.findIndex(retrouver);
            
            // supprimer du tableau
            besoins.splice(index, 1);
        }
    } 
)
// toiture
p[8].addEventListener(
    'click',
    (event)=>{
        if(span[6].getAttribute('class')==='R2'){
            span[6].setAttribute("class", "selecte");
            besoins.push(span[6].innerText);
        }else{
            span[6].setAttribute("class", "R2");

            // pr trouver index
            let retrouver= (element)=> element === span[6].innerText;
            index=besoins.findIndex(retrouver);
            
            // supprimer du tableau
            besoins.splice(index, 1);
        }
    } 
)
// construction
p[9].addEventListener(
    'click',
    (event)=>{
        if(span[7].getAttribute('class')==='R2'){
            span[7].setAttribute("class", "selecte");
            besoins.push(span[7].innerText);
        }else{
            span[7].setAttribute("class", "R2");

            // pr trouver index
            let retrouver= (element)=> element === span[7].innerText;
            index=besoins.findIndex(retrouver);
            
            // supprimer du tableau
            besoins.splice(index, 1);
        }
    } 
)
// sdb
p[10].addEventListener(
    'click',
    (event)=>{
        if(span[8].getAttribute('class')==='R2'){
            span[8].setAttribute("class", "selecte");
            besoins.push(span[8].innerText);
        }else{
            span[8].setAttribute("class", "R2");

            // pr trouver index
            let retrouver= (element)=> element === span[8].innerText;
            index=besoins.findIndex(retrouver);
            
            // supprimer du tableau
            besoins.splice(index, 1);
        }
    } 
)
// extérieur
p[11].addEventListener(
    'click',
    (event)=>{
        if(span[9].getAttribute('class')==='R2'){
            span[9].setAttribute("class", "selecte");
            besoins.push(span[9].innerText);
        }else{
            span[9].setAttribute("class", "R2");

            // pr trouver index
            let retrouver= (element)=> element === span[9].innerText;
            index=besoins.findIndex(retrouver);
            
            // supprimer du tableau
            besoins.splice(index, 1);
        }
    } 
)
// cuisine
p[12].addEventListener(
    'click',
    (event)=>{
        if(span[10].getAttribute('class')==='R2'){
            span[10].setAttribute("class", "selecte");
            besoins.push(span[10].innerText);
        }else{
            span[10].setAttribute("class", "R2");

            // pr trouver index
            let retrouver= (element)=> element === span[10].innerText;
            index=besoins.findIndex(retrouver);
            
            // supprimer du tableau
            besoins.splice(index, 1);
        }
    } 
)
// autre
p[13].addEventListener(
    'click',
    (event)=>{
        if(span[11].getAttribute('class')==='R2'){
            span[11].setAttribute("class", "selecte");
            besoins.push(span[11].innerText);
        }else{
            span[11].setAttribute("class", "R2");

            // pr trouver index
            let retrouver= (element)=> element === span[11].innerText;
            index=besoins.findIndex(retrouver);
            
            // supprimer du tableau
            besoins.splice(index, 1);
        }
    } 
)



// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

// page 3, prospect explique son projet

var mess=document.querySelector('#descriptionProjet').textContent;







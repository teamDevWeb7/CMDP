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




// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


// deuxieme page, recueil besoins
let index;
let besoins=[];
let i;


// revetements
p[4].addEventListener(
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
p[5].addEventListener(
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
p[6].addEventListener(
    'click',
    (event)=>{
        if(span[5].getAttribute('class')==='R2'){
            span[5].setAttribute("class", "selecte");
        }else{
            span[5].setAttribute("class", "R2");
        }
    } 
)
// toiture
p[7].addEventListener(
    'click',
    (event)=>{
        if(span[6].getAttribute('class')==='R2'){
            span[6].setAttribute("class", "selecte");
        }else{
            span[6].setAttribute("class", "R2");
        }
    } 
)
// construction
p[8].addEventListener(
    'click',
    (event)=>{
        if(span[7].getAttribute('class')==='R2'){
            span[7].setAttribute("class", "selecte");
        }else{
            span[7].setAttribute("class", "R2");
        }
    } 
)
// sdb
p[9].addEventListener(
    'click',
    (event)=>{
        if(span[8].getAttribute('class')==='R2'){
            span[8].setAttribute("class", "selecte");
        }else{
            span[8].setAttribute("class", "R2");
        }
    } 
)
// extérieur
p[10].addEventListener(
    'click',
    (event)=>{
        if(span[9].getAttribute('class')==='R2'){
            span[9].setAttribute("class", "selecte");
        }else{
            span[9].setAttribute("class", "R2");
        }
    } 
)
// cuisine
p[11].addEventListener(
    'click',
    (event)=>{
        if(span[10].getAttribute('class')==='R2'){
            span[10].setAttribute("class", "selecte");
        }else{
            span[10].setAttribute("class", "R2");
        }
    } 
)
// autre
p[12].addEventListener(
    'click',
    (event)=>{
        if(span[11].getAttribute('class')==='R2'){
            span[11].setAttribute("class", "selecte");
        }else{
            span[11].setAttribute("class", "R2");
        }
    } 
)



// faire boucle if class = selecte dans tab
// function recueil(){
//     let i;
//     let besoin=[span[3], span[4], span[5], span[6], span[7], span[8], span[9], span[10], span[11]];
//     let taille=besoin.length;
//     let besoins;

//     for(i=0; i<taille; i++){
//         if(besoin[i].style.class="selecte"){
//             alert('jojo');
//             besoins+=besoin[i]+' ';
//         }
//         alert(besoins);
//     }
// }







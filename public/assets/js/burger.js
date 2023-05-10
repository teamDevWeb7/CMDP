let burger=document.querySelector('#burger');
// gestion animation menu burg
let menuBurg=document.querySelector('#menuBurg');
let salut=false;

let barres=document.querySelectorAll('#burger img');

burger.addEventListener('click',
    ()=>{
        if(salut==false){
            menuBurg.classList.add('salut');
            menuBurg.classList.remove('cacheToi');
            salut=true;

            barres[1].classList.add('yop');
            barres[1].classList.remove('yo');
            barres[0].classList.add('rotation');
            barres[2].classList.add('rotation1');
            barres[0].classList.remove('shutD');
            barres[2].classList.remove('shutD1');
            
        }else{
            menuBurg.classList.remove('salut');
            menuBurg.classList.add('cacheToi');
            salut=false;

            barres[1].classList.add('yo');
            barres[1].classList.remove('yop');
            barres[0].classList.remove('rotation');
            barres[2].classList.remove('rotation1');
            barres[0].classList.add('shutD');
            barres[2].classList.add('shutD1');
        }
    })

// page affichée dans nav
let A=document.querySelectorAll('header li a');
let destination=document.querySelector('#titre');

const arrayA={
    "/":A[0],
    "/user/aPropos":A[1],
    "/user/chantiers":A[2],
    "/user/devis":A[3],
    "/user/FAQ":A[4],
    "/user/contact":A[5]
 }


 let chemin1 = window.location.pathname;

 window.addEventListener(
     'load',
     (event)=>{
    for(let key in arrayA){
        let valeur=arrayA[key].innerHTML;

        if(key==chemin1){
            destination.innerHTML=valeur;
        }
    }
    } 
 )

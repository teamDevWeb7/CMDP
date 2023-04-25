// pour que le a de la page active soit différent des autres

let a=document.querySelectorAll('header li a');

// tableau associatif, clé est le pathname, value est le a
const array={
   "/":a[0],
   "/user/aPropos":a[1],
   "/user/chantiers":a[2],
   "/user/devis":a[3],
   "/user/FAQ":a[4],
   "/user/contact":a[5]
}

// sort le pathname de la page active
// nom que j'ai définit dans mes routes
let chemin = window.location.pathname;

window.addEventListener(
   // event sur page qd chargée
    'load',
    (event)=>{
      // manip en plus pour tableau associatif -> Object.key(...)
      // boucle forEach sur ts les éléments du tableau
      Object.keys(array).forEach(function(key){
         // si key du tab asso == pathname page active
         if(key == chemin){
            // console.log(array[key]);
            // console.log(array[key].innerText);

            // on lui met une class
            // ne fonctionne pas avec .style.color="..."
            array[key].setAttribute('class', 'pageActive');
         }
      })
   } 
)





// cacher message activer JS svp
// si user a desactivé js le message s'affiche ->pck display none donné en JS
// si js activé on est en display none automatiquement
let svp=document.querySelector('#useJS');
window.addEventListener('onload', ()=>{
   svp.style.display='none';
})
window.addEventListener('load', ()=>{
   svp.style.display='none';
})

let a=document.querySelectorAll('header li a');

const array={
    "/admin/accueil":a[0],
    "/admin/tousMesDevis":a[1],
    "/admin/tousMesMessages":a[2],
    "/admin/tousMesProspects":a[3],
    "/admin/chantiers":a[4],
    "/admin/deco":a[5]
 }

 let chemin = window.location.pathname;

 window.addEventListener(
     'load',
     (event)=>{
       Object.keys(array).forEach(function(key){
          if(key == chemin){
             array[key].setAttribute('class', 'pageActive');
          }else{
            array[key].style.color="grey";
          }
       })
    } 
 )
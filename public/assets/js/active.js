li=document.querySelectorAll('header li');
// taille=li.length;
chemin =window.location.pathname;
array={
   "/":li[0],
   "/user/aPropos":li[1],
   "/user/chantiers":li[2],
   "/user/devis":li[3],
   "/user/faq":li[4],
   "/user/contact":li[5]
}

document.addEventListener(
    'onload',
    (event)=>{
      array.forEach((element, index) => {
         if(chemin==index){
            element.style.color='red';
         }
      });
    } )
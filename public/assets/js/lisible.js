let etat=document.querySelectorAll('.etat');
let sizeEtat=etat.length;

for(let i=0; i<sizeEtat; i++){
    if(etat[i].innerHTML==0){
        etat[i].innerHTML= '<p style="color:red; font-size:1rem;">en attente</p>';
    }else{
        etat[i].innerHTML='<p style="color:green; font-size:1rem; font-style:normal">traité</p>';
    }
}



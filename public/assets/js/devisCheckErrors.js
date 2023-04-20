function checkErreurs(){
    const inputs=document.querySelectorAll('input');

        validation(inputs);
}
// verif champs
function afficheErreur(erreur){
    let myDiv=document.querySelector('my-div');
    let alerte=document.querySelectorAll('my-alert');
    let para4=document.getElementById('p4');
    let avance=document.querySelector('.chemin');
    console.log(erreur);
    alerte[2].classList.remove('hideAlert');
    alerte[2].querySelector('my-div').innerHTML=erreur;
    para4.style.filter='blur(3px)';
    avance.style.filter='blur(3px)';
}

function checkMail(votreMail){
    let regexp=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regexp.test(votreMail);
}
function validation(inputs){
    let mail=inputs[2].value;
    if(!checkMail(mail)){
        let pbmail="<my-p class='lang' key='email'>Le champs email doit contenir un email valide</my-p>";
        afficheErreur(pbmail);
    }
    if(inputs[0].value===''|| inputs[1].value===''||inputs[2].value===''||inputs[3].value===''){
        let pbChamps="<my-p class='lang' key='required'>Tous les champs sont obligatoires</my-p>";
        afficheErreur(pbChamps);
    }

}
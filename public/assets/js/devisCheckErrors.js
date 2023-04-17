function checkErreurs(){
    let inputs=document.querySelectorAll('input');
    let alerte=document.querySelectorAll('my-alert');
    let myDiv=document.querySelector('my-div');
    let para4=document.getElementById('p4');
    let avance=document.querySelector('.chemin');


        // verif champs
        function afficheErreur(erreur){
            console.log(erreur);
            alerte[2].classList.remove('hideAlert');
            myDiv.innerHTML=erreur;
            para4.style.filter='blur(3px)';
            avance.style.filter='blur(3px)';
            die;
        }
    
        function checkMail(votreMail){
            let regexp=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return regexp.test(votreMail);
        }
        function validation(){
            let mail=inputs[2].value;
            if(!checkMail(mail)){
                let pbmail="<my-p class='lang' key='email'>Le champs email doit contenir un email valide</my-p>";
                afficheErreur(pbmail);
            }
            if((inputs[0].value='')|| (inputs[1].value='')|| (inputs[2].value='')|| (inputs[3].value='')){
                let pbChamps="<my-p class='lang' key='required'>Tous les champs sont obligatoires</my-p>";
                afficheErreur(pbChamps);
            }

        }
        validation();


}
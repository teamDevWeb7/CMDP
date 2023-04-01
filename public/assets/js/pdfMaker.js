function pdfMaker(){

    const {jsPDF} =window.jspdf;
    const doc= new jsPDF();

    var titre='Récapitulatif de ma demande de devis';

    let analyseBesoins='';
    let description=document.querySelector('textarea').value;
    console.log(description);

    let nom=document.querySelector('#nom1').value;
    let prenom=document.querySelector('#prenom1').value;
    let mail=document.querySelector('#mail1').value;
    let tel=document.querySelector('#tel1').value;

    let taille=besoins.length;

    for(i=0;i<taille;i++){
        if(i>=taille-1){
            analyseBesoins+=besoins[i]+'';
        }else{
            analyseBesoins+=besoins[i]+', ';
        }
    }

    let splitIfNecessary=doc.splitTextToSize(analyseBesoins, 180);

    if(description==null || description==''){
        description='Aucune information n\'a été renseignée';
    }

    let split=doc.splitTextToSize(description, 180);

    doc.text(55,20, titre);
    doc.text(10,50, 'Mon bien à rénover :');
    doc.text(10,60, Q1);
    doc.text(10,75, 'Les services dont je pense avoir besoin :');
    doc.text(10,85,splitIfNecessary);
    doc.text(10,105, 'Mes coordonnées :');
    doc.text(10,115,nom);
    doc.text(10,125,prenom);
    doc.text(10,135,mail);
    doc.text(10,145,tel);
    doc.text(10,160, 'La description de mon projet :');
    doc.text(10,170, split);
    doc.text(65, 290, 'Produit par Cmydesignprojets');
    // 1 margin left
    // 2 margin top

    // textarea et ttes proprietes
    console.log(doc);
    // doc.save("devisCmydesignprojets.pdf");
    // check comment recup pdf 

}


// function pdfMaker1(){
//     // Q1;
//     // besoins[];
//     let analyseBesoins='';
//     let description=document.querySelector('textarea').value;
//     console.log(description);
//     let coordonnees=document.querySelectorAll('input').value;
//     let date = new Date;

//     for(i=0; i<besoins.length; i++){
//         analyseBesoins+=besoins[i]+' ';
//     }

//     // jusque là c'est ok

//     swipouille.style.display='none';
//     jojo.setAttribute('class', 'jojo');

//     jojo.innerHTML=`
//     <div class="contain">
//         <h1>Récapitulatif de ma demande de devis faite le ${date.prototype.toLocaleString()}</h1>
//             <p>L'objet de ma rénovation : ${Q1}</p>
//             <p>Je pense avoir besoin de : ${analyseBesoins}</p>
//             <p>Description de mon projet : ${description}</p>
//             <p>Mon nom : ${coordonnees[0]}</p>
//             <p>Mon prénom : ${coordonnees[1]}</p>
//             <p>Mon adresse mail : ${coordonnees[2]}</p>
//             <p>Mon numéro de téléphone : ${coordonnees[3]}</p>
//             <p>Merci pour votre confiance, nous vous recontacterons<br>dans les plus brefs délais.</p>
//     </div>
//     <div class="mesBtns">
//         <button class="monPdf">Générer mon PDF</button>
//         <button class="retry" {{path('devis')}}>Recommencer un devis</button>
//     </div>
//     `;

//     let pdfer=document.querySelector('.jojo');
//     html2pdf(pdfer);

// }
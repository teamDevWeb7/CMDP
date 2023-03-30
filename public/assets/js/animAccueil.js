// animation pas fluide ->setInterval->augmenter le temps entre etapes?
// sinon css trkl mais avec request animation frame pck mieux pr navigateur et ram de user

// select
let div=document.querySelector('#anim div');
// param debut
let left=0;
// function qu'on va rappeler en boucle
let movee=function(){
    // on rajoute une classe qui possede translate
    div.classList.add('right');
    // ttes les 3s
    window.setTimeout(function(){
        requestAnimationFrame(function(){
            // retire classe ->retourne etat initial
            div.classList.remove('right');
            // rappel function ->recommence etat initial, deplace, etc
            window.setTimeout(function(){
                requestAnimationFrame(movee);
            })
        })
    }, 3000)
}
requestAnimationFrame(movee);
// nav gere mieux lancement anim et tourne pas si change onglet
// ne peut pas specifier temps, donc faut creeer une function avec params



// animation nomAnim Xs forwards(garder img fin)

// 1-> je fais les chaussures -> genre 20s en tout sur ecran
//     commence à gauche, pause au milieu, disparaissent à droite
//     +etapes mais ont meme coord (effet coup par coup)
//     pause au milieu là ou seau -> 2 etapes avec meme coordonnees

// 2-> seau
//     jusqu'a ce que chaussures arrivent à sa hauteur ne bouge pas, ensuite souleve
//     ensuite deplace jusqu'a disparaitre à droite avec chaussures
//     effet coup par coup ou fluide ?

// 3-> les deux animations sont sorties de l'écran
//     la tâche de peinture se releve ->centre
//     peinture coule
//     nom ent se rajoute, anim logo deplace gauche pour que E soit centré
//     effet apparition texte opacity ou overflow hidden et translate qq chose

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
            }, 4000)
        })
    }, 4000)
}
requestAnimationFrame(movee);

let leftShoe=document.querySelector('#leftShoe');

let goBanana=function(){
    leftShoe.classList.add('animShoe');
    leftShoe.classList.add('cache');

    window.setTimeout(function(){
        requestAnimationFrame(function(){
            leftShoe.classList.add('pause');
            leftShoe.classList.remove('cache');
        })
        window.setTimeout(function(){
            requestAnimationFrame(function(){
                leftShoe.classList.remove('pause');
                leftShoe.classList.add('cache');
            })
        }, 1500)

        window.setTimeout(function(){
            requestAnimationFrame(function(){
                leftShoe.classList.add('pause');
                leftShoe.classList.remove('cache');
            })
            window.setTimeout(function(){
                requestAnimationFrame(function(){
                    leftShoe.classList.remove('pause');
                    leftShoe.classList.add('cache');
                })
            }, 1500)

            window.setTimeout(function(){
                requestAnimationFrame(function(){
                    leftShoe.classList.add('pause');
                    leftShoe.classList.remove('cache');
                })
                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        leftShoe.classList.remove('pause');
                        leftShoe.classList.add('cache');
                    })
                }, 1500)


                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        leftShoe.classList.add('pause');
                        leftShoe.classList.remove('cache');
                    })
                    window.setTimeout(function(){
                        requestAnimationFrame(function(){
                            leftShoe.classList.remove('pause');
                            leftShoe.classList.add('cache');
                        })
                    }, 1500)
                    

                    window.setTimeout(function(){
                        requestAnimationFrame(function(){
                            leftShoe.classList.add('pause');
                            leftShoe.classList.remove('cache');
                        })
                        window.setTimeout(function(){
                            requestAnimationFrame(function(){
                                leftShoe.classList.remove('pause');
                                leftShoe.classList.add('cache');
                            })
                        }, 3000)
                        
                        window.setTimeout(function(){
                            requestAnimationFrame(function(){
                                leftShoe.classList.add('pause');
                                leftShoe.classList.remove('cache');
                            })
                            window.setTimeout(function(){
                                requestAnimationFrame(function(){
                                    leftShoe.classList.remove('pause');
                                    leftShoe.classList.add('cache');
                                })
                            }, 1500)
                            
    
                            
                        }, 4500)
                        
                    }, 3700)
                }, 3600)
            }, 3500)
        }, 3400)
    }, 1500)

}
requestAnimationFrame(goBanana);

let rightShoe=document.querySelector('#rightShoe');

let goBanana1=function(){
    rightShoe.classList.add('animShoe');
    rightShoe.classList.add('cache');

    window.setTimeout(function(){
        requestAnimationFrame(function(){
            rightShoe.classList.add('pause');
            rightShoe.classList.remove('cache');
        })
        window.setTimeout(function(){
            requestAnimationFrame(function(){
                rightShoe.classList.remove('pause');
                rightShoe.classList.add('cache');
            })
        }, 1500)

        window.setTimeout(function(){
            requestAnimationFrame(function(){
                rightShoe.classList.add('pause');
                rightShoe.classList.remove('cache');
            })
            window.setTimeout(function(){
                requestAnimationFrame(function(){
                    rightShoe.classList.remove('pause');
                    rightShoe.classList.add('cache');
                })
            }, 1500)

            window.setTimeout(function(){
                requestAnimationFrame(function(){
                    rightShoe.classList.add('pause');
                    rightShoe.classList.remove('cache');
                })
                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        rightShoe.classList.remove('pause');
                        rightShoe.classList.add('cache');
                    })
                }, 1500)


                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        rightShoe.classList.add('pause');
                        rightShoe.classList.remove('cache');
                    })
                    window.setTimeout(function(){
                        requestAnimationFrame(function(){
                            rightShoe.classList.remove('pause');
                            rightShoe.classList.add('cache');
                        })
                    }, 1500)
                    

                    window.setTimeout(function(){
                        requestAnimationFrame(function(){
                            rightShoe.classList.add('pause');
                            rightShoe.classList.remove('cache');
                        })
                        window.setTimeout(function(){
                            requestAnimationFrame(function(){
                                rightShoe.classList.remove('pause');
                                rightShoe.classList.add('cache');
                            })
                        }, 3000)
                        
                        window.setTimeout(function(){
                            requestAnimationFrame(function(){
                                rightShoe.classList.add('pause');
                                rightShoe.classList.remove('cache');
                            })
                            window.setTimeout(function(){
                                requestAnimationFrame(function(){
                                    rightShoe.classList.remove('pause');
                                    rightShoe.classList.add('cache');
                                })
                            }, 1500)
                            
    
                            
                        }, 4300)
                        
                    }, 3200)
                }, 3400)
            }, 3300)
        }, 3200)
    }, 1300)

}
requestAnimationFrame(goBanana1);

// decalage entre les 2

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



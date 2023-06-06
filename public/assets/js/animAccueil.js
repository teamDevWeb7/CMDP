// animation sur lapage d'accueil
let bucket=document.querySelector('#handBucket');
bucket.classList.add('cache');
if((window.innerWidth>1250) && window.innerHeight>550){
    let leftShoe=document.querySelector('#leftShoe');
    let rightShoe=document.querySelector('#rightShoe');
    let buck=document.querySelector('#bucket');
    
    let dirt=document.querySelector('#dirt');
    let logo_titre=document.querySelector('#logo_titre');
    
    
    
    // pour gerer le seau
    let swaggiSwag=function(){
        
            buck.classList.add('cache');
            bucket.classList.remove('cache');
            bucket.classList.add('animBucket');
    
    }
    
    // gestion tache peinture + aller au centre de la page
    let peinturlurer=function(){
            dirt.classList.add('dirt');
    }
    
    
    
    
    // logo avec titre apparait
    let tadaaaa=function(){
            logo_titre.classList.add('hallo');
    }
    
    
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
                    leftShoe.classList.add('rotate');
                })
                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        leftShoe.classList.remove('pause');
                        leftShoe.classList.remove('rotate');
                        leftShoe.classList.add('cache');
                    })
                }, 500)
            }, 1000)
    
            window.setTimeout(function(){
                requestAnimationFrame(function(){
                    leftShoe.classList.add('pause');
                    leftShoe.classList.remove('cache');
                })
                window.setTimeout(function(){
                    requestAnimationFrame(swaggiSwag);
                },1500);
                
                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        leftShoe.classList.add('rotate');
                    })
                    
                    window.setTimeout(function(){
                        requestAnimationFrame(function(){
                            
                            leftShoe.classList.remove('pause');
                            leftShoe.classList.remove('rotate');
                            leftShoe.classList.add('cache');
                        })
                    }, 500)
                }, 2500)
                window.setTimeout(function(){
                    requestAnimationFrame(peinturlurer);
                }, 4800);
                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        leftShoe.classList.add('pause');
                        leftShoe.classList.remove('cache');
                    })
                    
                    window.setTimeout(function(){
                        requestAnimationFrame(tadaaaa);
                        requestAnimationFrame(function(){
                            leftShoe.classList.add('rotate');
                        })
                        window.setTimeout(function(){
                            requestAnimationFrame(function(){
                                leftShoe.classList.remove('pause');
                                leftShoe.classList.remove('rotate');
                                leftShoe.classList.add('cache');
                            })
                        }, 500)
                    }, 1000)
    
                }, 4600)
            }, 2250)
        }, 1500)
    
    }
    requestAnimationFrame(goBanana);
    
    
    
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
                    rightShoe.classList.add('rotate');
                })
                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        rightShoe.classList.remove('pause');
                        rightShoe.classList.remove('rotate');
                        rightShoe.classList.add('cache');
                    })
                }, 500)
            }, 1000)
    
            window.setTimeout(function(){
                requestAnimationFrame(function(){
                    rightShoe.classList.add('pause');
                    rightShoe.classList.remove('cache');
                })
                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        rightShoe.classList.add('rotate');
                    })
                    window.setTimeout(function(){
                        requestAnimationFrame(function(){
                            rightShoe.classList.remove('pause');
                            rightShoe.classList.remove('rotate');
                            rightShoe.classList.add('cache');
                        })
                    }, 500)
                }, 2000)
    
                window.setTimeout(function(){
                    requestAnimationFrame(function(){
                        rightShoe.classList.add('pause');
                        rightShoe.classList.remove('cache');
                    })
                    window.setTimeout(function(){
                        requestAnimationFrame(function(){
                            rightShoe.classList.add('rotate');
                        })
                        window.setTimeout(function(){
                            requestAnimationFrame(function(){
                                rightShoe.classList.remove('pause');
                                rightShoe.classList.remove('rotate');
                                rightShoe.classList.add('cache');
                            })
                        }, 500)
                    }, 600)
    
    
                    window.setTimeout(function(){
                        requestAnimationFrame(function(){
                            rightShoe.classList.add('pause');
                            rightShoe.classList.remove('cache');
                        })
                        window.setTimeout(function(){
                            requestAnimationFrame(function(){
                                rightShoe.classList.add('rotate');
                            })
                            window.setTimeout(function(){
                                requestAnimationFrame(function(){
                                    rightShoe.classList.remove('pause');
                                    rightShoe.classList.remove('rotate');
                                    rightShoe.classList.add('cache');
                                })
                            }, 500)
                        }, 600)
    
                    }, 4500)
                }, 3500)
            }, 2900)
        }, 800)
    
    }
    requestAnimationFrame(goBanana1);
    
}else if(window.innerWidth<1250 || window.innerHeight<550){
    document.querySelector('#anim div').innerHTML='<p>Merci de mettre la fenêtre en plein écran pour profiter de l\'animation ;)</p>';
    window.setInterval(function(){location.reload()},2500);
}









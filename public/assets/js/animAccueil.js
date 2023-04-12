// animation sur lapage d'accueil

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
                }, 600)

            }, 4600)
        }, 2250)
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

let buck=document.querySelector('#bucket');
let bucket=document.querySelector('#handBucket');

// pour gerer le seau
let swaggiSwag=function(){
    bucket.classList.add('cache');
    window.setTimeout(function(){
        buck.classList.add('cache');
        bucket.classList.remove('cache');
        bucket.classList.add('animBucket');
        
    }, 5000)

}
requestAnimationFrame(swaggiSwag);

let dirt=document.querySelector('#dirt');

// gestion tache peinture + aller au centre de la page
let peinturlurer=function(){
    window.setTimeout(function(){
        dirt.classList.add('dirt');
        
    }, 8000)
}
requestAnimationFrame(peinturlurer);

let logo_titre=document.querySelector('#logo_titre');

// logo avec titre apparait
let tadaaaa=function(){
    window.setTimeout(function(){
        dirt.classList.add('aufWierdesen');
        logo_titre.classList.add('hallo');
        
    }, 10000)
}
requestAnimationFrame(tadaaaa);





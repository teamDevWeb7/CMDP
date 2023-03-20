// si le captcha est coché, l'input caché prend la value du token
// ->verif php -> si input empty alors case pas cochée
grecaptcha.ready(function(){
    grecaptcha.execute('6LfpX-ckAAAAAN9NuwK9BKuWBfPekgenk1TinPU6',{action:'contact'}).then(function(token){
        document.getElementById('recaptchaResponse').value=token
    });
});
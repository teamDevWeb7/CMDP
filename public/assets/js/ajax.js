function sendData(e) {
    e.preventDefault();
    const g_recaptcha = document.querySelector('#g-recaptcha-response');
    const recaptcha_response=g_recaptcha.value;
    // data=Object
    var data = {
        monBien: Q1,
        mesBesoins: besoins,
        monMessage: mess
    };

    var xhr = new XMLHttpRequest();
    var array = {'g_recaptcha_response': recaptcha_response};
    // array['g-recaptcha-response']= recaptcha_response;

    //👇 set the PHP page you want to send data to
    let url=window.location.origin+'/user/devis/'+JSON.stringify(data);
    xhr.open("POST",url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(array));


    console.log(data);

    //👇 what to do when you receive a response
    xhr.onload = function () {
            console.log(xhr.response);
    };
}
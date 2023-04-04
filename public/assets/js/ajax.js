function sendData() {
    // data=Object
    var data = {
        monBien: Q1,
        mesBesoins: besoins,
        monMessage: mess
    };

    var xhr = new XMLHttpRequest();



    //👇 what to do when you receive a response
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            console.log(xhr.responseText);
        }
    };

    //👇 set the PHP page you want to send data to
    // xhr.open("GET", ".../App/User/action/UserAction"+data, true);
    let url="devis";
    xhr.open("GET",url, true);
    // xhr.open("GET","devis"+data, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    //👇 send the data
    // xhr.send(JSON.stringify(data));
    xhr.send();

    console.log(data);


    // PB ds console url commence tjrs par user/
}
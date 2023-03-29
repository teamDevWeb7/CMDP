// fonctionne avec lay.js qui contient un tableau des langues qui contiennent elles même un tab associatif.

function translateLang(lang){
    // on prend ts les balises qui ont class lang
    $('.lang').each(function(index, item) {
      // on change le contenu selon la langue voulue
    $(this).text(arrLang[lang][$(this).attr('key')]);
    });
    
  }
  
  $(function() {
    //on check si y a une langue enregistrée ds localSorage
    let stored_lang = localStorage.getItem("stored_lang");
    //si oui on traduit ds langue voulue
    if(stored_lang != null && stored_lang != undefined){
      lang = stored_lang;
      translateLang(lang);
    }
    // quand je clique sur un de mes boutons pour changer de langue
    $('.langue').click(function() {
      var lang = $(this).attr('id');
      //on click -> langue enregistrée dans localStorage
      localStorage.setItem("stored_lang",lang);
      // appel fonction switch langues
      translateLang(lang);
      // sinon le A du header reste dans la langue précédente jusqu'au prochain reload
      location.reload();
    });
  
  });
var form = document.querySelector("form");
var _courriel = document.getElementById("courriel"); var b_courriel = false;
var aidecourriel = document.getElementById("aidecourriel");
var regexCourriel = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;

_courriel.addEventListener("blur", function (e) {
  if (!regexCourriel.test(_courriel.value)) {
    b_courriel = false;
    aidecourriel.textContent = "votre courriel est incorrect.";
  }
  else {
    b_courriel = true;
    aidecourriel.textContent = "";
  }
});

// Affichage de toutes les données saisies ou choisies dans la console
form.addEventListener("submit", function (e) {
    console.log("Email : " + form.elements.courriel.value + 
      "\nMot de passe : " + form.elements.mdp.value);

    console.log(b_courriel);

    if(!b_courriel){
      console.log("Envoie annulé !");
      e.preventDefault();
    }
    else{
      console.log("Envoie effectué !");
    }
});
var form = document.querySelector("form");

var _nom = document.getElementById("nom"); var b_nom = false;
var _courriel = document.getElementById("courriel"); var b_courriel = false;
var _message = document.getElementById("message"); var b_message = false;

// b_*** boolean veriyfing if a value is okay

var aidenom = document.getElementById("aidenom");
var aidecourriel = document.getElementById("aidecourriel");
var aidemessage = document.getElementById("aidemessage");

var b = true;

var regexMdpChiffre = /\d+/;
var regexMdpLMinusc = /[a-z]/;
var regexMdpLMajusc = /[A-Z]/;
var regexCourriel = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;
var regexSpecialChar = /[&"#{([\\_`|=°@+*/.<>?,;:!§µ¤$£^²~¨%)}\d]/;

_nom.addEventListener("blur", function (e) {
  if (regexSpecialChar.test(_nom.value)) {
    b_nom = false;
    aidenom.textContent = "votre nom ne doit contenir aucun caractère spécial.";
  }
  else {
    b_nom = true;
    aidenom.textContent = "";
  }
});

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

_message.addEventListener("blur", function (e)){
  if(_message.value.length == 0){
    b_message = false;
    aidemessage.textContent = "Un message vide ne sera pas envoyer";
  } else {
    b_message = true;
    aidemessage.textContent = "";
  }
}



// Affichage de toutes les données saisies ou choisies dans la console
form.addEventListener("submit", function (e) {
    console.log("Nom : " + form.elements.nom.value +
      "\nEmail : " + form.elements.courriel.value +
      "\nMessage : " + form.elements.message.value);

    console.log(b_nom+" "+b_courriel+" "+b_mdp+" "+b_confmdp+" "+b_message);

    if(!(b_nom && b_courriel && b_message)){
      console.log("Envoie annulé !");
      e.preventDefault();
    }
    else{
      console.log("Envoie effectué !");
    }
});

var form = document.querySelector("form");

var _nom = document.getElementById("nom"); var b_nom = false;
var _prenom = document.getElementById("prenom"); var b_prenom = false;
var _courriel = document.getElementById("courriel"); var b_courriel = false;
var _mdp = document.getElementById("mdp"); var b_mdp = false;
var _confmdp = document.getElementById("confmdp"); var b_confmdp = false;

// b_*** boolean veriyfing if a value is okay

var aidenom = document.getElementById("aidenom");
var aideprenom = document.getElementById("aideprenom");
var aidecourriel = document.getElementById("aidecourriel");
var aidemdp = document.getElementById("aidemdp");
var aideconfmdp = document.getElementById("aideconfmdp");
var aideanniv = document.getElementById("aideanniv");

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

_prenom.addEventListener("blur", function (e) {
  if (regexSpecialChar.test(_prenom.value)) {
    b_prenom = false;
    aideprenom.textContent = "votre prénom ne doit contenir aucun caractère spécial.";
  }
  else {
    b_prenom = true;
    aideprenom.textContent = "";
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

_mdp.addEventListener("focus", function (e) {
  if (_mdp.value.length < 8 || !regexMdpChiffre.test(_mdp.value) || !regexMdpLMinusc.test(_mdp.value) || !regexMdpLMajusc.test(_mdp.value)) {
    aidemdp.textContent = "Votre mot de passe doit contenir au moins : 8 caractères, 1 minuscule, 1 majuscule, 1 chiffre.";
    b_mdp = false;
  }
});

_mdp.addEventListener("blur", function (e) {
  if (_mdp.value.length >= 8 && regexMdpChiffre.test(_mdp.value) && regexMdpLMinusc.test(_mdp.value) && regexMdpLMajusc.test(_mdp.value)) {
    aidemdp.textContent = "";
    b_mdp = true;
  }
});

_confmdp.addEventListener("blur", function (e) {
  if (b_mdp && _confmdp.value !== _mdp.value) {
    b_confmdp = false;
    aideconfmdp.textContent = "erreur de confirmation du mot de passe.";
  }
  else if (b_mdp && _confmdp.value === _mdp.value) {
    aideconfmdp.textContent = "";
    b_confmdp = true;
  }
  else 
    aideconfmdp.textContent = "";
});

// Affichage de toutes les données saisies ou choisies dans la console
form.addEventListener("submit", function (e) {
    console.log("Nom : " + form.elements.nom.value + 
      "\nPrénom : " + form.elements.prenom.value + 
      "\nEmail : " + form.elements.courriel.value + 
      "\nMot de passe : " + form.elements.mdp.value + 
      "\nConfirmation mot de passe : " + form.elements.confmdp.value + 
      "\nDate de naissance : " + form.elements.anniv.value + 
      "\nSexe : " + form.elements.sexe.value);

    console.log(b_nom+" "+b_prenom+" "+b_courriel+" "+b_mdp+" "+b_confmdp);

    if(!(b_nom && b_prenom && b_courriel && b_mdp && b_confmdp)){
      console.log("Envoie annulé !");
      e.preventDefault();
    }
    else{
      console.log("Envoie effectué !");
    }
});
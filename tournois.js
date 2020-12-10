$(".eventForm").hide();

// Clic sur le bouton "Créer événément"
$("#creer").click(function (e) {
  $("#creation").toggle(); // on affiche le bloc contenant l'identifiant création s'il est caché ; sinon on le cache.
  console.log("Toggle effectué");
  console.log(e.target.getAttribute("id"));

  if (e.target.getAttribute("id") === "creer") { // si l'élément sur lequel on clique porte l'id "creer"
    $("#editer").attr("disabled", true); // on rend inaccessible les deux autres boutons
    $("#enregistrer").attr("disabled", true);
    $(e.target).attr({ // on modifie son style et on change son id
      class : "btn btn-danger", 
      id : "annulerCreation" 
    });  
    $(e.target).text("Annuler création");  // on modifie le texte que contient ce élément
  } 
  else { // si l'id === "annulerCreation" on revient au format initiale au prochain clic.
    $("#editer").removeAttr("disabled");
    $("#enregistrer").removeAttr("disabled");
    $(e.target).attr({
      class : "btn btn-secondary",
      id : "creer"
    });  
    $(e.target).text("Créer événement");
  }
});

// Clic sur le bouton "Préinscrire équipe"
$("#enregistrer").click(function (e) {
  $("#enregistrement").toggle();
  console.log("Toggle effectué");
  console.log(e.target.getAttribute("id"));
  
  if (e.target.getAttribute("id") === "enregistrer") {
    $("#editer").attr("disabled", true);
    $("#creer").attr("disabled", true);
    $(e.target).attr({
      class : "btn btn-danger", 
      id : "annulerEnregistrement" 
    });  
    $(e.target).text("Annuler préinscription"); 
  } 
  else {
    $("#editer").removeAttr("disabled");
    $("#creer").removeAttr("disabled");
    $(e.target).attr({
      class : "btn btn-secondary",
      id : "enregistrer"
    });  
    $(e.target).text("Préinscrire équipe");
  }
});



$("button#ajouterJoueur").click(function () { 
  let nbJoueurs = parseInt($("#nbJoueurs").val())+1;
  $("#nbJoueurs").attr("value", nbJoueurs);
  let newPlayer = "<hr class='my-3'>\
                    <div class=''>\
                      <div class='mb-3'>\
                          <input type='text' id='joueur"+nbJoueurs+"' name='joueur"+nbJoueurs+"' class='nc_form_control' placeholder='Nom du joueur'>\
                      </div>\
                      <div class='mb-3'>\
                        <select id='niveau"+nbJoueurs+"' name='niveau"+nbJoueurs+"' class='nc_form_control'>\
                          <option value='1'>Pro</option>\
                          <option value='2'>Elite</option>\
                          <option value='3'>Régional</option>\
                          <option value='4'>Départemental</option>\
                          <option value='5' selected>Loisir</option>\
                        </select>\
                      </div>\
                    </div>";
  $(this).before(newPlayer);
  console.log("Champs J"+nbJoueurs+" ajouté !");
});

$("button#ajouterTournoi").click(function () { 
  let nbTournois = parseInt($("#nbTournois").val())+1;
  $("#nbTournois").attr("value", nbTournois);

  let newTournois = "<hr class='my-3'>\
                    <div class='my-2 row col-md-12'>\
                      <div class='mb-3 col-md-6'>\
                          <input type='text' class='nc_form_control' name='nomT"+nbTournois+"' id='nomT"+nbTournois+"' placeholder='Nom du tournoi' required>\
                      </div>\
                      <div class='mb-3 col-md-3'>\
                        <input type='number' class='nc_form_control' name='typeJeu"+nbTournois+"' id='typeJeu"+nbTournois+"' min='1' value='1'>\
                      </div>\
                      <div class='mb-3 col-md-3'>\
                        <input type='number' class='nc_form_control' name='frais"+nbTournois+"' id='frais"+nbTournois+"' min='0' value='0'>\
                      </div>\
                    </div>";
  $(this).before(newTournois);
  console.log("Champs Tournoi "+nbTournois+" ajouté !");
});

$("button#effacer").click(function (){
  document.forms[0].reset();
});
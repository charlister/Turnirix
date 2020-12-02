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

/*On impémente le même code pour les deux autres boutons*/

// Clic sur le bouton "Editer événément"
$("#editer").click(function (e) {
  $("#edition").toggle();
  console.log("Toggle effectué");
  console.log(e.target.getAttribute("id"));
  
  if (e.target.getAttribute("id") === "editer") {
    $("#creer").attr("disabled", true);
    $("#enregistrer").attr("disabled", true);
    $(e.target).attr({
      class : "btn btn-danger", 
      id : "annulerEdition" 
    });  
    $(e.target).text("Annuler édition"); 
  } 
  else {
    $("#creer").removeAttr("disabled");
    $("#enregistrer").removeAttr("disabled");
    $(e.target).attr({
      class : "btn btn-secondary",
      id : "editer"
    });  
    $(e.target).text("Editer événement");
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



// Clic sur le bouton "+" dans l'ajout d'équipe
$("button#ajouter").click(function () { 
  let nbPlayer = parseInt($("#nbPlayer").val())+1;
  $("#nbPlayer").attr("value", nbPlayer);
  let newPlayer = "<hr class='my-3'>\
                    <div class=''>\
                      <div class='mb-3'>\
                          <input type='text' id='joueur"+nbPlayer+"' name='joueur"+nbPlayer+"' class='nc_form_control' placeholder='Nom du joueur'>\
                      </div>\
                      <div class='mb-3'>\
                        <select id='niveau"+nbPlayer+"' name='niveau"+nbPlayer+"' class='nc_form_control'>\
                          <option>Pro</option>\
                          <option>Elite</option>\
                          <option>Régional</option>\
                          <option>Départemental</option>\
                          <option selected>Loisir</option>\
                        </select>\
                      </div>\
                    </div>";
  $(this).before(newPlayer);
  console.log("Champs J"+nbPlayer+" ajouté !");
});
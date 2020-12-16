/**
 *  \brief fonction implementant la technique de serpentin
 *  \param equipe : tableau en deux dimensions portant les noms des équipes
 *  \return tableau en deux dimensions 
*/
function serpentinBis(equipe) {
	let tabSerpentin = new Array();
	for (let i = 0; i < equipe.length; i++) {
		tabSerpentin.push(new Array());
		for (let j = 0; j < equipe[i].length; j++) {
			if(i%2==0)
                tabSerpentin[i].push(equipe[i][j]);
            else{
                if(j!=equipe[i].length-1)
                    tabSerpentin[i].push(equipe[i][j+1]);
                else
                    tabSerpentin[i].push(equipe[i][0]);
            }
		}
	}
	return tabSerpentin;
}

function serpentin(tablEq, nbPoules, nbEquipes) {
	let copie = new Array();
	for (let i = 0; i < tablEq.length; i++) {
		copie.push(tablEq[i]);
	}
	console.log("copie : ");
	console.log(copie);

	let equipe = new Array();
	for (let i = 0; i < nbEquipes; i++) {
		equipe.push(new Array());
		for (let j = 0; j < nbPoules; j++) {
			equipe[i].push(tablEq[i*nbPoules+j]);
		}
	}
	console.log("equipe : ");
	console.log(equipe);

	let tabSerpentin = serpentinBis(equipe);
	console.log("serpentin : ");
	console.log(tabSerpentin);

	for (let i = 0; i < nbPoules; i++) {
		for (let j = 0; j < nbEquipes; j++) {
			copie[i*nbEquipes+j] = tabSerpentin[j][i];
		}
	}

	return copie;
}

function combinaisons(ptrTuplesPoule, idPoule) { // pour des combinaisons et les marquer lorsque le match a été disputé (une aide en bref)
	let tmp = "<div class='aide my-5 table-responsive'>\
			<table class='table table-bordered table-striped'>\
			  <thead class='thead-light'>\
			    <tr>\
			      <th scope='col' class='text-center' colspan='3'>Combinaison de matchs</th>\
			      <th scope='col' class='text-center'>Terminé</th>\
			    </tr>\
			  </thead>\
			  <tbody>";

	for (let i = 0; i < ptrTuplesPoule.length-1; i++) {
		for (let j = i+1; j< ptrTuplesPoule.length; j++) {
			tmp += "<tr>\
					    <td class='text-center'>"+$(ptrTuplesPoule[i]).children("td:eq(1)").text()+"</td>\
					    <td class='text-center'>-</td>\
					    <td class='text-center'>"+$(ptrTuplesPoule[j]).children("td:eq(1)").text()+"</td>\
					    <td class='text-center'>"+"<input type='checkbox'></input>"+"</td>\
					</tr>";
		}
	}
	tmp += "</tbody></table></div>";
	$('div[id="'+idPoule+'"]').append(tmp);
}

function genererPoules(divPouleDuChoix, nbPoulesMin, nbPoulesMax, idTour, tablEq, nbEquipesMin, nbEquipesMax) {
	let indiceTablEq = 0;
	for (let i = 1; i <= nbPoulesMin+nbPoulesMax; i++) { // nombre de poules
		let idPoule = idTour+"_"+i;

		let tmp = "<div class='divTable my-5 table-responsive' id='"+idPoule+"'>\
				  <table class='table-sm tableEdit table-bordered table-striped table-hover'>\
				  <thead class='table-dark'>\
				    <tr>\
				      <th scope='col'>#</th>\
				      <th scope='col'>Equipes</th>\
				      <th scope='col'>MG</th>\
				      <th scope='col'>SG</th>\
				      <th scope='col'>SP</th>\
				      <th scope='col'>PG</th>\
				      <th scope='col'>PP</th>\
				    </tr>\
				  </thead>\
				  <tbody>"; /*pour chaque poule, on crée une feuille de match éditable dans un tableau
				  (un tableau de poule éditable)*/
		
		nbEquipes = (i<=nbPoulesMin ? nbEquipesMin : nbEquipesMax);
		for (let j = 1; j <= nbEquipes; j++) { // nombre d'équipes
			let idEquipe = idPoule+"_"+j;

			tmp += "<tr id='"+idEquipe+"'>";
			tmp += "<td><span class='rang'>"+j+"</span></td>\
					<td><span class='nomEquipe'>"+tablEq[indiceTablEq++]+"</span></td>\
					<td><input type='number' id='"+idEquipe+"_MG' name='"+idEquipe+"_MG' min='0' value='0'></td>\
					<td><input type='number' id='"+idEquipe+"_SG' name='"+idEquipe+"_SG' min='0' value='0'></td>\
					<td><input type='number' id='"+idEquipe+"_SP' name='"+idEquipe+"_SP' min='0' value='0'></td>\
					<td><input type='number' id='"+idEquipe+"_PG' name='"+idEquipe+"_PG' min='0' value='0'></td>\
					<td><input type='number' id='"+idEquipe+"_PP' name='"+idEquipe+"_PP' min='0' value='0'></td>\
					";
			tmp += "</tr>"; /*pour chaque équipe, on a un tuple de champs éditables*/
		}
		tmp += "</tbody></table></div>";

		divPouleDuChoix.append(tmp); // on insère ensuite ce tableau sous le bouton sélectionné.
		
		console.log($('div[id="'+idPoule+'"] table tbody tr').children("th:eq(1)").text());
		let ptrTuplesPoule = $('div[id="'+idPoule+'"] table tbody tr');
		combinaisons(ptrTuplesPoule, idPoule);/*affiche les combinaisons de matchs possible pour la poule désignée.*/
	}
	
}

function niveauComplet(niveau, effectif) { // fonction servant de callback à filter
	let r = 0;
	for (x of niveau) {
		r += x;
	}
	return r === effectif;
}

function resume(effectif) { // retourne un recapitulatif des niveaux complets
	let recap = null;
	let racine = new Noeud(effectif);
	racine.developperArbre();
	recap = racine
			.recapitulatifParNiveaux(recap, 0)
			.filter(niveau => niveauComplet(niveau, effectif));

	return recap;
}

/*
Après le choix d'une formule, cette fonction traite le texte contenue dans le bouton
et génère des poules.
*/
function choix(_this) {
	console.log(_this);
	_this.siblings().hide(); /*cacher les frères de l'élément sélectionné.*/
	console.log(_this.text());
	let selectButonTxt = _this.text(); //texte du bouton sélectionné
	let nbPoules = 0;
	let nbEquipes = 0;
	let nbPoulesMin = 0;
	let nbPoulesMax = 0;
	let nbEquipesMin = 0;
	let nbEquipesMax = 0;
	let splitPlus = selectButonTxt.split(" + ");
	if(splitPlus.length == 2) {
		let splitG = splitPlus[0].split(" x ");
		let splitD = splitPlus[1].split(" x ");
		nbPoulesMin = parseInt(splitG[0]);
		nbPoulesMax = parseInt(splitD[0]);
		nbEquipesMin = parseInt(splitG[1]);
		nbEquipesMax = parseInt(splitD[1]);
	}
	else {
		let splitFois = selectButonTxt.split(" x ");
		nbPoules = parseInt(splitFois[0]);
		nbEquipes = parseInt(splitFois[1]);
	}

	let nbQualif = (nbEquipes+nbEquipesMax)/2;

	_this.attr("disabled", "true");

	/*ajouter une div pour chaque poule contenant des div pour chaque équipe*/
	let divPouleDuChoix = _this.parent().siblings().last(".poule");//la division de class=poule proche du bloc du bouton sélectionné
	console.log(divPouleDuChoix);
	// console.log($(e.currentTarget.nextElementSibling).last(".poule"));
	let nomTournois = $("#nomTournois").val(); nomTournois = nomTournois.split(" ; ");//tableau avec nom des tournois
	let idTournoi = _this.parent().parent().parent().attr('id');
	console.log("idTournoi = "+idTournoi);
						
	let tablEq = $("#"+idTournoi+"ListeEq").val(); tablEq = tablEq.split(" ; ");
	tablEq = serpentin(tablEq, nbPoules+nbPoulesMin+nbPoulesMax, nbEquipes+nbEquipesMin);
	console.log(tablEq);

	let idNumTActuel = "#"+idTournoi+"NumTActuel";
	let numTour = $(idNumTActuel).val();
	console.log("numTour = "+numTour);
	let idTour = idTournoi+"_"+numTour;
	console.log("idTour = "+idTour);

	$("<small class='d-block text-right mt-3'>\
		<button type='button' class='cloturer btn btn-success' onclick='cloturer($(this), "+nbQualif+")'>Clôturer le tour</button>\
	</small>").insertAfter("#"+idTour); //ajoute le bouton qui permet de cloturer le tour après le choix d'une formule.

	if(nbPoules)
		genererPoules(divPouleDuChoix, nbPoules, 0, idTour, tablEq, nbEquipes, 0);
	else
		genererPoules(divPouleDuChoix, nbPoulesMin, nbPoulesMax, idTour, tablEq, nbEquipesMin, nbEquipesMax);
}

/*
Fonction qui propose des formules sportives
*/
function proposition(effectif, selection) { // propose des formules
	let id = selection.split(" .formule")[0].split("#")[1];
	effectif = parseInt(effectif);
	let recap = resume(effectif);
	let taille = recap.length;
	let tmp = 0;
	let formuleCree = new Array();
	$(selection).append("<span class='media text-muted small'>Choisir une formule <em>(nombre de poules x nombre d'équipes)</em></span><br>");
	for (let i = /*Math.trunc(taille/2)*/ 0; i < taille; i++) { // effectuer la proposition à partir du milieu du tableau récapitulatif de l'arbre généré
		let dico = new Map(); // exemple {'a':7, 'z':3, 'o':5} comme un dictionnaire en python...
		
		for(x of recap[i]) { // recap[i] stock les données d'un certains niveau
			/*si une valeur du tableau actuellement lu (noeud à un niveau de l'arbre) est présente dans le dictionnaire, 
			on l'incrémente ;
			sinon on l'initialise à 1.*/
			dico.set(x, (dico.has(x) ? dico.get(x)+1 : 1));  /*equipe, poule*/
		}

		let val = "";
		let tailleDico = dico.size;
		for (let [key, value] of dico) { // pour le dictionnaire obtenu de taille 1 ou deux, 
			if(tailleDico === 1) {
				if (value === 1 || value === key) {
					val = value+" x "+key;
					if (formuleCree.indexOf(val) === -1) {
						$(selection).append("<button type='button' id='bouton_"+id+"_"+tmp+"' onclick='choix($(this))' class='btn btn-warning'>"+val+"</button> ");
						tmp++;
						formuleCree.push(val);
					}
				}
				else {
					val = value+" x "+key;
					if (formuleCree.indexOf(val) === -1) {
						$(selection).append("<button type='button' id='bouton_"+id+"_"+tmp+"' onclick='choix($(this))' class='btn btn-warning'>"+val+"</button> ");
						tmp++;
						formuleCree.push(val);
					}
					val = key+" x "+value;
					if (formuleCree.indexOf(val) === -1) {
						$(selection).append("<button type='button' id='bouton_"+id+"_"+tmp+"' onclick='choix($(this))' class='btn btn-warning'>"+val+"</button> ");
						tmp++;
						formuleCree.push(val);
					}
				}
			}
			else {
				val += (val!=="" ? " + " : "")+value+" x "+key;
			}
		}
		if (tailleDico !== 1) {
			if (formuleCree.indexOf(val) === -1) {
				$(selection).append("<button type='button' id='bouton_"+id+"_"+tmp+"' onclick='choix($(this))' class='btn btn-warning'>"+val+"</button> ");
				tmp++;
				formuleCree.push(val);
			}
		}
	}
}

/*
tri par ordre décroissant de mérite
*/
function classement(resultats, nbQualif) { // pour classer les éléments d'un tableau par comparaison de colonnes
	resultats.sort(function (a, b) {
  		return b[1] - a[1];
	}); //tri sur le nombre de victoires

	if (resultats[nbQualif][1] == resultats[nbQualif-1][1]) {
		resultats.sort(function (a, b) {
	  		return b[2] - a[2];
		}); //tri sur le quotients des sets

		if (resultats[nbQualif][2] == resultats[nbQualif-1][2]) {
			resultats.sort(function (a, b) {
		  		return b[3] - a[3];
			}); //tri sur le quotients des points
		}
	}
}

/*
Fonction qui clôture un tour
en classant les équipes en tenant compte de l'ordre de : 
[index equipe, 
nombre de victoires, 
sets gagnés/sets perdus, 
points gagnés/points perdus]
et ouvre un autre tour.
*/
function cloturer(_this, nbQualif) {
	nbQualif = parseInt(nbQualif);
	console.log("nombre de qualifiés par poules = "+nbQualif);

	let divACloturer = _this.closest("div");
	console.log(divACloturer);

	if (divACloturer.find(".divTable").length) { //si la div possède la class divTable (utilisée pour stocker les tableaux de poule)
		console.log(divACloturer.find(".divTable").length);
		console.log(divACloturer.children().find(".poule:last .divTable").length);
		_this.closest("small").siblings("div:last").children(".formule").remove(); //supprimer la précédente div de formule
		_this.closest("small").siblings("div").children(".poule").children().children(".aide").remove(); // pour supprimer le tableau de combianisons après clôture du tour.
		_this.closest("small").remove();


		let qualifies = new Array();

		console.log(divACloturer.find(".divTable"));
		for(let divTable of divACloturer.find(".divTable:not('.vu')")) { //pour chacune de ces divTable
			console.log($(divTable));
			$(divTable).addClass("vu");//les tables vu ne le seront plus

			let tableEdit = $(divTable).find(".tableEdit");
			let resultats = new Array();
			let i = 0;

			/*l'idP (identifiant de la poule) est à mettre à jour pour chaque div poule*/
			let idP = parseInt($("#idP").val());
			$("#idP").val(idP+1);

			for(let row of $(tableEdit).find("tbody tr")) { //et à chaque ligne de cette table (autrement dit, pour chaque équipe).
				console.log($(row));

				let sg = 0, sp = 0, pg = 0, pp = 0;
				let cellId = 2;
				console.log($(row).attr("id"));
				let idEquipe = $(row).attr("id");

				resultats.push(new Array());

				for (let data of $(row).find("input")) {
					console.log($(data));

					switch (cellId) {
						case 2:
							resultats[i].push(idEquipe); //id de l'équipe
							resultats[i].push(parseInt($(data).val()));
							break;
						case 3:
							sg = parseInt($(data).val());
							break;
						case 4:
							sp = parseInt($(data).val());
							resultats[i].push(sg/(sp ? sp : 1)); //car la division par 0 est interdite
							sg = 0;
							sp = 0;
							break;
						case 5:
							pg = parseInt($(data).val());
							break;
						case 6:
							pp = parseInt($(data).val());
							resultats[i].push(pg/(pp ? pp : 1));
							pg = 0;
							pp = 0;
							break;
						default:
							console.log("Erreur de calcul ?");
							break;
					}
					$(data).attr("disabled", "true");
					cellId++;
				}
				i++;
			}

			classement(resultats, nbQualif);
			console.log(resultats); 
			/*résultats obtenues pour chaque équipes 
			[index equipe, nombre de victoires, sets gagnés/sets perdus, points gagnés/points perdus]
			classées par nombre de victoires ou sets ou points*/

			/*Déplacement des meilleurs équipes en tête de chaque poule*/
			$("#"+resultats[0][0]).insertBefore("#"+resultats[1][0]);
			for (let a = 1; a < resultats.length-1; a++) {
				$("#"+resultats[a+1][0]).insertAfter("#"+resultats[a][0]);
			}
				
			for (let a = 0; a < resultats.length; a++) { /*mise à jour du span de class rang*/
				$("#"+resultats[a][0]+" .rang").text(a+1); 
				
				if (a<nbQualif) {
					qualifies.push($("#"+resultats[a][0]+" .nomEquipe").text()); //nomEq
					$("#"+resultats[a][0]).addClass("table-success");
				}
				else {
					$("#"+resultats[a][0]).addClass("table-danger");
				}
			}

			for (let a = 0; a < resultats.length; a++) {
				let newRepartir = (
					$("#"+resultats[a][0]+" .nomEquipe").text()+","+/*nomEq*/
					divACloturer.attr("id")+","+/*nomT*/
					$("#dateT").val()+","+/*dateT*/
					$("#lieuT").val()+","+/*lieuT*/
					$("#idP").val()+","+/*idP*/
					(a+1))/*rang*/;
				console.log("nexRepartir = "+newRepartir);
				let oldRepartir = $("#repartir").val();
				$("#repartir").val((oldRepartir==="" ? "" : (oldRepartir+";"))+newRepartir);
			}
			let newPoule = 
			$("#idP").val()+","+/*idP*/
			$("#"+divACloturer.attr("id")+"NumTActuel").val()+","+/*tour*/
			resultats.length/*nombreEq*/;
			console.log("newPoule = "+newPoule);
			let oldPoule = $("#poule").val();
			$("#poule").val((oldPoule==="" ? "" : (oldPoule+";"))+newPoule);
		}
		
		/*Liste des équipes qualifiés formatée dans un champs texte*/
		console.log("old : \nListe equipes : "+$("#"+divACloturer.attr("id")+"ListeEq").val());
		let formatage = qualifies.join(" ; ");
		$("#"+divACloturer.attr("id")+"ListeEq").val(formatage);
		console.log("new : \nListe equipes : "+$("#"+divACloturer.attr("id")+"ListeEq").val());

		/*Le nombre d'équipe qualifiées pour le prochain tour.*/
		console.log("old : \nnb equipes : "+$("#"+divACloturer.attr("id")+"NbEqActuel").val());
		$("#"+divACloturer.attr("id")+"NbEqActuel").val(qualifies.length);
		console.log("new : \nnb equipes : "+$("#"+divACloturer.attr("id")+"NbEqActuel").val());
		
		/*S'il n'y a lpus de formules ou plus de boutons de clôture de tour, on peut suggérer la fermeture de l'événement*/
		if (qualifies.length === 1) { 
			if (!$(".formule").length && !$(".cloturer").length) {
				$("form").append("\
					<button type='submit' class='cloturerEvent btn btn-success' name='sauvegarderE'>Sauvegarder</button>\
					");
			}
			return;
		} //Fin s'il reste seulement une équipe.

		/*Le numéro du tour en fonction du tournois*/
		console.log("old : \nNom tournoi : "+divACloturer.attr("id")+"\nNuméro tour actuel : "+$("#"+divACloturer.attr("id")+"NumTActuel").val());
		let newNumber = parseInt($("#"+divACloturer.attr("id")+"NumTActuel").val())+1;
		$("#"+divACloturer.attr("id")+"NumTActuel").val(newNumber);
		console.log("new : \nNom tournoi : "+divACloturer.attr("id")+"\nNuméro tour actuel : "+$("#"+divACloturer.attr("id")+"NumTActuel").val());

		divACloturer.append("\
			<div id='"+divACloturer.attr("id")+"_"+newNumber+"'>\
				<div class='media text-muted pt-3'>\
				    <p class='media-body pb-3 mb-0 small lh-125'>\
				    	<strong class='d-block text-gray-dark'>Tour "+newNumber+"</strong>\
				    </p>\
				</div>\
				<div class='formule'>\
					<script type='text/javascript'>\
						proposition("+qualifies.length+", '#"+divACloturer.attr("id")+" .formule');\
					</script>\
				</div>\
				<div class='poule'></div>\
			</div>"); // ajout d'une division pour le nouveau tour identifié par : nom du tournois_numéro du tour
	}
	else {
		console.log("Sorry ! Mais nada à montrer");
	}
}
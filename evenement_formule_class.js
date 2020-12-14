class Noeud { 
	constructor(val) { // constructeur à partir du nombre d'équipes
		this.val = val; // valeur du Noeud
		this.fg = null; // fils gauche
		this.fd = null; // fils droit
	}

	ajouter(v1, v2) { // ajout de nouveaux groupes = un noeud
		this.fg = new Noeud(v1); // ajout fils gauche
		this.fd = new Noeud(v2); // ajout fils droit
	}

	parcoursPrefixe() { // affichage de l'arbre à partir d'un parocurs préfixe
		if (this === null) 
			return;
		console.log(this.val);

		if(this.fg !== null)
			this.fg.parcoursPrefixe();
		if(this.fd !== null)
			this.fd.parcoursPrefixe();
	}

	developperArbre() { // développement de l'arbre à partir du nombre total d'équipe pour en déduire une ou plusieurs formules
		if (this !== null) {
			let vfd, vfg;
			if (this.val/2 >= 2) { 
				vfg = Math.trunc(this.val/2);
				vfd = (vfg*2 === this.val ? vfg : vfg+1);
				this.ajouter(vfg, vfd);

				this.fg.developperArbre();
				this.fd.developperArbre();
			}
		}
	}

	nombreNiveau() { // la racine se trouve au niveau 0;
		let ptr = this;
		let cpt = 0;
		while(ptr.fd !== null) {
			cpt++;
			ptr = ptr.fd;
		}
		return cpt;
	}

	recapitulatifParNiveaux (recap, niveau) { // un récapitulatif des niveaux de l'arbre
		if(recap === null) {
			recap = new Array();
			for (let i = 0; i <= this.nombreNiveau(); i++) {
				recap.push(new Array());
			}
		}
		recap[niveau].push(this.val);
		// console.log("niveau : "+niveau+" ; valeur : "+this.val);

		if(this.fg !== null)
			this.fg.recapitulatifParNiveaux(recap, niveau+1);
		if(this.fd !== null)
			this.fd.recapitulatifParNiveaux(recap, niveau+1);

		return recap;
	}
}
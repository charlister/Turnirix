/**
 *  \class Noeud  
 *  \brief classe servant à générer un ensemble de formules sportives par niveau
*/
class Noeud { 
	/** 
     *  \constructor
	 *  \brief constructeur de la classe
	 *  \param val : entier représentant le nombre totale d'équipes
	*/
	constructor(val) { 
		this.val = val; // valeur du Noeud
		this.fg = null; // fils gauche
		this.fd = null; // fils droit
	}

	/** 
	 *  \method
	 *  \brief methode servant à ajouter un partage du noeud précédent en deux
	 *  \param v1 : première moitiée de la valeur du noeud précédent
	 *  \param v2 : seconde moitiée de la valeur du noeud précédent
	*/
	ajouter(v1, v2) { // ajout de nouveaux groupes = un noeud
		this.fg = new Noeud(v1); // ajout fils gauche
		this.fd = new Noeud(v2); // ajout fils droit
	}

	/** 
     *  \method
     *  \brief methode servant à développer l'arbre à partir du nombre total d'équipes pour en déduire une ou plusieurs formules
     */
	developperArbre() {
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

	/** 
     *  \method
     *  \brief methode servant à compter les niveaux de l'arbre
     *  \return un entier indiquant le nombre de niveaux
     */
	nombreNiveau() { // la racine se trouve au niveau 0;
		let ptr = this;
		let cpt = 0;
		while(ptr.fd !== null) {
			cpt++;
			ptr = ptr.fd;
		}
		return cpt;
	}

	/** 
     *  \method
     *  \brief methode servant à faire un recapitulatif de l'arbre dans un tableau de deux dimensions
     *  \param recap : tableau à retourner
     *  \param niveau : le nombre de niveaux
     *  \return tableau à deux dimensions incluant le nombre de poules et le nombre d'équipes possible
     */
	recapitulatifParNiveaux (recap, niveau) {
		if(recap === null) {
			recap = new Array();
			for (let i = 0; i <= this.nombreNiveau(); i++) {
				recap.push(new Array());
			}
		}
		recap[niveau].push(this.val);

		if(this.fg !== null)
			this.fg.recapitulatifParNiveaux(recap, niveau+1);
		if(this.fd !== null)
			this.fd.recapitulatifParNiveaux(recap, niveau+1);

		return recap;
	}
}
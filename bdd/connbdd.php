<?php
	
	/** 
	 *  \class ConnBdd
	 *  \brief classe qui sert à se connecter à la base de données 
	 */
  	class ConnBdd {
	    private $host = 'localhost'; 
	    private $name = 'turnirix'; // nom de la base de données
	    private $user = 'root';
	    private $pass = '';       
	    private $conn = null;
    
    	/** 
    	 *  \constructor
	     *  \brief constructeur qui sert à créer un objet de connexion à la base 
	     */
	    function __construct(){
	      	try{
	        	$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	      	}
	      	catch (PDOException $e){
		        echo 'Erreur : Impossible de se connecter à la base de données !';
		        die();
	      	}
	    }

	    /** 
	     *  \method
	     *  \brief methode servant à executer une requête
	     *  \param $sql : un format de requête
	     *  \param $data : tableau de données nécessaires pour completer une requête preparée
	     *  \return le resultat de la requête
	     */
	    public function query($sql, $data = array()){ 
		    $requete = $this->conn->prepare($sql);
		    $requete->execute($data);
		    return $requete;
	    }
  	}

  	$bdd = new ConnBdd();
?>
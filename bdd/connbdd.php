<?php
  	class ConnBdd {
	    private $host = 'localhost'; 
	    private $name = 'turnirix'; // nom de la base de données
	    private $user = 'root';
	    private $pass = '';       
	    private $conn = null;
    
	    function __construct(){
	      	try{
	        	$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->name, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	      	}
	      	catch (PDOException $e){
		        echo 'Erreur : Impossible de se connecter à la base de données !';
		        die();
	      	}
	    }

	    public function query($sql, $data = array()){
		    $requete = $this->conn->prepare($sql);
		    $requete->execute($data);
		    return $requete;
	    }
	    
	    public function register($sql, $data = array()){
	      	$requete = $this->conn->prepare($sql);
	      	$requete->execute($data);
	      	return $requete;
	    }
  	}

  	$bdd = new ConnBdd();
?>
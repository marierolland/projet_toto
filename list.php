<?php
//je cree PDO j inclus base de donnees
require 'inc/db.php';

//print_r($_GET);
//recup le ses_id via GET
if(!empty($_GET['ses_id'])){
	$sessionID = intval($_GET['ses_id']);// type?
	
	//nb d etudiants par page
	$nbPerPage = 5;
	$currentOffset= 0;
	
	if(array_key_exists('offset', $_GET)){ // equivaut a isset($_GET['offset']);
	$currentOffset = intval($_GET['offset']);
	}


	$sql='
		SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, 
		stu_birthdate AS birthdate 
		FROM student
		LEFT OUTER JOIN country ON country.cou_id = student.cou_id
		LEFT OUTER JOIN city ON city.cit_id = student.cit_id
		LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
		WHERE ses_id = :sesID
		LIMIT :offset,:nbPerPage
	';
	// 0 pour index 0, 5 donc 5 pers. c est equivalent a LIMIT 5 OFFSET 0


	$pdoStatement = $pdo->prepare($sql);
	//je donne la valeur au parametre de requete
	//bindValue
	$pdoStatement->bindValue(':sesID', $sessionID, PDO::PARAM_INT);
	//par defaut un bindValue est STRING
	$pdoStatement->bindValue(':nbPerPage', $nbPerPage, PDO::PARAM_INT);
	// pour passer a la suivante
	$pdoStatement->bindValue(':offset', $currentOffset, PDO::PARAM_INT);

	//si erreur
	if ($pdoStatement ->execute() === false){
		print_r($pdo->errorInfo());

	}
	else if ($pdoStatement->rowCount()>0){
		$etudiantListe= $pdoStatement->fetchAll();
		
	}
}


//j inclus header, puis sa propre view, et footer
require 'inc/header.php';
require 'inc/list_view.php';
require 'inc/footer.php';
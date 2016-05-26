<?php

//je cree PDO j inclus base de donnees
require 'inc/db.php';
	print_r($_GET);
	
	$nbPerPage = 5;
	$currentOffset= 0;
	
	if(array_key_exists('offset', $_GET)){ // equivaut a isset($_GET['offset']);
	$currentOffset = intval($_GET['offset']);
	}
//je recup via GET
if(!empty($_GET['search'])){

$etudiantListe = array(); //variable a remplir

$research =$_GET['search'];
//code pour la recherche

//requete

	$sql = '
			SELECT
			  stu_id,
			  stu_name,
			  stu_firstname,
			  cou_name,
			  cit_name,
			  mar_name,
			  stu_email,
			  stu_birthdate AS birthdate
			FROM
			  student
			LEFT OUTER JOIN
			  country ON country.cou_id = student.cou_id
			LEFT OUTER JOIN
			  city ON city.cit_id = student.cit_id
			LEFT OUTER JOIN
			  marital_status ON marital_status.mar_id = student.mar_id
			WHERE
			  stu_name LIKE :rech
			  OR stu_firstname LIKE :rech
			  OR cou_name LIKE :rech
			  OR cit_name LIKE :rech
			  OR mar_name LIKE :rech
			  OR stu_email LIKE :rech
			';

$pdoStatement = $pdo->prepare($sql);
$pdoStatement->bindValue(':rech',"%$research%" );
 
if ($pdoStatement ->execute() === false){

print_r($pdo->errorInfo());
}

else if ($pdoStatement->rowCount()>0){
	$etudiantListe= $pdoStatement->fetchAll();
	print_r($etudiantListe);
}

}




//j inclus header, puis sa propre view, et footer
require 'inc/header.php';
require 'inc/list_view.php';
require 'inc/footer.php';
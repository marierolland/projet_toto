<?php
//je FACTORISE!
//je cree PDO j inclus DB
require 'inc/db.php';

// Gestion du POST
$errorList = array();
// Si le formulaire a été soumis
if (!empty($_POST)) {
	// Je récupère tous les champs du formulaires
	// si isset($_POST['studentName']) == true alors récupère la valeur de $_POST['studentName'], sinon, la valeur ''
	$name = isset($_POST['studentName']) ? $_POST['studentName'] : '';
	/*équivalent à
	if (isset($_POST['studentName'])) {
		$name = $_POST['studentName'];
	}
	else {
		$name = '';
	}*/
	print_r($_POST);

	$firstname = isset($_POST['studentFirstname']) ? $_POST['studentFirstname'] : '';
	$email = isset($_POST['studentEmail']) ? $_POST['studentEmail'] : '';
	$birthdate = isset($_POST['studentBirhtdate']) ? $_POST['studentBirhtdate'] : '';
	$cityID = isset($_POST['cit_id']) ? intval($_POST['cit_id']) : 0;
	$countryID = isset($_POST['cou_id']) ? intval($_POST['cou_id']) : 0;
	$maritalID = isset($_POST['mar_id']) ? intval($_POST['mar_id']) : 0;
	$sessionID = isset($_POST['ses_id']) ? intval($_POST['ses_id']) : 0;

	if (empty($name)) {
		$errorList[] = 'Le nom est vide';
	}
	if (empty($firstname)) {
		$errorList[] = 'Le prénom est vide';
	}
	if (empty($email)) {
		$errorList[] = 'L\'email est vide';
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errorList[] = 'L\'email est incorrect';
	}
	if (empty($birthdate)) {
		$errorList[] = 'La date de naissance est vide';
	}
	if (empty($cityID)) {
		$errorList[] = 'La ville est manquante';
	}
	if (empty($countryID)) {
		$errorList[] = 'La nationalité est manquante';
	}
	if (empty($maritalID)) {
		$errorList[] = 'Le statut est manquant';
	}
	if (empty($sessionID)) {
		$errorList[] = 'La session est manquante';
	}

	if (empty($errorList)) {
		$sql = '
			INSERT INTO student 
			(stu_name, stu_firstname, stu_email, cit_id, cou_id, stu_birthdate, ses_id, mar_id)
			VALUES 
			( :name, :firstname, :email, :city, :country, :birthdate, :session, :mar );
		';
		
		//je donne la valeur au parametre de requete
		$pdoStatement = $pdo->prepare($sql);
		//bindValue
		$pdoStatement->bindValue(':name', $name);
		$pdoStatement->bindValue(':firstname', $firstname);
		$pdoStatement->bindValue(':email', $email);
		$pdoStatement->bindValue(':city', $cityID,PDO::PARAM_INT);
		$pdoStatement->bindValue(':country', $countryID,PDO::PARAM_INT);
		$pdoStatement->bindValue(':birthdate', $birthdate,PDO::PARAM_INT);
		$pdoStatement->bindValue(':session', $sessionID,PDO::PARAM_INT);
		$pdoStatement->bindValue(':mar', $maritalID,PDO::PARAM_INT);
		//si erreur
		if ($pdoStatement->execute() === false){
			print_r($pdo->errorInfo());
		}
		else if ($pdoStatement->rowCount()>0){
			echo 'je peux insérer en DB<br />';
			//print_r($etudiantInfos);
		}
		else{
			echo('toto');
		}
	}
}
else{
	print_r($errorList);
}	
// Sinon, afficher le contenu du tableau $errorList dans view.php
//fin du POST

$etudiantListe = array();
$citiesList = array(
	1 => 'Luxembourg',
	2 => 'Longwy',
	3 => 'Esch-sur-Alzette',
	4 => 'Verdun',
	5 => 'Arlon',
	6 => 'Leudelange',
	7 => 'Pissange',
);
$countriesList = array(
	1 => 'France',
	2 => 'Luxembourg',
	3 => 'Belgique',
	4 => 'Chine',
	6 => 'Allemagne',
);
$maritalStatusList = array(
	1 => 'Célibataire',
	2 => 'Marié(e)',
	3 => 'Divorcé(e)',
	4 => 'Veuf/veuve',
);
$sessionList = array(
	1 => '1',
	2 => '2',
	3 => '3',
);

/*
QUERY pour les students
-----------------------
SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name
FROM student
LEFT OUTER JOIN country ON country.cou_id = student.cou_id
LEFT OUTER JOIN city ON city.cit_id = student.cit_id
LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
*/

$sql='
	SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, 
	stu_birthdate AS birthdate 
	FROM student
	LEFT OUTER JOIN country ON country.cou_id = student.cou_id
	LEFT OUTER JOIN city ON city.cit_id = student.cit_id
	LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
';

$pdoStatement = $pdo->query($sql);

if ($pdoStatement === false){
	print_r($pdo->errorInfo());
}
else if ($pdoStatement->rowCount()>0){
	$etudiantListe= $pdoStatement->fetchAll();
}

/*dans student.php, récupérer & valider les données venant du formulaire en POST (tous les champs sont obligatoires)
	* si les données sont valides, rediriger vers student.php
	* si non valide, afficher quelles données sont erronées
*/

	//inclus header puis sa view puis footer
require 'inc/header.php';
require 'inc/add_view.php';
require 'inc/footer.php';
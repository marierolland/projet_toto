<?php

//je FACTORISE!
//je cree PDO j inclus DB
require 'inc/db.php';

//print_r($_GET);
//recup le ses_id via GET
if(!empty($_GET['stu_id'])){
	$studentID = intval($_GET['stu_id']);// type?

// j ecris requete

	$sql = '
		SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, 
			stu_sex, stu_with_experience, stu_is_leader, stu_birthdate AS birthdate 
			FROM student
			LEFT OUTER JOIN country ON country.cou_id = student.cou_id
			LEFT OUTER JOIN city ON city.cit_id = student.cit_id
			LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
			WHERE stu_id = :stuID
	';

	
	$pdoStatement = $pdo->prepare($sql);
	//je donne la valeur au parametre de requete
	//bindValue
	$pdoStatement->bindValue(':stuID', $studentID, PDO::PARAM_INT);
	//par defaut un bindValue est STRING

	//si erreur
	if ($pdoStatement ->execute() === false){
		print_r($pdo->errorInfo());

	}
	else if ($pdoStatement->rowCount()>0){
		$etudiantInfos= $pdoStatement->fetchAll();
		//print_r($etudiantInfos);

	}
}


//inclut automatiquement tous les packages de composer
require_once __DIR__.'/vendor/autoload.php';

// creation d une fonction spec facon 1
$maDateFromDb = $etudiantInfos[0]['birthdate'];
//$jour = $maDateFromDb[8].[9];
//$mois = $maDateFromDb[5].[6];
//facon 2
$jour = intval(substr($maDateFromDb, 8, 2)); // 2 parce qu a partir de 8 tu prends 2 chiffres
$mois = intval(substr($maDateFromDb, 5, 2));// 2 a partir de 5


use Whatsma\ZodiacSign;

$calculator = new ZodiacSign\Calculator();

try {
	$zodiacSign = $calculator->calculate($jour,$mois);
	//echo $zodiacSign . "\n";
	} 
catch (ZodiacSign\InvalidDayException $e) {
	echo "ERROR: Invalid Day";
} 
catch (ZodiacSign\InvalidMonthException $e) {
	echo "ERROR: Invalid Month";
}

// ajout zodiac
$traductionFr = array(
	
	'capricorn'=> 'capricorne',
	'aquarius'=> 'verseau',
	'pisces'=> 'poisson',
	'aries' => 'bélier',
	'taurus'=> 'taureau',
	'gemini'=> 'gémeaux',
	'cancer'=> 'cancer',
	'leo'=> 'lion',
	'virgo'=> 'vierge',
	'libra'=> 'balance',
	'scorpio'=> 'scorpion',
	'sagittarius'=> 'sagittaire',

	);
//echo $traductionFr[$zodiacSign]; 

//inclus header puis sa view puis footer
require 'inc/header.php';
require 'inc/student_view.php';
require 'inc/footer.php';

?>
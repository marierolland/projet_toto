<?php

//je FACTORISE!
//je cree PDO j inclus DB
require 'inc/db.php';

//j ecris requete
$sql = '
		SELECT ses_opening, ses_ending, ses_id
	    FROM session

	';

// comme il n y a pas de parametre d url pas besoin de faire un prepare on fait query
$pdoStatement =$pdo->query($sql);

//si erreur
if ($pdoStatement===false){
	print_r($pdo->errorInfo());
}
	//sinon
else{
	// recup des donnees
	$sessionList = $pdoStatement->fetchAll();
	echo '<pre>';
	//print_r($sessionList);
	echo '</pre>';
}

$nbEtudiants= array();
$nbStudent= 0;

$sql=  '
	SELECT COUNT(stu_id) AS nbStudent,
	 city.cit_name
	FROM
	  student
	INNER JOIN
	  city ON city.cit_id = student.cit_id
	GROUP BY
	  cit_name

	';

$pdoStatement=$pdo->query($sql);

if($pdoStatement === false){
print_r($pdo->errorInfo());
}
else if ($pdoStatement->rowCount()>0){
$nbEtudiants= $pdoStatement->fetchAll();
print_r($nbEtudiants);
}

//inclus header puis sa view puis footer
require 'inc/header.php';
require 'inc/index_view.php';
require 'inc/footer.php';

?>

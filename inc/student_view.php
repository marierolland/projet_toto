
<h3>Informations étudiants</h3>

<?php foreach ($etudiantInfos as $currentEtudiant) : ?>
	<ul>
	
		<li>Le nom de l'étudiant est : <?= $currentEtudiant['stu_name'] ?></li>
		<li>Le prénom de l'étudiant est : <?= $currentEtudiant['stu_firstname'] ?></li>
		<li> l'email de l étudiant est : <?= $currentEtudiant['stu_email'] ?></li>
		<li>Il habite : <?= $currentEtudiant['cit_name'] ?></li>
		<li>Le pays duquel il est originaire est : <?= $currentEtudiant['cou_name'] ?></li>
		<li>L'étudiant est : <?= $currentEtudiant['mar_name'] ?></li>
		<li>Il est soit-disant né le : <?= $currentEtudiant['birthdate'] ?></li>
		<li>Son signe astrologique est donc : <?=$traductionFr[$zodiacSign]?></li>
		<li>L'étudiant est de sexe : <?= $currentEtudiant['stu_sex'] ?></li>
		<li>L'étudiant a-t-il de l expérience en IT? : <?= $currentEtudiant['stu_with_experience'] ?></li>
		<li>L'étudiant est-il leader? : <?= $currentEtudiant['stu_is_leader'] ?></li>

	</ul>

<?php endforeach; ?>

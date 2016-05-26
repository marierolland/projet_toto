
<h3>Sessions à Esch-Belval</h3>

<ul>
<?php foreach ($sessionList as $key => $value): ?>
	<li>
		<a href ="list.php?ses_id=<?= $value['ses_id'] ?>"> du <?= $value['ses_opening'] ?> au <?= $value['ses_ending'] ?> </a>
	</li>
<?php endforeach ?>
</ul>
<br/><br/><br/>

<h3>Nombres d'étudiants par ville</h3>

<table>
	<thead>
		<td>Villes</td>
		<td>Nombre étudiants</td>
	</thead>

	<tbody>
		<?php foreach ($nbEtudiants as $key => $value): ?>
			<tr>
				<td><?=$value['cit_name']?></td>
				<td><?=$value['nbStudent']?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

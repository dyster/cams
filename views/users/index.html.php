<table>
	<thead>
		<tr>
			<th>Användarnamn</th><th>Namn</th><th>Företag</th>
		</tr>
	</thead>
<?php foreach ($users as $user) 
{ ?>
	<tr>
    <td><?=$user->username; ?></td><td><?=$user->fullname; ?></td><td><?=$user->getOwner()->short; ?></td><td><?=$this->html->link('Ändra', "/users/edit/{$user->id}");?></td><td><?=$this->html->link('Ändra Lösenord', "/users/password/{$user->id}");?></td>
    </tr>
<?php } ?>
</table>

<table>
<?php foreach ($users as $user) 
{ ?>
	<tr>
    <td><?=$user->username; ?></td><td><?=$this->html->link('Ändra', "users/edit/{$user->id}");?></td><td><?=$this->html->link('Ändra Lösenord', "users/password/{$user->id}");?></td>
    </tr>
<?php } ?>
</table>

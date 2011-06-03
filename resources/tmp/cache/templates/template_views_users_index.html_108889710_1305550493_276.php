<table>
<?php foreach ($users as $user) 
{ ?>
	<tr>
    <td><?php echo $h($user->username); ?></td><td><?php echo $this->html->link('Ändra', "users/edit/{$user->id}"); ?></td><td><?php echo $this->html->link('Ändra Lösenord', "users/password/{$user->id}"); ?></td>
    </tr>
<?php } ?>
</table>

<?php echo $this->form->create($wheeldim); ?>
<table>
<thead>
	<th>*</th><th>1V</th><th>1H</th><th>2V</th><th>2H</th><th>3V</th><th>3H</th><th>4V</th><th>4H</th><th>5V</th><th>5H</th><th>6V</th><th>6H</th>
</thead>
<tr>
	<th>A</th>
	<td><?php echo $this->form->text('LA1'); ?></td>
	<td><?php echo $this->form->text('RA1'); ?></td>
	<td><?php echo $this->form->text('LA2'); ?></td>
	<td><?php echo $this->form->text('RA2'); ?></td>
	<td><?php echo $this->form->text('LA3'); ?></td>
	<td><?php echo $this->form->text('RA3'); ?></td>
	<td><?php echo $this->form->text('LA4'); ?></td>
	<td><?php echo $this->form->text('RA4'); ?></td>
	<td><?php echo $this->form->text('LA5'); ?></td>
	<td><?php echo $this->form->text('RA5'); ?></td>
	<td><?php echo $this->form->text('LA6'); ?></td>
	<td><?php echo $this->form->text('RA6'); ?></td>
</tr>
<tr>
	<th>B</th>
	<td><?php echo $this->form->text('LB1'); ?></td>
	<td><?php echo $this->form->text('RB1'); ?></td>
	<td><?php echo $this->form->text('LB2'); ?></td>
	<td><?php echo $this->form->text('RB2'); ?></td>
	<td><?php echo $this->form->text('LB3'); ?></td>
	<td><?php echo $this->form->text('RB3'); ?></td>
	<td><?php echo $this->form->text('LB4'); ?></td>
	<td><?php echo $this->form->text('RB4'); ?></td>
	<td><?php echo $this->form->text('LB5'); ?></td>
	<td><?php echo $this->form->text('RB5'); ?></td>
	<td><?php echo $this->form->text('LB6'); ?></td>
	<td><?php echo $this->form->text('RB6'); ?></td>
</tr>
<tr>
	<th>C</th>
	<td><?php echo $this->form->text('LC1'); ?></td>
	<td><?php echo $this->form->text('RC1'); ?></td>
	<td><?php echo $this->form->text('LC2'); ?></td>
	<td><?php echo $this->form->text('RC2'); ?></td>
	<td><?php echo $this->form->text('LC3'); ?></td>
	<td><?php echo $this->form->text('RC3'); ?></td>
	<td><?php echo $this->form->text('LC4'); ?></td>
	<td><?php echo $this->form->text('RC4'); ?></td>
	<td><?php echo $this->form->text('LC5'); ?></td>
	<td><?php echo $this->form->text('RC5'); ?></td>
	<td><?php echo $this->form->text('LC6'); ?></td>
	<td><?php echo $this->form->text('RC6'); ?></td>
</tr>
<tr>
	<th>D</th>
	<td><?php echo $this->form->text('LD1'); ?></td>
	<td><?php echo $this->form->text('RD1'); ?></td>
	<td><?php echo $this->form->text('LD2'); ?></td>
	<td><?php echo $this->form->text('RD2'); ?></td>
	<td><?php echo $this->form->text('LD3'); ?></td>
	<td><?php echo $this->form->text('RD3'); ?></td>
	<td><?php echo $this->form->text('LD4'); ?></td>
	<td><?php echo $this->form->text('RD4'); ?></td>
	<td><?php echo $this->form->text('LD5'); ?></td>
	<td><?php echo $this->form->text('RD5'); ?></td>
	<td><?php echo $this->form->text('LD6'); ?></td>
	<td><?php echo $this->form->text('RD6'); ?></td>
</tr>
</table>
<?php echo $this->form->submit('Lägg till'); ?>
<?php echo $this->form->end(); ?>
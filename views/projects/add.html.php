<?php 
use cams\models\Projects; 
use lithium\security\Auth;
?>

<?php
/*
$objArr[0] = "Nej";
foreach($objects as $o)
{
	$objArr[$o->id] = $o->getType()->name . " " . $o->name;
}

foreach($owners as $o)
{
	$ownArr[$o->id] = $o->name;
}
$ownArr[0] = "Nej";

 */

$temp = array('AliceBlue',
'AntiqueWhite',
'Aqua',
'Aquamarine',
'Azure',
'Beige',
'Bisque',
'Black',
'BlanchedAlmond',
'Blue',
'BlueViolet',
'Brown',
'BurlyWood',
'CadetBlue',
'Chartreuse',
'Chocolate',
'Coral',
'CornflowerBlue',
'Cornsilk',
'Crimson',
'Cyan',
'DarkBlue',
'DarkCyan',
'DarkGoldenRod',
'DarkGray',
'DarkGrey',
'DarkGreen',
'DarkKhaki',
'DarkMagenta',
'DarkOliveGreen',
'Darkorange',
'DarkOrchid',
'DarkRed',
'DarkSalmon',
'DarkSeaGreen',
'DarkSlateBlue',
'DarkSlateGray',
'DarkSlateGrey',
'DarkTurquoise',
'DarkViolet',
'DeepPink',
'DeepSkyBlue',
'DimGray',
'DimGrey',
'DodgerBlue',
'FireBrick',
'FloralWhite',
'ForestGreen',
'Fuchsia',
'Gainsboro',
'GhostWhite',
'Gold',
'GoldenRod',
'Gray',
'Grey',
'Green',
'GreenYellow',
'HoneyDew',
'HotPink',
'IndianRed',
'Indigo',
'Ivory',
'Khaki',
'Lavender',
'LavenderBlush',
'LawnGreen',
'LemonChiffon',
'LightBlue',
'LightCoral',
'LightCyan',
'LightGoldenRodYellow',
'LightGray',
'LightGrey',
'LightGreen',
'LightPink',
'LightSalmon',
'LightSeaGreen',
'LightSkyBlue',
'LightSlateGray',
'LightSlateGrey',
'LightSteelBlue',
'LightYellow',
'Lime',
'LimeGreen',
'Linen',
'Magenta',
'Maroon',
'MediumAquaMarine',
'MediumBlue',
'MediumOrchid',
'MediumPurple',
'MediumSeaGreen',
'MediumSlateBlue',
'MediumSpringGreen',
'MediumTurquoise',
'MediumVioletRed',
'MidnightBlue',
'MintCream',
'MistyRose',
'Moccasin',
'NavajoWhite',
'Navy',
'OldLace',
'Olive',
'OliveDrab',
'Orange',
'OrangeRed',
'Orchid',
'PaleGoldenRod',
'PaleGreen',
'PaleTurquoise',
'PaleVioletRed',
'PapayaWhip',
'PeachPuff',
'Peru',
'Pink',
'Plum',
'PowderBlue',
'Purple',
'Red',
'RosyBrown',
'RoyalBlue',
'SaddleBrown',
'Salmon',
'SandyBrown',
'SeaGreen',
'SeaShell',
'Sienna',
'Silver',
'SkyBlue',
'SlateBlue',
'SlateGray',
'SlateGrey',
'Snow',
'SpringGreen',
'SteelBlue',
'Tan',
'Teal',
'Thistle',
'Tomato',
'Turquoise',
'Violet',
'Wheat',
'White',
'WhiteSmoke',
'Yellow',
'YellowGreen');
$cssColours[''] = 'Ingen';
foreach($temp as $t)
	$cssColours[$t] = $t;
?>

<?=$this->form->create($project); ?>
<?=$this->form->field('typ', array('label' => 'Littera')); ?>
<?=$this->form->field('fordon', array('label' => 'Fordon')); ?>
<?=$this->form->field('ort', array('label' => 'Ort')); ?>
<?=$this->form->field('project_nr', array('label' => 'Order Nr')); ?>
<?=$this->form->field('colour', array('label' => 'Färg', 'list' => $cssColours)); ?>
<label>Beskrivning</label>
<?=$this->form->textarea('description'); ?>
<?php /*
<?=$this->form->field('object_id', array('type' => 'select','list' => $objArr, 'label' => 'Koppla till Fordon'));?>

<?=$this->form->field('client_id', array('type' => 'select','list' => $ownArr, 'label' => 'Koppla till Kund'));?>
*/?>
<?=$this->form->submit('Lägg till'); ?>
<?=$this->form->end(); ?>
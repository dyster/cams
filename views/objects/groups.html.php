<?php foreach($groups as $name => $objects) { ?>
<h3><?=$name;?></h3>

    <?php if(isset($objects)) { ?>

        <table>
            <thead>
            <tr>
                <th>Typ</th><th>Nr</th><th>Ägare</th><th>Noteringar</th>
            </tr>
            </thead>
            <?php foreach ($objects as $object)
            { ?>
                <tr>
                    <td><?=$object->getType()->name; ?></td>
                    <td><?=$this->html->link($object->name, '/objects/view/'.$object->id);?></td>
                    <td><?=$object->getOwner()->name; ?></td>
                    <td><?=$object->notes;?></td>
                </tr>
            <?php } ?>

        </table>
    <?php } ?>




<?php } ?>
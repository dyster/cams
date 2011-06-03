<pre>
</pre>
<?php

print_r(get_browser(null, true));

//echo phpinfo();

use cams\models\Damages;

echo $this->view()->render(
    array('element' => 'table'), 
    array('title' => 'En snygg titel', 'header' => array('created' => 'Skapad', 'short' => 'Titel', 'prio' => 'Prio'), 'rows' => Damages::all())
);

?>

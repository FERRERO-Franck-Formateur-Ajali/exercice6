<?php

require_once 'config/framework.php';
require_once 'config/connect.php';

//dump(query('show tables'));
//$tables = query('show tables');
//dump(query('show full columns from user'));

foreach (query('show tables') as $tables) {
    if (!file_exists($tables['Tables_in_test'].'.php')) {
        $ecrire = "<?php\n";
        $ecrire .= "\n";
        $ecrire .= "require_once 'config/framework.php';";
        $ecrire .= "\n";
        $ecrire .= 'if (isset($_POST) && !empty($_POST)) {';
        $ecrire .= "\n";
        $ecrire .= "\t";
        $ecrire .= 'dump($_POST);';
        $ecrire .= "\n";
        $ecrire .= '}';
        file_put_contents($tables['Tables_in_test'].'.php', $ecrire);
    }
    echo '<h1>formulaire table '.$tables['Tables_in_test'].'</h1>
         <form action="'.$tables['Tables_in_test'].'.php" method="post">';
    //echo $tables['Tables_in_test'].'<br>';
    $table = query('show full columns from '.$tables['Tables_in_test']);
    echo '<button type="submit">Valider le formulaire '.$tables['Tables_in_test'].'</button>
    </form>
    ';

    dump($table);
}

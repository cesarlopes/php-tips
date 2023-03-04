<?php

//https://www.php.net/manual/pt_BR/language.types.string.php

$simpleString = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

$stringInterpreted = "$simpleString Sed hendrerit mauris eu nunc ullamcorper euismod.";


// Heredoc 
echo <<<END
      a
     b
    c
    END;


// Nowdoc 
echo <<<'EOD'
Example of string spanning multiple lines
using nowdoc syntax. Backslashes are always treated literally,
e.g. \\ and \'.
EOD;
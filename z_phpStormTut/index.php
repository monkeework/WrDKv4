<?php

echo 'first break point reached';


    $names = ['Bill', 'Sarah', 'Mike'];

    $numberOfNames = 0;

    foreach($names as $name){
        $numberOfNames++;

        $string2echo = hello($name);

        echo $string2echo;
        echo $string2echo;

        echo ' -- Inner break point reached<br />';
    }

    echo 'second break point reached';

    echo "Names were echoed {$numberOfNames}<br /><br />";

function hello($name){
    return "Hello, $name<br /><br />";


}
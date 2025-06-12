<?php
// $sport1= 'Football';
// $sport2= 'Basketball';
// $sport3= 'Handball';
// $sport4= 'Voleyball';


// $sports=array('Football', 'Basketball', 'Handball', 'Voleyball');

$sports=['Football', 'Basketball', 'Handball', 'Voleyball'];
//  echo $sports[0]; gets the first element based on its index
// echo end($sports); gets the last element in the array
// echo count($sports); counts the amount of elements in an array

// for($i=0; $i<4; $i++){
//     echo $sports[$i], "\n";
// }

$len = count($sports);

for($i=0; $i <$len; $i++){
    echo $sports[$i], "\n";
}

?>
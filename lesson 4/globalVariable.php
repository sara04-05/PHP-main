<?php
$y=7;
$x=5;

function sum(){
    global $x, $y;
    $y=$x+$y;
}
sum();
echo $y;

?>
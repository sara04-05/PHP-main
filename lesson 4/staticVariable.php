<?php
function callCounter(){
    static $count = 0;
    $count++;
    echo "The value of the count variable is: $count <br>";
}
callCounter();
callCounter();
callCounter();
callCounter();
callCounter();
?>
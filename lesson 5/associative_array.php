<?php
$grade =array(
    "Math" => "3",
    "Art" => "5",
    "History" => "4",
    "Music" => "4"
);

foreach($grade as $subject=> $grade){
    echo "Subject:" . $subject . ", Grade:" . $grade;
    echo '<br>';
}


?>
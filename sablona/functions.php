<?php

function pozdrav(){
    $hour = date('H');
    if($hour < 12){
        echo "<h3>Dobre rano!</h3>";
    } elseif ($hour < 18) {
        echo "<h3>Dobrý deň</h3>";
    } else {
        echo "<h3>Dobrý večer</h3>";
    }
}

?>
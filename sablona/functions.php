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

function generateSlides($dir) {
    
    $files = glob($dir . "/*.jpg");    
    $json = file_get_contents("sablona/data/data.json");    
    $data = json_decode($json, true);
    $text = $data["text_banner"];

    foreach ($files as $file) {        
        echo '<div class="slide fade">';        
        echo '<img src="' . $file . '">';        
        echo '<div class="slide-text">';        
        echo ($text[basename($file)]);         
        echo '</div>';        
        echo '</div>';    
    }
}

?>
<?php
//Check if $buttonstate is set
if (isset($buttonstate) && isset($text) && isset($btnUrl)) {
    //? Button
    echo ("
    <div class='btn $buttonstate' onclick='location.href=$btnUrl'>
        <img class='icon' src='./assets/icons/$buttonstate.png'/>
    </div>
    <div class='text $buttonstate'>
        <p>$text</p>
    </div>");
}

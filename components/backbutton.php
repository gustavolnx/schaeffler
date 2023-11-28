<?php
if (isset($btnOnClick)) {
    echo ("
        <div id='buttonBack' onclick='{$btnOnClick}'>
            <img src='/schaeffler/assets/icons/back-button.svg'/>
        </div>
    ");
}

<?php
function setFlash ($key,$val){
    $_SESSION[$key] = $val;
}

function getFlash($key){
    if(isset($_SESSION[$key])){
        echo $_SESSION[$key];
        unset($_SESSION[$key]);
    }
}

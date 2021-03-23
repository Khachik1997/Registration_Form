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

function setError($keyerr,$valerr){
    $_SESSION[$keyerr] = $valerr;
}
function getError($keyerr){
    if(isset($_SESSION[$keyerr])){
        echo $_SESSION[$keyerr];
        unset($_SESSION[$keyerr]);
    }
}



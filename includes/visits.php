<?php
    if(!isset($_COOKIE['visits'])){

        setcookie('visits', 1, time() + 365*3600*24);
        echo "Witaj na naszej stronie 1 raz!";
    }
    else {
        $cookie=$_COOKIE['visits'];
        $cookie += 1;

        setcookie('visits', $cookie);
        
        echo "Witaj, jesteś po raz ". $cookie. " na naszej stronie!" ;
    } 
    
?>    

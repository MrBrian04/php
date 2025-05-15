<?php
    session_start(); //inicia sesión

    $_SESSION = []; //limpia las variables de sesión

    session_destroy(); //destruye la sesión

    header("Location: ingreso"); //redirijo al modulo de ingreso
    exit; //cierro la ejecución
<?php

    class Conexion{

        static public function conectar(){

            $link = new PDO("mysql:host=localhost:3308;dbname=phpsena_bd","root","");
            return $link;

        }

    }
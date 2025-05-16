<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="vistas/librerias/bootstrap.min.css" rel="stylesheet">
    <title>PHP</title>
    <link rel="stylesheet" href="vistas/css/styles.css">
        <!-- Latest compiled Fontawesome-->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container-fluid">
                
            <div class="container py-5">

  

                <?php

                    session_start();
                  
                    $modulo = isset($_GET['modulo']) ? $_GET['modulo'] : 'ingreso';

                    if (!isset($_SESSION["validarIngreso"]) || $_SESSION["validarIngreso"] !== "ok") {
                        
                        if ($modulo === 'ingreso' || $modulo === 'registro') {
                            include "modulos/{$modulo}.php";
                            exit;
                        }

                        header("Location: index.php?modulo=ingreso");
                        exit;
                    }

                    include "modulos/menu.php"; 

                    if(isset($_GET["modulo"])){

                        if( $_GET["modulo"] == "registro" ||
                            $_GET["modulo"] == "ingreso" ||
                            $_GET["modulo"] == "contenido" ||
                            $_GET["modulo"] == "producto" ||
                            $_GET["modulo"] == "editar" ||
                            $_GET["modulo"] == "rol" ||
                            $_GET["modulo"] == "salir"){

                            include "modulos/".$_GET["modulo"].".php";

                        }else{

                            include "modulos/error404.php";
                        }

                    }else{

                        include "modulos/ingreso.php";

                    }

                    ?>

            </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
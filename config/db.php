<?php 

    /* Claves de base de datos */

    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("DB", "gioCRUD");

    function conectarDB() {
        $db = mysqli_connect(HOST, USER, PASS, DB);

        if (!$db) {
            echo "Error al conectar a la base de datos";
            exit();
        }

        return $db;
    }
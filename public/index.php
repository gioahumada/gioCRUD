<?php
require '../config/db.php';

$db = conectarDB();

if (!$db) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

$consulta = "SELECT * FROM tasks";
$resultado = mysqli_query($db, $consulta);

if (!$resultado) {
    echo "Error al consultar la base de datos";
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = mysqli_real_escape_string($db, $_POST['task']);
    $user = mysqli_real_escape_string($db, $_POST['user']);
    $date = date('Y-m-d');

    if (!$task) {
        $errores[] = "Debes agregar una tarea";
    }

    if (!$user) {
        $errores[] = "Debes agregar un usuario";
    }

    if (empty($errores)) {
        $consulta = "INSERT INTO tasks (task, user, fecha) VALUES ('$task', '$user', '$date')";
        $resultado = mysqli_query($db, $consulta);

        if ($resultado) {
            // Verificar si la tarea se ha agregado correctamente
            $consulta_verificacion = "SELECT * FROM tasks WHERE task='$task' AND user='$user' AND fecha='$date'";
            $resultado_verificacion = mysqli_query($db, $consulta_verificacion);

            if (mysqli_num_rows($resultado_verificacion) > 0) {
                echo "Registro exitoso y verificado";
            } else {
                echo "Error: No se pudo verificar el registro";
            }
        } else {
            echo "Error al registrar: " . mysqli_error($db);
        }
    } else {
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gioCRUD</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <a class="text-center text-decoration-none fw-black text-dark title" href="/"><h1>gioCRUD</h1></a>

    <header class="container py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Inicio</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Docs</a></li>
        </ul>
    </header>

    <div class="container">
    <div class="row">
        <div class="col-4">
            <form action="index.php" method="POST">
                <div class="mb-3">
                    <label for="task" class="form-label">Task</label>
                    <input type="text" class="form-control" id="task" name="task" required>
                </div>
                <div class="mb-3">
                    <label for="user" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="user" name="user" required>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>


            <div class="col-8 p-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task</th>
                            <th scope="col">Fecha Agregado</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Completado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- data -->
                        </tr>
                        <tr>
                            <!-- data -->
                        </tr>
                        <tr>
                            <!-- data -->
                        </tr>
                        <tr>
                            <!-- data -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
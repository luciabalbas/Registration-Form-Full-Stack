<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica Laboratorio</title>
    <meta name="author" content="Lucía Balbás" />
    <meta name="description" content="Práctica de Laboratorio para el curso Full Stack de Samsung Dev Spain" />
    <!-- Link del css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <?php
        require_once("verification.php");
        require_once("variables.php");

        // Conexión con BBDD
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $connection = new mysqli($host, $user, $passw, $bbdd);
        
        // Si hay un error en la conexión
        if ($connection->connect_errno) {
            print("La conexión falló: " .$connection->connect_error);
            exit;
        }

        // Verificar si los campos están rellenados
        if (!verifyRequired($name)) {
            $errores[] = 'El campo <strong>Nombre</strong> es obligatorio';
        }
        if (!verifyRequired($surname1)) {
            $errores[] = 'El campo <strong>Primer Apellido</strong> es obligatorio';
        }
        if (!verifyRequired($surname2)) {
            $errores[] = 'El campo <strong>Segundo Apellido</strong> es obligatorio';
        }
        if (!verifyRequired($email)) {
            $errores[] = 'El campo <strong>Email</strong> es obligatorio'; 
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'Introduzca un formato de <strong>Email</strong> válido';
        }
        if (!verifyRequired($login)) {
            $errores[] = 'El campo <strong>Usuario</strong> es obligatorio';
        }
        if (!verifyRequired($password)) {
            $errores[] = 'El campo <strong>Contraseña</strong> es obligatorio';
        } elseif (strlen($password) < 4 || strlen($password) > 8) {
            $errores[] = 'La <strong>Contraseña</strong> debe tener entre 4 y 8 carácteres';
        }

        // Comprobar si el email ya existe en la BBDD
        $emailFound = $connection->query($emailLookUp);
        if ($emailFound) {
            if (mysqli_num_rows($emailFound) > 0) {
                $errores[] = 'El correo <strong>' . $email . '</strong> ya está en uso';
            }
        }
        
        // Impresión de errores si existen
        if (!empty($errores)) {
            echo "<h1>Error en el registro</h1>";
            foreach($errores as $error) {
                echo '<p>' . $error . '</p>';
            }
            // Botón de regreso a la página anterior
            echo '<div class="boton"><button type="button" onclick="history.go(-1);">Regresar</button></div>';
            // No continua el programa
            exit;
        }

        // Si se ejecuta el query sin errores imprime los datos introducidos en la BBDD
        if ($connection->query($query) === true) {
            echo "<h1>Registro completado</h1>";
            echo "<p><strong>Nombre: </strong>" . $name . "</p>";
            echo "<p><strong>Apelidos: </strong>" . $surname1 . " " . $surname2 . "</p>";
            echo "<p><strong>Email: </strong>" . $email . "</p>";
            echo "<p><strong>Usuario: </strong>" . $login . "</p>";
            echo "<p><strong>Contraseña: </strong>" . $password . "</p>";
        } else {
            print("<p>Error al guardar los datos". $connection->error . "</p>");
        }
        
        // Si hay datos ya existentes en la BBDD los imprime en una tabla
        $querydatos = $connection->query($datos);
        if ($querydatos->num_rows > 0) {
            // Botones que muestran / ocultan la tabla de datos
            echo '<div class="boton">';
            echo '<button type="button" id="show" onclick="showTable()">Usuarios Registrados</button>';
            echo '<button type="button" id="hide" onclick="hideTable()">Ocultar Usuarios</button>';
            echo '</div>';
            // Tabla que mostrará los datos + celdas de cabecera
            echo '<table id="users"><tr><th>Usuario</th><th>Email</th><th>Nombre</th><th style="width: 30%;">Apellidos</th></tr>';
            // Mientras existan datos que imprimir
            while ($row = mysqli_fetch_assoc($querydatos)) {
                echo '<tr>';
                echo '<td>' . $row["Usuario"] . '</td>';
                echo '<td>' . $row["Email"] . '</td>';
                echo '<td>' . $row["Nombre"] . '</td>';
                echo '<td>' . $row["Apellido1"] . ' ' . $row["Apellido2"];
                echo '</tr>';
            }
            echo '</table>';
            // Botón de regreso a la página anterior
            echo '<div class="boton"><button type="button" onclick="history.go(-1);">Regresar</button></div>';
        }
        
        // Cierra la conexión con la BBDD
        $connection->close();

        ?>
    </main>
    <script src="buttons.js"></script>
</body>
</html>
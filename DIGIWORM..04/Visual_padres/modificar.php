<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos del formulario */
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-image: url(../img/Fondo_padres.jpg);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="email"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff; /*  color de fondo */
        }

        input[readonly] {
            background-color: #fff; /* Color de fondo para campos de solo lectura */
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    include 'conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["idEstudiante"])) {
        $nuevoEmail = $_POST["email"];
        $idEstudiante = $_POST["idEstudiante"];
    
        // Actualiza el email del estudiante en la base de datos
        $sqlActualizarEmail = "UPDATE estudiante SET Email='$nuevoEmail' WHERE idEstudiante=$idEstudiante";
    
        if ($conn->query($sqlActualizarEmail) === TRUE) {
            echo "<script>alert('Email actualizado correctamente'); window.location.href = '/PROYECTO/DIGIWORM..04/Visual_padres/index.php';</script>";
        } else {
            echo "<p>Error al actualizar el email: " . $conn->error . "</p>";
        }
    
        $conn->close();
    }
    
    // Resto del código
    

    // Verificar si se ha enviado un ID de estudiante
    if (isset($_GET["id"])) {
        $idEstudiante = $_GET["id"];

        // Obtener la información del estudiante
        $sqlEstudiante = "SELECT * FROM estudiante WHERE idEstudiante = $idEstudiante";
        $resultEstudiante = $conn->query($sqlEstudiante);

        if ($resultEstudiante->num_rows > 0) {
            $rowEstudiante = $resultEstudiante->fetch_assoc();
        } else {
            echo "<p>No se encontró ningún estudiante con el ID proporcionado.</p>";
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" value="<?php echo isset($rowEstudiante['idEstudiante']) ? $rowEstudiante['idEstudiante'] : ''; ?>" readonly>
        <label for="nombres">Nombres:</label>
        <input type="text" id="nombres" name="nombres" value="<?php echo isset($rowEstudiante['Nombres']) ? $rowEstudiante['Nombres'] : ''; ?>" readonly>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo isset($rowEstudiante['Apellidos']) ? $rowEstudiante['Apellidos'] : ''; ?>" readonly>
        <label for="curso">Curso:</label>
        <input type="text" id="curso" name="curso" value="<?php echo isset($rowEstudiante['Curso']) ? $rowEstudiante['Curso'] : ''; ?>" readonly>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="<?php echo isset($rowEstudiante['Estado']) ? $rowEstudiante['Estado'] : ''; ?>" readonly>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : (isset($rowEstudiante['Email']) ? $rowEstudiante['Email'] : ''); ?>" required>
        <input type="hidden" name="idEstudiante" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
        <input type="submit" value="Guardar Cambios">
    </form>
</body>

</html>

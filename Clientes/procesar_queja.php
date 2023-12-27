<?php

    // Punto 0.25: Comprobar que para el campo usuario, se introduce un valor de tipo email
    if (!filter_var($_POST["nombre"], FILTER_VALIDATE_EMAIL)) {
        $error_usuario = "Por favor, introduce una dirección de correo electrónico válida.";
    }

    // Punto 0.50: Verificar si se ha completado el campo texto
    if (empty($_POST["texto"])) {
        $error_texto = "Por favor, completa el campo de texto.";
    }

    // Punto 0.50: Verificar si se ha subido un archivo de imagen
    if (!empty($_POST["imagen"])) {
        $tipo_permitido = array("image/png", "image/jpeg");

        // Punto 0.50: Verificar si el tipo MIME del archivo es válido
        if (!in_array($_FILES["imagen"]["type"], $tipo_permitido)) {
            $error_imagen = "Solo se permiten archivos PNG o JPEG.";
        } else {
            // Obtener la información del archivo
            $nombre_original = basename($_FILES["imagen"]["name"]);
            $timestamp = time();
            $nombre_archivo = "imagenes_queja/" . $nombre_original . "_" . $timestamp;

            // Mover el archivo al directorio de imágenes de anuncios
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $nombre_archivo);
        }
    } else {
        $nombre_archivo = null; // Si no se sube una imagen, el valor en la base de datos es NULL
    }

    // Punto 0.50: Verificar si no hay errores antes de insertar en la base de datos
    if (empty($error_usuario) && empty($error_texto) && empty($error_imagen)) {
        // Insertar el nuevo anuncio en la base de datos
        $usuario = $_POST["usuario"];
        $texto = $_POST["texto"];
        $categoria = $_POST["categoria"];
        // Punto 0.25: El campo fecha DeRegistro se establecerá automáticamente a la fecha del día de hoy
        $fechaDeRegistro = date("Y-m-d");

        // Preparar la consulta SQL
        if($nombre_archivo != null){
            $query = "INSERT INTO anuncio (usuario, texto, categoria, fechaDeRegistro, imagen) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssss", $usuario, $texto, $categoria,$fechaDeRegistro, $nombre_archivo);
            $stmt->execute();
            $stmt->close();
        }else{
            $query = "INSERT INTO anuncio (usuario, texto, categoria, fechaDeRegistro) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $usuario, $texto, $categoria, $fechaDeRegistro);
            $stmt->execute();
            $stmt->close();
        }
        // Redirigir a la página de inicio
        header("Location: index.php");
        exit();
    }

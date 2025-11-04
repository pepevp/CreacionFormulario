<?php
// Validación del lado servidor
$errores = [];
if(empty($_POST['nombre'])) $errores[] = "Nombre obligatorio.";
if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errores[] = "Email obligatorio y válido.";
if(empty($_POST['usuario'])) $errores[] = "Usuario obligatorio.";
if(empty($_POST['contrasena']) || $_POST['contrasena'] !== $_POST['confirmar_contrasena']) $errores[] = "La contraseña es obligatoria y debe coincidir.";
if(!isset($_POST['terminos'])) $errores[] = "Debe aceptar los términos.";

// Mostrar errores o datos recibidos
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">';
echo '<div class="container mt-5">';
if($errores){
    echo '<div class="alert alert-danger"><ul>';
    foreach($errores as $e) echo "<li>$e</li>";
    echo '</ul></div>';
} else {
    echo '<div class="alert alert-success">¡Registro exitoso!</div>';
    echo '<ul class="list-group">';
    foreach($_POST as $k => $v){
        if(is_array($v)) $v = implode(", ", $v);
        echo "<li class=\"list-group-item\"><strong>".htmlspecialchars($k).":</strong> ".htmlspecialchars($v)."</li>";
    }
    if($_FILES && $_FILES['archivo']['error'] == 0){
        echo "<li class=\"list-group-item\">Archivo subido: <b>" . htmlspecialchars($_FILES['archivo']['name']) . "</b></li>";
    }
    echo '</ul>';
}
echo '<a href="index.html" class="btn btn-primary mt-3">Volver</a></div>';
?>

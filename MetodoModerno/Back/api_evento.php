<?php
header("Content-Type: application/json; charset=utf-8");
$errores = [];

foreach(['nombre','email','usuario','contrasena','confirmar_contrasena','terminos'] as $campo)
    if(empty($_POST[$campo])) $errores[] = "Falta $campo.";

if(isset($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    $errores[] = "Email inválido.";

if($_POST['contrasena'] !== $_POST['confirmar_contrasena'])
    $errores[] = "Las contraseñas no coinciden.";

if($errores){
    echo json_encode(['error' => implode(", ", $errores)]);
    exit;
}

$out = $_POST;

if($_FILES && $_FILES['archivo']['error'] == 0){
    $out['archivo'] = $_FILES['archivo']['name'];
}

echo json_encode($out);
?>

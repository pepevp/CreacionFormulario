<?php
if (!isset($_GET['data'])) {
    die("No se recibieron datos.");
}

$data = json_decode(base64_decode($_GET['data']), true);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultado del Registro (REST)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">

        <?php if (!$data): ?>
            <div class="alert alert-danger">Error al procesar los datos.</div>
        <?php else: ?>

            <div class="alert alert-success">¡Registro exitoso!</div>

            <ul class="list-group">
                <?php foreach ($data as $k => $v): ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($k) ?>:</strong>
                        <?= is_array($v) ? htmlspecialchars(implode(", ", $v)) : htmlspecialchars($v) ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        <?php endif; ?>

        <a href="../front/index_rest.html" class="btn btn-primary mt-3">Volver</a>

    </div>
</body>

</html>

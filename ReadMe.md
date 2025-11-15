Explicación de ambos metodos y diferencias:

1️⃣ Forma tradicional (index.html → procesar_evento.php)
Flujo:

1. El formulario tiene action="../back/procesar_evento.php" y method="POST".

2. Cuando el usuario envía el formulario:

    - El navegador hace una petición POST tradicional al servidor.

    - El servidor (procesar_evento.php) valida los datos y genera HTML directamente como respuesta.

3. La página que ve el usuario es el HTML generado por PHP, mostrando errores o el resumen del registro.

4. Se puede volver al formulario con un botón/link.

Características:

- Validación:

    - Lado cliente: con HTML5 y JS (clases de Bootstrap y checkValidity()).

    - Lado servidor: en procesar_evento.php para evitar datos incorrectos aunque alguien modifique el formulario.

- Subida de archivos: se maneja con enctype="multipart/form-data" y PHP lo recibe vía $\_FILES.

- Retroalimentación al usuario: se hace con HTML renderizado directamente desde PHP.

- Ventaja: Simple de implementar, clásico “submit → render → mostrar resultado”.

- Desventaja: Cada envío recarga toda la página; menos dinámico.

2️⃣ Forma REST / AJAX (index.html → api_evento.php → resultado.php)
Flujo:

1. El formulario tiene ID registroForm, pero sin action ni method explícitos.

2. Cuando el usuario envía el formulario:

    - Se captura el evento submit con JS y se hace preventDefault().

    - Se crea un FormData con todos los campos del formulario.

    - Se envía con fetch() al servidor (api_evento.php) como petición AJAX.

3. api_evento.php:

    - Valida los datos como en la versión tradicional.

    - Retorna JSON en lugar de HTML.

4. JS interpreta el JSON:

    - Si hay errores, los muestra dinámicamente.

    - Si todo está bien, redirige a resultado.php, pasando los datos codificados en base64 en la URL.

5. resultado.php:

    - Decodifica los datos y genera un HTML similar a la versión tradicional, pero solo para mostrar el resultado.

Características:

- Validación:

    - Lado cliente: igual, HTML5 + JS.

    - Lado servidor: api_evento.php.

- Subida de archivos: igual, usando FormData.

- Retroalimentación al usuario: dinámica (sin recargar página) para mostrar errores o éxito.

- Ventaja: Más moderno y dinámico, se pueden mostrar errores instantáneamente sin recargar toda la página.

- Desventaja: Más complejo: requiere JS y manejo de JSON; la redirección a resultado.php con datos en la URL puede ser menos seguro para datos sensibles (como contraseñas).



Resumen práctico:

Forma 1: Tradicional, simple, recomendable para proyectos pequeños o cuando no quieres depender de JS.

Forma 2: Más moderna, orientada a SPA o aplicaciones con experiencia más dinámica. Separas API (JSON) del front-end, útil si luego quieres hacer apps móviles o SPA usando los mismos endpoints.
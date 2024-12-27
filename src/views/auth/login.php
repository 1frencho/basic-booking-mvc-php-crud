<?php
$title = 'Login';
$content = '
<form method="POST" action="/login">
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Iniciar sesión</button>
</form>';
require __DIR__ . '/../layouts/main.php';

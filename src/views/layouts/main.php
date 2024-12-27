<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'Mi Aplicación' ?></title>
  <?= $meta ?? '' ?>
  <?= $styles ?? '' ?>
  <base href="/booking-crud-php/public/">
</head>

<body>
  <header>
    <nav>
      <a href="">Inicio</a>
      <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="login">Login</a>
      <?php else: ?>
        <a href="dashboard">Dashboard</a>
        <a href="logout">Logout</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <?= $content ?? '<p>No hay contenido disponible.</p>' ?>
  </main>

  <footer>
    <p>&copy; <?= date('Y') ?> Mi Aplicación</p>
  </footer>

  <?= $scripts ?? '' ?>
</body>

</html>
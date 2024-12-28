<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'Mi Aplicación' ?></title>
  <?= $meta ?? '' ?>
  <?= $styles ?? '' ?>
  <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/output.css" />
  <base href="/booking-crud-php/public/">
  <style>
    /* Transición para el fade */
    main {
      opacity: 0;
      transition: opacity 0.3s linear;
    }

    main.loaded {
      opacity: 1;
    }
  </style>
</head>

<body>
  <?php require __DIR__ . '/header.php'; ?>

  <main class="min-h-screen pt-16">
    <?= $content ?? '<p>No hay contenido disponible.</p>' ?>
  </main>

  <footer>
    <p>&copy; <?= date('Y') ?> Mi Aplicación</p>
  </footer>

  <?= $scripts ?? '' ?>

  <script>
    // Transición al cargar la página
    document.addEventListener('DOMContentLoaded', () => {
      const main = document.querySelector('main');
      main.classList.add('loaded');

      // Transición al hacer clic en enlaces
      const links = document.querySelectorAll('a[href]');
      links.forEach(link => {
        link.addEventListener('click', (event) => {
          event.preventDefault();
          const href = link.getAttribute('href');

          // Inicia la animación de salida
          main.classList.remove('loaded');

          // Navega a la nueva página después de la animación
          setTimeout(() => {
            window.location.href = href;
          }, 300); // Duración de la transición
        });
      });
    });
  </script>
</body>

</html>
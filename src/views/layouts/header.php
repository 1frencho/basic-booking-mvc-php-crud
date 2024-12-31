<?php
// Links públicos
$navbarItems = [
  '' => 'Home',
  'rooms' => 'Available Rooms',
];

// Links para administradores
$adminNavbarItems = [
  'rooms' => 'Available Rooms',
  'adminRoomManager' => 'Manage Rooms',
  'adminUsersManager' => 'All Users',
  'adminBookingsManager' => 'All Bookings',
];

// Links para usuarios autenticados
$userNavbarItems = [
  'rooms' => 'Available Rooms',
  'myBookings' => 'My Bookings',
];

// Links para la derecha (para usuarios no autenticados)
$navbarRightItems = [
  'signIn' => 'Sign In',
  'signUp' => 'Sign Up',
];

// Links para el menú de cuenta (usuario logueado)
$accountItems = [
  'myBookings' => 'My Bookings',
  'signOut' => 'Sign Out',
];

// Obtener la ruta actual desde $_SERVER['REQUEST_URI']
$currentRoute = strtok($_SERVER['REQUEST_URI'], '?');

// Si la URL contiene '/public/', eliminarla
if (strpos($currentRoute, '/public/') !== false) {
  $currentRoute = explode('/public/', $currentRoute)[1];
}

// Si la ruta está vacía, definir como '/'
$currentRoute = $currentRoute ?: '';

// Obtener los datos del usuario actual
$user = $_SESSION['user'] ?? null;
$userRole = $user['role'] ?? null;
?>

<nav class="bg-white fixed top-0 left-0 right-0 z-50 border-b border-gray-200 md:px-6">
  <div class="flex h-16 items-center justify-between px-4 lg:px-8">
    <!-- Mobile menu button -->
    <button type="button"
      class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white sm:hidden"
      id="mobile-menu-button">
      <span class="sr-only">Open main menu</span>
      <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
      </svg>
    </button>

    <!-- Desktop Navbar -->
    <div class="flex flex-1 items-center justify-between sm:justify-start gap-6">
      <a href="#" class="flex items-center text-sky-400 text-2xl no-underline gap-4">
        <img src="assets/images/logo.webp" alt="Logo" class="h-8 w-auto rounded-full" />

      </a>
      <div class="hidden sm:flex space-x-4">
        <?php
        $links = $userRole === 'Admin' ? $adminNavbarItems : ($userRole === 'User' ? $userNavbarItems : $navbarItems);
        foreach ($links as $route => $label):
        ?>
          <a href="<?= $route ?>"
            class="duration-300 no-underline rounded-md px-3 py-2 text-sm font-medium <?= $route === $currentRoute ? 'bg-sky-400 text-white' : 'text-gray-700 hover:bg-sky-400 hover:text-white' ?>">
            <?= $label ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Avatar/Menu -->
    <div class="relative flex items-center gap-4">
      <?php if ($user): ?>
        <button id="avatar-button" type="button"
          class="flex items-center rounded-full bg-white text-sm focus:outline-none">
          <img class="h-8 w-8 rounded-full" src="https://picsum.photos/seed/picsum/200/300" alt="User avatar">
        </button>
        <div id="avatar-menu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg ring-1 ring-black/5">
          <?php foreach ($accountItems as $item => $label): ?>
            <a href="<?= $item ?>"
              class="block px-4 py-2 no-underline text-sm text-gray-700 hover:bg-gray-100 duration-300">
              <?= $label ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <?php foreach ($navbarRightItems as $route => $label): ?>
          <a href="<?= $route ?>"
            class="duration-300 no-underline rounded-md px-3 py-2 text-sm font-medium <?= $route === $currentRoute ? 'bg-sky-400 text-white' : 'text-gray-700 hover:bg-sky-400 hover:text-white' ?>">
            <?= $label ?>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden bg-white sm:hidden">
    <div class="space-y-1 px-2 pt-2 pb-3">
      <?php foreach ($links as $route => $label): ?>
        <a href="<?= $route ?>"
          class="block px-3 py-2 no-underline rounded-md text-base font-medium <?= $route === $currentRoute ? 'bg-sky-400 text-white' : 'text-gray-700 hover:bg-sky-400 hover:text-white' ?>">
          <?= $label ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const avatarButton = document.getElementById('avatar-button');
    const avatarMenu = document.getElementById('avatar-menu');

    // Lógica del menú móvil
    mobileMenuButton?.addEventListener('click', () => {
      const isOpen = !mobileMenu.classList.contains('hidden');
      if (isOpen) {
        mobileMenu.classList.remove('animate-fade-in');
        mobileMenu.classList.add('animate-fade-out');
        setTimeout(() => mobileMenu.classList.add('hidden'), 300); // Duración de la animación
      } else {
        mobileMenu.classList.remove('hidden', 'animate-fade-out');
        mobileMenu.classList.add('animate-fade-in');
      }
    });

    // Lógica del menú del avatar
    avatarButton?.addEventListener('click', () => {
      const isOpen = !avatarMenu?.classList.contains('hidden');
      if (isOpen) {
        avatarMenu?.classList.remove('animate-fade-in');
        avatarMenu?.classList.add('animate-fade-out');
        setTimeout(() => avatarMenu?.classList.add('hidden'), 300); // Duración de la animación
      } else {
        avatarMenu?.classList.remove('hidden', 'animate-fade-out');
        avatarMenu?.classList.add('animate-fade-in');
      }
    });

    // Cerrar menús al hacer clic fuera
    document.addEventListener('click', (e) => {
      if (!avatarButton?.contains(e.target) && !avatarMenu?.contains(e.target)) {
        avatarMenu?.classList.remove('animate-fade-in');
        avatarMenu?.classList.add('animate-fade-out');
        setTimeout(() => avatarMenu?.classList.add('hidden'), 300); // Duración de la animación
      }
    });
  });
</script>
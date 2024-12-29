<?php
// Links públicos
$navbarItems = [
  '' => 'Home',
  'rooms' => 'Available rooms',
];

// Links para administradores
$adminNavbarItems = [
  'rooms' => 'Available rooms',
  'adminRoomManager' => 'Manage Rooms',
  'adminUsersManager' => 'Manage Users',
  'adminBookingsManager' => 'Manage Bookings',
];

// Links para usuarios autenticados
$userNavbarItems = [
  'rooms' => 'Available rooms',
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
$currentRoute = strtok($_SERVER['REQUEST_URI'], '?'); // Remover query strings si existen

// Si la URL contiene '/public/', eliminarla junto con lo anterior
if (strpos($currentRoute, '/public/') !== false) {
  $currentRoute = explode('/public/', $currentRoute)[1]; // Tomar solo la parte después de '/public/'
}

// Si la ruta está vacía, definir como '/'
$currentRoute = $currentRoute ?: '';

// Obtener los datos del usuario actual
$user = $_SESSION['user'] ?? null;

// Determinar el rol del usuario
$userRole = $user['role'] ?? null;
?>

<nav class="bg-white fixed top-0 left-0 right-0 z-50 border-b border-gray-200">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <!-- Mobile menu button -->
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button type="button"
          class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
          id="mobile-menu-button" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Navbar Links -->
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <a href=""> <i class="lni lni-home-2 text-2xl text-sky-400"></i>
          </a>
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Renderizar elementos del navbar -->
            <?php if ($userRole === 'Admin'): ?>
              <?php foreach ($adminNavbarItems as $route => $label): ?>
                <a href="<?= $route ?>"
                  class="no-underline duration-200 rounded-md px-3 py-2 text-sm text-gray-700 font-medium <?= $route === $currentRoute ? 'bg-sky-400 text-white' : 'text-gray-300 hover:bg-sky-400 hover:text-white' ?>">
                  <?= $label ?>
                </a>
              <?php endforeach; ?>
            <?php elseif ($userRole === 'User'): ?>
              <?php foreach ($userNavbarItems as $route => $label): ?>
                <a href="<?= $route ?>"
                  class="duration-200 rounded-md px-3 py-2 text-sm text-gray-700 font-medium <?= $route === $currentRoute ? 'bg-sky-400 text-white' : 'text-gray-300 hover:bg-sky-400 hover:text-white' ?>">
                  <?= $label ?>
                </a>
              <?php endforeach; ?>
            <?php else: ?>
              <?php foreach ($navbarItems as $route => $label): ?>
                <a href="<?= $route ?>"
                  class="duration-200 rounded-md px-3 py-2 text-sm text-gray-700 font-medium <?= $route === $currentRoute ? 'bg-sky-400 text-white' : 'text-gray-300 hover:bg-sky-400 hover:text-white' ?>">
                  <?= $label ?>
                </a>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Avatar menu -->
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <div class="relative ml-3">
          <div class="flex space-x-4">
            <?php if ($user): ?>
              <button type="button"
                class="relative flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                id="avatar-button" aria-expanded="false" aria-haspopup="true">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <img class="h-[36px] w-[36px] rounded-full object-cover" src="https://picsum.photos/seed/picsum/200/300"
                  alt="Profile picture">
              </button>
              <div id="avatar-menu"
                class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 transform opacity-0 scale-95 transition duration-200 ease-in-out"
                role="menu" aria-orientation="vertical" aria-labelledby="avatar-button">
                <?php foreach ($accountItems as $item => $label): ?>
                  <a href="<?= $item ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 duration-200"
                    role="menuitem">
                    <?= $label ?>
                  </a>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <?php foreach ($navbarRightItems as $route => $label): ?>
                <a href="<?= $route ?>"
                  class="duration-200 rounded-md px-3 py-2 text-sm text-gray-700 font-medium <?= $route === $currentRoute ? 'bg-sky-400 text-white' : 'text-gray-300 hover:bg-sky-400 hover:text-white' ?>">
                  <?= $label ?>
                </a>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Avatar Menu Logic
    const avatarButton = document.getElementById('avatar-button');
    const avatarMenu = document.getElementById('avatar-menu');

    if (avatarButton && avatarMenu) {
      avatarButton.addEventListener('click', () => {
        const isOpen = !avatarMenu.classList.contains('hidden');
        if (isOpen) {
          avatarMenu.classList.add('opacity-0', 'scale-95');
          avatarMenu.classList.remove('opacity-100', 'scale-100');
          setTimeout(() => avatarMenu.classList.add('hidden'), 200);
        } else {
          avatarMenu.classList.remove('hidden');
          setTimeout(() => {
            avatarMenu.classList.remove('opacity-0', 'scale-95');
            avatarMenu.classList.add('opacity-100', 'scale-100');
          }, 10);
        }
      });

      document.addEventListener('click', (event) => {
        if (!avatarButton.contains(event.target) && !avatarMenu.contains(event.target)) {
          avatarMenu.classList.add('opacity-0', 'scale-95');
          avatarMenu.classList.remove('opacity-100', 'scale-100');
          setTimeout(() => avatarMenu.classList.add('hidden'), 200);
        }
      });
    }

    // Mobile Menu Logic
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) { // Verificar si los elementos existen
      mobileMenuButton.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');
        if (isOpen) {
          mobileMenu.classList.add('opacity-0', 'scale-95');
          mobileMenu.classList.remove('opacity-100', 'scale-100');
          setTimeout(() => mobileMenu.classList.add('hidden'), 200);
        } else {
          mobileMenu.classList.remove('hidden');
          setTimeout(() => {
            mobileMenu.classList.remove('opacity-0', 'scale-95');
            mobileMenu.classList.add('opacity-100', 'scale-100');
          }, 10);
        }
      });
    }
  });
</script>
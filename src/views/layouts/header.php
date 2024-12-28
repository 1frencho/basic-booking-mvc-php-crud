<?php
// Array de elementos del navbar
$navbarItems = [
  '' => 'Home',
  'rooms' => 'Rooms',
  'projects' => 'Projects',
  'signIn' => 'Sign In',
  'signUp' => 'Sign Up',
];

// Obtener la ruta actual desde $_SERVER['REQUEST_URI']
$currentRoute = strtok($_SERVER['REQUEST_URI'], '?'); // Remover query strings si existen

// Si la URL contiene '/public/', eliminarla junto con lo anterior
if (strpos($currentRoute, '/public/') !== false) {
  $currentRoute = explode('/public/', $currentRoute)[1]; // Tomar solo la parte después de '/public/'
}

// Si la ruta está vacía, definir como '/'
$currentRoute = $currentRoute ?: '';

?>

<nav class="bg-white fixed top-0 left-0 right-0 z-50 border-b border-gray-200 ">
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

      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <!-- <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500"
            alt="Your Company"> -->
          <i class="lni lni-home-2 text-2xl text-sky-400"></i>
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <!-- Renderizar elementos del navbar -->
            <?php foreach ($navbarItems as $route => $label): ?>
              <a href="<?= $route ?>"
                class="duration-200 rounded-md px-3 py-2 text-sm text-gray-700 font-medium <?= $route === $currentRoute ? 'bg-sky-400 text-white' : 'text-gray-300 hover:bg-sky-400 hover:text-white' ?>">
                <?= $label ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Avatar menu -->
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <div class="relative ml-3">
          <div>
            <button type="button"
              class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
              id="avatar-button" aria-expanded="false" aria-haspopup="true">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">Open user menu</span>
              <img class="size-8 rounded-full"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt="">
            </button>
          </div>

          <div id="avatar-menu"
            class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 transform opacity-0 scale-95 transition duration-200 ease-in-out"
            role="menu" aria-orientation="vertical" aria-labelledby="avatar-button">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 duration-200"
              role="menuitem">Your Profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 duration-200"
              role="menuitem">Settings</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 duration-200"
              role="menuitem">Sign out</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu"
    class="hidden sm:hidden bg-white space-y-1 px-2 pb-3 pt-2 transform opacity-0 scale-95 transition duration-200 ease-in-out">
    <?php foreach ($navbarItems as $route => $label): ?>
      <a href="<?= $route ?>"
        class="block rounded-md px-3 py-2 text-sm font-medium <?= $route === $currentRoute ? 'bg-gray-600 text-white' : 'text-gray-700 hover:bg-gray-500' ?>">
        <?= $label ?>
      </a>
    <?php endforeach; ?>
  </div>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Avatar Menu Logic
    const avatarButton = document.getElementById('avatar-button');
    const avatarMenu = document.getElementById('avatar-menu');

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

    // Mobile Menu Logic
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

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
  });
</script>
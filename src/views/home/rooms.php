<?php

use App\Models\Room;

$breadTitle = 'Available rooms';
$breadDesc = 'Public rooms';
require __DIR__ . '/../../components/BreadCrumb.php';

$rooms = Room::getAllPublic();
?>
<style>
  #myBreadCrumb {
    background-image: url('assets/images/2.webp');
  }
</style>

<div class="flex flex-col p-4 md:p-8 gap-4 w-full">
  <?php
  require __DIR__ . '/../../components/WarningAlert.php';
  require __DIR__ . '/../../components/SuccessAlert.php';
  ?>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<section class="flex flex-col items-center justify-center p-4 md:p-8 gap-4 w-full">
  <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-8 w-full justify-center items-center">
    <?php foreach ($rooms as $room): ?>
      <button class="hover:shadow-lg hover:scale-105 transition-transform duration-300 ease-in-out room-detail-btn"
        data-name="<?php echo htmlspecialchars($room['name']); ?>"
        data-description="<?php echo htmlspecialchars($room['description']); ?>"
        data-image-url="<?php echo htmlspecialchars($room['image_url']); ?>"
        data-price="<?php echo htmlspecialchars($room['price_per_night']); ?>"
        data-status="<?php echo htmlspecialchars($room['room_status']); ?>"
        data-room-id="<?php echo htmlspecialchars($room['id']); ?>">

        <div
          class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 ">
          <img class="w-full h-[200px] object-cover rounded-t-xl"
            src="<?php echo htmlspecialchars($room['image_url']); ?>" alt="Card Image">
          <div class="p-4 md:p-5">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
              <?php echo htmlspecialchars($room['name']); ?>
            </h3>
            <p class="mt-1 text-gray-500 dark:text-neutral-400">
              <?php echo htmlspecialchars($room['description']); ?>
            </p>
            <p class="mt-2 text-base font-medium text-sky-500 dark:text-neutral-500">
              $ <?php echo htmlspecialchars($room['price_per_night']); ?> / night
            </p>
          </div>
        </div>
      </button>
    <?php endforeach; ?>
  </div>
</section>


<?php

require __DIR__ . '/../../components/dialogs/RoomDetails.php';

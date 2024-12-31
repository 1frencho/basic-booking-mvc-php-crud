<?php

use App\Models\Room;

$lastRoomsPosted = Room::getLastRoomsPosted();

?>

<section class="flex flex-col items-center justify-center px-4 gap-4 md:px-8 py-4 md:py-8 h-full">

  <h4
    class="flex items-center gap-2 text-base font-semibold text-gray-900  capitalize transition-all duration-500 self-start ">
    <a href="rooms" class="myPrimaryBtn self-start">
      Explore All Rooms
    </a>
    - Last posted rooms
  </h4>

  <!-- Divider -->
  <div class="w-full h-1 bg-cyan-400 rounded-full "></div>


  <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-4 items-center justify-center w-full ">
    <?php
    foreach ($lastRoomsPosted as $room): ?>
      <article
        class="relative flex flex-col items-center border border-solid shadow-md border-gray-200 rounded-2xl transition-all duration-500 md:flex-row md:max-w-lg ">
        <div class="block overflow-hidden md:w-52 h-48">
          <img src="<?php echo $room['image_url']; ?>" alt="Card image" class="h-full rounded-2xl object-cover" />
        </div>
        <div class="p-4">
          <h4 class="text-base font-semibold text-gray-900 mb-2 capitalize transition-all duration-500 ">
            <?php echo htmlspecialchars($room['name']); ?>
          </h4>
          <p class="text-sm font-normal text-gray-500 transition-all duration-500 leading-5 mb-5">
            <?php echo htmlspecialchars($room['description']); ?>
          </p>
          <p class="text-sm font-normal text-gray-500 transition-all duration-500 leading-5 mb-5">
            $ <?php echo htmlspecialchars($room['price_per_night']); ?> / night
          </p>
          <!-- <button
            class="bg-sky-500 hover:bg-sky-600 shadow-sm rounded-full py-2 px-5 text-xs text-white font-semibold transition-all duration-300">Read
            More</button> -->
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>